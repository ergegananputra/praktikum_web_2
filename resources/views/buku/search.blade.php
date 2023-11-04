@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column align-items-center">
        @if (count($data_buku)>0)
            <div class="alert alert-success container-fluid">Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{$cari}}</strong></div>
            
            <form action="{{route('buku.search')}}" method="get" class="container">
                <div class="input-group">
                    <input type="text" class="form-control" name="kata" placeholder="Cari ..." value="{{$cari}}">
                    <a href="/buku" class="btn btn-outline-danger">Hapus Filter</a>
                    <button class="btn btn-outline-secondary" type="submit" id="button-search">Cari</button>
                </div>
            </form>
            
            <br>

            {{-- Tambahan untuk menampilkan data --}}
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">JUDUL BUKU</th>
                        <th scope="col">PENULIS</th>
                        <th scope="col">HARGA</th>
                        <th scope="col">TGL TERBIT</th>
                        @if (Auth::user()->level == 'admin')
                            <th scope="col" colspan="2" style="text-align: center">AKSI</th>
                         @endif

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
                        @if (Auth::user()->level == 'admin')
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
                    @endif
                            
                    </tr>
                    @endforeach
                </tbody>
            </table>


            
        @else
            <div class="alert alert-warning container-fluid">
                <h4>Data {{$cari}} tidak ditemukan</h4>
                <a href="/buku" class="btn btn-warning">Kembali</a>
            </div>
        @endif
    </div>

@endsection