@extends('layouts.app')

@section('content')

    

    <div class="d-flex flex-column align-items-center table_box">
        <h1 style="font-weight: 700">DAFTAR BUKU</h1>

        @if (Session::has('pesan'))
            <div class="alert">{{Session::get('pesan')}}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">JUDUL BUKU</th>
                    <th scope="col">PENULIS</th>
                    <th scope="col">HARGA</th>
                    <th scope="col">TGL TERBIT</th>
                    <th scope="col" colspan="2" style="text-align: center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <th scope="row">{{$buku->id}}</th>
                    <th scope="row">{{$buku->judul}}</th>
                    <th scope="row">{{$buku->penulis}}</th>
                    <th scope="row">{{'Rp'.number_format($buku->harga, 2, ',', '.')}}</th>
                    <th scope="row">{{\Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</th>
                    <th scope="row">
                        <form action="{{ route('buku.destroy', $buku->id)}}" method="post">
                            @csrf
                            <button onclick="return confirm('Yakin mau dihapus?')" class="btn btn-danger">Hapus</button>
                        </form>
                    </th>
                    <th scope="row">
                        <a href="{{ route('buku.edit', $buku->id)}}">
                            <button class="btn btn-warning">Edit</button>
                        </a> 
                    </th>
                        
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $data_buku->links() }}</div>
        <div><strong>Jumlah Buku: {{$jumlah_buku}}</strong></div>
    
    
    
        {{-- Pertemuan 6 --}}
         <a href="{{ route('buku.create')}} " class="btn btn-primary">Tambah Buku</a>
        

    </div>


    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js' integrity='sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL' crossorigin='anonymous'></script>

@endsection