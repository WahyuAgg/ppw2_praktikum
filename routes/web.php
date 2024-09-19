<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function (){
    return view('welcome');
});

Route::get('/about', function(){
    return view('about', [
        'name' => 'Antony santos',
        'email' => 'elgasing@gmail.com'
    ]);
});

Route::get('/posts', [PostController::class, 'index']);

Route::get('/home', [HomeController::class, 'index']);

// Pertemuan 5: Menampilkan semua data buku
Route::get('/buku', [BukuController::class, 'index']);

// Rute untuk menampilkan halaman create untuk menambah buku
Route::get('/buku/create',[BukuController::class,'create'])->name('buku.create');


// Rute Menyimpan data buku setelah form create di-submit
Route::post('/buku',[BukuController::class, 'store'])->name('buku.store');

// Rute Menghapus buku berdasarkan ID
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');


// Rute untuk menampilkan halaman edit
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

// Rute Memperbarui data buku berdasarkan ID
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

