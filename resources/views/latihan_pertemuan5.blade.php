<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/daftarbuku.css">
    <title>Latihan Pertemuan 5</title>
</head>
<body>
    @extends('mainStyle')
    
    <div class="d-flex flex-column align-items-center table_box">
        <h1 style="font-weight: 700">DAFTAR BUKU</h1>
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
                            <button onclick="return confirm('Yakin mau dihapus?')" class="aksi hapus">Hapus</button>
                        </form>
                    </th>
                    <th scope="row">
                        <a href="{{ route('buku.edit', $buku->id)}}">
                            <button class="aksi edit">Edit</button>
                        </a> 
                        
                </tr>
                @endforeach
            </tbody>
        </table>
    
    
        <p class="keterangan align-self-start">Total Jumlah buku : {{$total_buku}}</p>
        <p class="keterangan align-self-start">Total Harga buku : {{"Rp".number_format($total_harga, 2, ',', '.')}}</p>
    
        {{-- Pertemuan 6 --}}
        <div class="tombolTambahBuku">
            <a href="{{ route('buku.create')}} ">Tambah Buku</a>
        </div>

    </div>



</body>
</html>