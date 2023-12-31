<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Masukan sini bisa
    Route::get('/buku', [BookController::class, 'index'])->name('buku');
    Route::get('/buku/search', [BookController::class, 'search'])->name('buku.search');

    Route::middleware('admin')->group(function () {
        Route::post('/buku/delete/{id}', [BookController::class, 'destroy'])->name('buku.destroy');
        Route::get('/buku/create', [BookController::class, 'create'])->name('buku.create');
        Route::get('/buku/edit/{id}', [BookController::class, 'edit'])->name('buku.edit');
        Route::post('/buku/update/{id}', [BookController::class, 'update'])->name('buku.update');
        Route::post('/buku', [BookController::class, 'store']) -> name('buku.store');
    });
});

require __DIR__.'/auth.php';


