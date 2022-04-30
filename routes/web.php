<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;

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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('perfil');
    })->name('dashboard');

    Route::get('/upload/song', function () {
        return view('upload_song');
    });
    Route::post('/addSong', [SongController::class, 'addSong'])->name('addSong');
    Route::get('/music', [SongController::class, 'index']);
});

require __DIR__ . '/auth.php';
