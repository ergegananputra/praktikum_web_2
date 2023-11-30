@extends('layouts.app')

@section('content')
    <br>
    <div class="d-flex flex-column align-items-center">

        @if (Session::has('pesan'))
            <div class="alert alert-success container-fluid">{{Session::get('pesan')}}</div>
        @endif
        @if (Session::has('pesan_danger'))
            <div class="alert alert-danger container-fluid">{{Session::get('pesan_danger')}}</div>
        @endif

        {{-- Tugas Pertemuan 8 Menambah Fitur Search --}}
        <form action="{{route('buku.search')}}" method="get" class="container">
            <div class="input-group">
                <input type="text" class="form-control" name="kata" placeholder="Cari ...">
                <button class="btn btn-outline-secondary" type="submit" id="button-search">Cari</button>
            </div>
        </form>


        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">GAMBAR</th>
                    <th scope="col">JUDUL BUKU</th>
                    <th scope="col">RATING</th>
                    <th scope="col">PENULIS</th>
                    <th scope="col">HARGA</th>
                    <th scope="col">TGL TERBIT</th>
                    <th scope="col" colspan="1" style="text-align: center">DETAIL</th>
                    

                    
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <th scope="row">{{$buku->id}}</th>
                    @if ($buku->filepath)
                        <th scope="row">
                            <div>
                                <img 
                                    src="{{asset('storage/'.$buku->filepath)}}" 
                                    alt="" 
                                    class="h-full w-full object-cover object-center">
                            </div>
                        </th>
                    @else
                        <th></th>
                    @endif
                    <th scope="row">{{$buku->judul}}</th>
                    <th scope="row">{{$buku->rating}}</th>
                    <th scope="row">{{$buku->penulis}}</th>
                    <th scope="row">{{'Rp'.number_format($buku->harga, 2, ',', '.')}}</th>
                    <th scope="row">{{\Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</th>
                    <th scope="row">
                        <a href="{{ route('buku.detail', $buku->buku_seo)}}">
                            <button class="btn btn-primary">Detail</button>
                        </a> 
                    </th>

                    
                        
                </tr>
                @endforeach
            </tbody>
        </table>
    
    
         
        

    </div>
    
@endsection