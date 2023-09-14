<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/pertemuan5.css">
    <title>Latihan Pertemuan 5</title>
</head>
<body>

    <h1 style="text-align: center">Pertemuan 5: Eloquent - Model Laravel</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tgl. Terbit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_buku as $buku)
                <tr>
                    <td>{{$buku->id}}</td>
                    <td>{{$buku->judul}}</td>
                    <td>{{$buku->penulis}}</td>
                    <td>{{"Rp".number_format($buku->harga, 2, ',', '.')}}</td>
                    <td>{{\Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y')}}</td>
                    <td> <button class="button_aksi" onclick="#">Aksi</button> </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="keterangan">Total Jumlah buku : {{$total_buku}}</p>
        <p class="keterangan">Total Harga buku : {{"Rp".number_format($total_harga, 2, ',', '.')}}</p>
</body>
</html>