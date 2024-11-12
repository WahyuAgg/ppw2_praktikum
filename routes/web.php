<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
// use App\Http\Middleware\CheckUserLevel;

use App\Http\Controllers\Auth\LoginRegisterController;



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

// ROUTE DOMAIN
Route::get('/', function (){
    return view('welcome');
})->name('welcome');


// Home & About
Route::get('/about', function(){
    return view('about', [
        'name' => 'Antony santos',
        'email' => 'elgasing@gmail.com'
    ]);
});

Route::get('/home', [HomeController::class, 'index']);



// Group route BukuController
Route::controller(BukuController::class)->group(function () {
    // Rute untuk menampilkan semua data buku
    Route::get('/buku', 'index')->name('buku.index');

});

// Group route BukuController
Route::controller(BukuController::class)->group(function () {

    // route untuk menampilkan halaman create untuk menambah buku
    Route::get('/buku/create', 'create')->name('buku.create');

    // route menyimpan data buku setelah form create di-submit
    Route::post('/buku', 'store')->name('buku.store');

    // route menghapus buku berdasarkan ID
    Route::delete('/buku/{id}', 'destroy')->name('buku.destroy');

    // route untuk menampilkan halaman edit
    Route::get('/buku/{id}/edit', 'edit')->name('buku.edit');

    // route memperbarui data buku berdasarkan ID
    Route::put('/buku/{id}', 'update')->name('buku.update');
});

// group route for LoginRegisterController
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    // Route::post('store', 'store')->name('store');
    Route::get('login', 'login')->name('login');
    Route::post('authenticate', 'authenticate')->name('authenticate');
    Route::get('dashboard', 'dashboard')->name('dashboard');
    Route::post('logout', 'logout')->name('logout');
});


// menerapkan middleware ke route
Route::get('restricted', function () {
    return redirect()->route('dashboard')->withSuccess("Anda berusia lebih dari 18 tahun!");
})->middleware('checkage');



// route dashboard admin menggunakan checkUserLevel
Route::get('admin/dashboard', function () {
    return view('dashboard_admin');
})->middleware('checkUserLevel:' . App\Models\User::LEVEL_ADMIN);


use App\Http\Controllers\GalleryController;

Route::controller(GalleryController::class)->group(function () {

    Route::get('/gallery', 'index')->name('gallery.index');

    Route::get('/gallery/create', 'create')->name('gallery.create');

    Route::post('/gallery', 'store')->name('gallery.store');

    Route::delete('/gallery/{id}', 'destroy')->name('gallery.destroy');

    Route::get('/gallery/{id}/edit', 'edit')->name('gallery.edit');

    Route::put('/gallery/{id}', 'update')->name('gallery.update');
});



