<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/buku', [BookController::class, 'index']);
Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
Route::post('/buku', [BookController::class, 'store']) -> name('buku.store');

Route::post('/buku/delete/{id}', [BookController::class, 'destroy'])->name('buku.destroy');

Route::get('/buku/edit/{id}', [BookController::class, 'edit'])->name('buku.edit');
Route::post('/buku/update/{id}', [BookController::class, 'update'])->name('buku.update');