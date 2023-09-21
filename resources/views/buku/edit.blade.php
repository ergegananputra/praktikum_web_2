<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/tambahbuku.css">
    <title>Halaman Edit</title>
</head>
<body>
    @extends('../mainStyle')

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

            <div class="aksi row justify-content-around">
                <div class="align-self-center batal"><a href="/buku">Batal</a></div>
                <button type="submit" class="align-self-center simpan">Simpan</button>
            </div>

        </form>
        
    </div>


        
    
</body>
</html>