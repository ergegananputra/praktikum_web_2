<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style_tugas3.css">
    <title>Tugas Praktikum 3</title>
</head>
<body>
    @yield('title_appbar')
    <div class="card">
        <div class="container">
            <div class="card_title">This is an {{$satu}} Card</div>
            <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum magnam rerum, nam repellat facere iusto inventore, provident eius qui placeat nisi accusamus expedita veritatis commodi neque totam repellendus ratione? Dolorum!</div>
        </div>
        @yield('button_1')
    </div>

    <div class="card">
        <div class="container">
            <div class="card_title">This is an {{$dua}} Card</div>
            <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum magnam rerum, nam repellat facere iusto inventore, provident eius qui placeat nisi accusamus expedita veritatis commodi neque totam repellendus ratione? Dolorum!</div>
        </div>
        @yield('button_2')
    </div>

    <div class="card">
        <div class="container">
            <div class="card_title">This is a {{$tiga}} Card</div>
            <div class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum magnam rerum, nam repellat facere iusto inventore, provident eius qui placeat nisi accusamus expedita veritatis commodi neque totam repellendus ratione? Dolorum!</div>
        </div>
        @yield('button_3')
    </div>

    <script src="js/script_tugas3.js"></script>
</body>
</html>