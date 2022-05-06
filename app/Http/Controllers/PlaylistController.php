<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\Playlist;
use App\Models\Song_x_playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    private $playlist;
    // private $playlistsXAccount;

    public function __construct(){
        $this->playlist = new Playlist();
    }

    public function list() {
        $playlists = account::find(Auth::id())->playlists;
        return view("playlists")->with(['playlists' => $playlists]);
    }

    public function new(Request $request){
        $this->playlist->name = $request->nombre;
        $this->playlist->cover = null;
        $this->playlist->account_id = Auth::id();
        $this->playlist->save();

        return redirect('/playlists');

    }

    public function show($idPlaylist){
        $playlist = Playlist::find($idPlaylist);
        $songs = $playlist->songs; 
        return view('playlistSongs')->with('playlist', $playlist)->with('songs', $songs);
    }

    public function delete($idPlaylist){
        $playlist = Playlist::find($idPlaylist);
        $playlist->delete();
        return redirect('/playlists');
    }

    public function addSong(Request $request){
        $playlist = $request->playlist_id;
        $song = $request->song_id;
        $song_x_playlist = new Song_x_playlist();
        $song_x_playlist->song_id = $song;
        $song_x_playlist->playlist_id = $playlist;
        $song_x_playlist->save();
        dd($song);

        // $song_x_playlist->fillModel($song, $playlist);
        // $song_x_playlist->writeToDatabase();
       
       
    }

}
