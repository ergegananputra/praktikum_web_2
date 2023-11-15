@extends('layouts.app')

@section('content')

    <div class="d-flex flex-column align-items-center">
        <h1>EDIT BUKU</h1>
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

        <form action="{{route('buku.update', $buku->id)}}" method="POST" class="container" enctype="multipart/form-data">
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

            <div class="form-group row">
                <label for="thumbnail" class="col-sm-2 col-form-label">Thumbnail</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="thumbnail" name="thumbnail" onclick="previewThumbnail(event)">
                    <script type="text/javascript">
                        function previewThumbnail(event) {
                            var divPhotos = document.getElementById('thumbnail_container');
                            var fileInput = document.getElementById('thumbnail');
                            fileInput.onchange = function (event) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                var img = document.createElement('img');
                                img.src = e.target.result;
                                img.className = 'rounded-full img-thumbnail mx-auto d-block gallery_item';
                                img.width = 400;
                                divPhotos.innerHTML = '';
                                divPhotos.appendChild(img);
                            }
                            reader.readAsDataURL(event.target.files[0]);
                            };
                        }
                    </script>
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

            <div class="d-flex flex-wrap gallery_items">
                <script type="text/javascript">
                    function deleteImage(event, buku_id, id) {
                        event.preventDefault();
                        var confirmation = confirm('Yakin mau dihapus?');
                        if (confirmation) {
                            var form = document.getElementById('deleteForm');
                            form.action = "/buku/edit/"+ buku_id + "/gallery/delete/"  + id;;
                            form.submit();

                            var container = document.getElementById('gallery_item_'+id);
                            container.remove();
                        }
                    }
                </script>
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item m-2" id="gallery_item_{{$gallery->id}}">
                        <img
                            class="rounded-full img-thumbnail mx-auto d-block"
                            src="{{ asset($gallery->path) }}"
                            alt=""
                            width="400"
                            />

                        <a class="btn btn-danger w-100" href="javascript:void(0);" onclick="deleteImage(event, {{$buku->id}}, {{$gallery->id}})">Hapus</a>
                            
                    

                    </div>
                @endforeach
            </div>

            <br>

            <div class="row justify-content-center w-100">
                <a href="/buku" class="col-2 btn btn-warning mr-2">Batal</a>
                <button type="submit" class="col-2 btn btn-primary align-self-center mr-2">Simpan</button>
            </div>

        </form>
    </div>

    <form id="deleteForm" action="" method="post" style="display:none">
        @csrf
    </form>

@endsection

            {{-- <div class="col-span-full mt-6">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">

                </div>
                <a href="javascript:void(0);" id="tambah" onclick="addFileInput()">Tambah</a>
                <script type="text/javascript">
                    function addFileInput () {
                        var div = document.getElementById('fileinput_wrapper');
                        div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
                    };
                </script>
            </div>
            <div class="gallery_items">
                @foreach($buku->galleries()->get() as $gallery)
                    <div class="gallery_item">
                        <img
                        class="rounded-full object-cover object-center"
                        src="{{ asset($gallery->path) }}"
                        alt=""
                        width="400"
                        />
                    </div>
                @endforeach
            </div> --}}

            {{-- End Gallery --}}