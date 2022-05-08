<?php

use App\Http\Controllers\PlaylistController;
use App\Http\Resources\SongCollection;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/playlist/addSong', [PlaylistController::class, 'addSong'])->middleware('auth:sanctum');

Route::get('/songs', function (Request $request) {
    return new SongCollection(Song::all());
});