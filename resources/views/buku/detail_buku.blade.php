@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column align-items-center">
        <h1>DETAIL BUKU</h1>
        @if ($buku->filepath)
            <th scope="row">
                <div id="thumbnail_container">
                    <img 
                        src="{{asset('storage/'.$buku->filepath)}}" 
                        alt="" 
                        id="thumbnail_preview"
                        class="h-full w-full object-cover object-center">

                </div>
            </th>
        @endif
        
        <br>
        <div class="row w-100">
            <div class="col-2"><p><strong>Judul Buku</strong></p></div>
            <div class="col-4"><p>{{$buku->judul}}</p></div>
        </div>
        <div class="row w-100">
            <div class="col-2"><p><strong>Penulis</strong></p></div>
            <div class="col-4"><p>{{$buku->penulis}}</p></div>
        </div>
        <div class="row w-100">
            <div class="col-2"><p><strong>Harga</strong></p></div>
            <div class="col-4"><p>{{'Rp'.number_format($buku->harga, 2, ',', '.')}}</p></div>
        </div>
        <div class="row w-100">
            <div class="col-2"><p><strong>Tanggal Terbit</strong></p></div>
            <div class="col-4"><p>{{\Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</p></div>
        </div>

        <br>

        <label for="gallery" class="form-label">Gallery</label>

        <script src="{{asset('dist/js/lightbox-plus-jquery.min.js')}}"></script>
        
        <div class="d-flex flex-wrap gallery_items">
            @foreach($galeri as $data)
                <div class="gallery_item m-2" id="gallery_item_{{$data->id}}">
                    <a href="{{asset($data->path)}}"
                        data-lightbox="image-1" data-title="{{$data->keterangan}}">
                        <img 
                            src="{{asset($data->path)}}" 
                            alt="" 
                            width="400"
                            class="rounded-full img-thumbnail mx-auto d-block"/>
                    </a>
                </div>
            @endforeach
        </div>
        <div>{{ $galeri->links() }}</div>

        <br>
        {{-- RATING QUIZZ--}}
        <div class="row w-100">
            <div class="col-2"><p><strong>Rating Saat Ini :</strong></p></div>
            <div class="col-4"><p>{{$rating}}</p></div>
        </div>

        {{-- Form Rating --}}
        @if (Auth::user() != null)
            <form action="{{ route('buku.rating', $buku->id)}}" method="post">
                @csrf
                <div class="row w-100">
                    <div class="col-2"><p><strong>Rating Baru :</strong></p></div>
                    <div class="col-4">
                        <input type="number" name="rating" id="rating" min="0" max="5" step="1" value="0">
                    </div>
                </div>
                
                <div class="row w-100">
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </div>

            </form>
        @endif

        <br>
        <br>

        {{-- Add to favorites --}}
        @if (Auth::user() != null)
            <form action="{{ route('buku.addFavorite', $buku->id)}}" method="post">
                @csrf
                <div class="row w-100">
                    <button type="submit" class="btn btn-primary">Tambahkan Ke Favorites</button>
                </div>
            </form>
        @endif


        
        



        
    </div>



@endsection
