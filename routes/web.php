<?php

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

Route::get('/home', function(){
    return view('home');
});