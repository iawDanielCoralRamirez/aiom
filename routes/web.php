<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/pruebas', function () {
    return view('perfil');
});

Route::get('/dashboard', function () {
    return view('perfil');
})->middleware(['auth'])->name('dashboard');

Route::get('/music', function () {
    return view('music');
})->middleware(['auth'])->name('music');

require __DIR__.'/auth.php';


