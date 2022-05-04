<?php

namespace App\Http\Controllers;

use App\Models\account;
use App\Models\Playlist;
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
        $songs = $playlist->songs; //AQUI HAY PROBLEMAS QUE RESOLVERÉ MAÑANA
        return view('playlistSongs')->with('playlist', $playlist)->with('songs', $songs);
    }

}
