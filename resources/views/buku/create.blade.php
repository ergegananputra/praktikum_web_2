
@extends('layouts.app')

@section('content')
    


    <div class="d-flex flex-column align-items-center">
        <h1>TAMBAH BUKU</h1>

        <form action="{{route('buku.store')}}" method="post" class="form_tambah_buku">
            @csrf
            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul buku..">
                </div>
            </div>
            <div class="form-group row">
                <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Penulis buku..">
                </div>
            </div>
            <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Harga buku..">
                </div>
            </div>
            <div class="form-group row">
                <label for="tgl_terbit" class="col-sm-2 col-form-label">Tanggal Terbit</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" placeholder="Tanggal terbit buku..">
                </div>
            </div>

            <div class="row">
                <a href="/buku" class="col  btn btn-danger">Batal</a>
                <button type="submit" class="col  btn btn-primary">Simpan</button>
            </div>
            @if (count($errors) > 0)
            <br>
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif

            

            

        </form>
        
    </div>

@endsection
    
