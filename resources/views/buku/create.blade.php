
@extends('layouts.app')

@section('content')
    


    <div class="d-flex flex-column align-items-center">
        <h1>TAMBAH BUKU</h1>
        <form action="{{route('buku.store')}}" method="post" class="container" enctype="multipart/form-data">
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

            <div class="form-group row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail">
                </div>
            </div>
            
            {{-- Gallery --}}

            <div class="mt-3">
                <label for="gallery" class="form-label">Gallery</label>
                <div class="d-flex flex-wrap" id="fileinput_wrapper">
                    <!-- File input goes here -->
                </div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()" class="btn btn-primary">Tambah</a>
                <script type="text/javascript">
                    function addFileInput () {
                        var div = document.getElementById('fileinput_wrapper');
                        var divPhotos = document.getElementById('new_photos_wrapper');

                        var fileInput = document.createElement('input');
                        fileInput.type = 'file';
                        fileInput.name = 'gallery[]';
                        fileInput.id = 'gallery';
                        fileInput.className = 'form-control mb-3';
                        fileInput.style.marginBottom = '5px';
                        fileInput.onchange = function (event) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'rounded-full img-thumbnail mx-auto d-block gallery_item';
                                img.width = 400;
                                divPhotos.appendChild(img);
                            }
                            reader.readAsDataURL(event.target.files[0]);
                        };
                        div.appendChild(fileInput);
                    };
                </script>
            </div>
            <br>

            <div class="d-flex flex-wrap gallery_items" id="new_photos_wrapper">
                <!-- File input goes here -->
            </div>

            <br>
            <div class="row justify-content-center">
                <a href="/buku" class="col-sm-2  btn btn-danger">Batal</a>
                <div class="col-sm-1"></div>
                <button type="submit" class="col-sm-2  btn btn-primary">Simpan</button>
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
    
