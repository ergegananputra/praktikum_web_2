<?php

use App\Http\Controllers\Pertemuan4Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about',[
        "name" => "lala",
        "email" => "lala@gmail.com"
    ]);
});

$data_saya = [
    'satu' => "Admin",
    'dua' => "User",
    'tiga' => "Guest"
];

Route::get('/tugas', function () use($data_saya) {
    return view('template3', $data_saya);
});


Route::get('/controllerAbout', [PostController::class, 'panggilAbout']);

Route::get('/pertemuan_4', [Pertemuan4Controller::class, 'index']);
Route::get('/pertemuan_4_satunya', [Pertemuan4Controller::class, 'tesDariController']);
Route::get('/buku', [BookController::class, 'index']);