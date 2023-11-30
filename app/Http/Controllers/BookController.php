<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\FavoritesModel;
use App\Models\Gallery;
use App\Models\RatingModel;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BookController extends Controller
{

    public function _construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $batas = 5;
        $jumlah_buku = Buku::count();
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('latihan_pertemuan5', compact('data_buku', 'no' ,'jumlah_buku'));
    }

    public function search(Request $request)
    {
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', "%" . $cari . "%")
            ->orwhere('penulis', 'like', "%" . $cari . "%")
            ->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);

        return view('buku.search', compact('data_buku', 'no' ,'jumlah_buku', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:5',
            'penulis' => 'required',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',

            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $filename = time().'_'.$request->file('thumbnail')->getClientOriginalName();
        $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');

        Image::make(storage_path().'/app/public/uploads/'.$filename)
            -> fit(240,320)
            -> save();

        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->filename = $filename;
        $buku->filepath = $filepath;
        $buku->buku_seo = strtolower(str_replace(' ', '_', $request->judul)); // Tambahkan baris ini


        $buku->save();

        if ($request->file('gallery')) {
            foreach ($request -> file('gallery') as $key => $file) {
                $fileName = time().'_'.$file -> getClientOriginalName();
                $filepath = $file -> storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'.$filepath,
                    'galeri_seo' => strtolower(str_replace(' ', '-', $fileName)),
                    'foto' => $fileName,
                    'buku_id' => $buku->id
                ]);
            }
        }

        
        return redirect('/buku')->with('pesan', 'Data Buku berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        try {
            $filename = time().'_'.$request->file('thumbnail')->getClientOriginalName();
            $filepath = $request->file('thumbnail')->storeAs('uploads', $filename, 'public');


            Image::make(storage_path().'/app/public/uploads/'.$filename)
                -> fit(240,320)
                -> save();

            $buku->update([
                'filename' => $filename,
                'filepath' => $filepath,
            ]);
        } catch (\Throwable $th) {

        }
        

        $buku->update([
            'judul'     => $request->judul,
            'penulis'   => $request->penulis,
            'harga'     => $request->harga,
            'tgl_terbit'=> $request->tgl_terbit,
        ]);

        if ($request->file('gallery')) {
            foreach ($request -> file('gallery') as $key => $file) {
                $fileName = time().'_'.$file -> getClientOriginalName();
                $filepath = $file -> storeAs('uploads', $fileName, 'public');

                $gallery = Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/'.$filepath,
                    'galeri_seo' => strtolower(str_replace(' ', '-', $fileName)),
                    'foto' => $fileName,
                    'buku_id' => $id
                ]);
            }
        }

        
        return redirect('/buku')->with('pesan', 'Data Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();
        return redirect('/buku')->with('pesan_danger', 'Data Buku berhasil dihapus');
    }


    /**
     * Remove the specified image gallery
     */
    public function deleteGallery($id, $img_id)
    {
        $gallery = Gallery::find($img_id);
        $gallery->delete();
        return redirect('/buku/edit/'.$id)->with('pesan_danger', 'Data Gambar berhasil dihapus');
    }


    /*
    * Display the specified resource.
    */
    public function galeribuku($buku_seo)
    {
        $buku = Buku::where('buku_seo', $buku_seo)->first();
        $rating = RatingModel::where('buku_id', $buku->id)->avg('rating');
        if($rating == 0 || $rating == null) {
            $rating = "Rating is not available";
        } else {
            $rounded_rating = round($rating, 2);
            // join string with 'out of 5'
            $rating = $rounded_rating . ' out of 5';
        }
        $galeri = $buku->galleries()->orderBy('id', 'desc')->paginate(6);
        return view('buku.detail_buku', compact('buku', 'galeri', 'rating'));
    }


    public function rateDisBook(Request $request, $buku_id)
    {
        $buku = Buku::find($buku_id);
        $rating = RatingModel::create([
            'rating' => $request->rating,
            'buku_id' => $buku_id,
        ]);

        $buku->update([
            'rating' => $buku->rating()->avg('rating')
        ]);

        return redirect()->back()->with('pesan', 'Terima kasih atas ratingnya');
    }

    public function myFavourite()
    {
        $userFavoritesBook = FavoritesModel::where('user_id', auth()->user()->id)->get();
        $data_buku = [];
        foreach ($userFavoritesBook as $key => $value) {
            $data_buku[] = Buku::find($value->buku_id);
        }
        return view('buku.favorites', compact('data_buku'));
    }

    public function addFavorites($buku_id) {

        $check = FavoritesModel::where('user_id', auth()->user()->id)->where('buku_id', $buku_id)->first();
        if($check) {
            return redirect()->back();
        }

        $favorites = FavoritesModel::create([
            'user_id' => auth()->user()->id,
            'buku_id' => $buku_id,
        ]);

        return redirect()->back();
    }
}
