@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column align-items-center">
        <h1>EDIT BUKU</h1>
        <form action="{{route('buku.update', $buku->id)}}" method="POST" class="form_tambah_buku">
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

            <div class="row justify-content-around">
                <div class="btn btn-warning"><a href="/buku">Batal</a></div>
                <button type="submit" class="btn btn-primary align-self-center">Simpan</button>
            </div>
        </form>
    </div>

@endsection