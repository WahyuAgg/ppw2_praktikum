<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\PostController;
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

use App\Http\Controllers\HomeController;
// imports the HomeController class.

Route::get('/home', [HomeController::class, 'index']);
// Kode diatas maksudnya adalah pada saat url /blog diakes pada web browser
// maka method/function index() pada HomeController.php akan dijalankan.

Route::get('/buku', [BukuController::class, 'index']);
