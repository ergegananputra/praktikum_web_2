@extends('layouts.my_theme')

@section('content')

    <div class="d-flex flex-column align-items-center">
        <h1>EDIT BUKU</h1>
        <form action="{{route('buku.update', $buku->id)}}" method="POST" class="container">
            @csrf
            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" value="{{$buku->judul}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penulis" name="penulis" value="{{$buku->penulis}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" value="{{$buku->harga}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_terbit" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{$buku->tgl_terbit}}">
                </div>
            </div>
            <br>
            <div class="row justify-content-center">
                <a href="/buku" class="col-sm-2 btn btn-warning">Batal</a>
                <div class="col-sm-1"></div>
                <button type="submit" class="col-sm-2 btn btn-primary align-self-center">Simpan</button>
            </div>
        </form>
    </div>

@endsection