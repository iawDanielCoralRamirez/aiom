<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use App\Models\Song_x_artist;
use Illuminate\Http\Request;

class Player extends Controller
{
    private $song;
    private $playedSong;
    private $songXartist;
    
    function __construct()
    {
        $this->song = new Song();
        $this->album = new Album();
        $this->songXartist = new Song_x_artist();
    }

    function playSong($idSong){
        // $this->playedSong = Song::find($idSong);
        $this->playedSong = $this->songXartist->songsArtists()
        ->where('song.id',$idSong)
        ->get()->first();
        return view("playerSong")
            ->with("song", $this->playedSong);
    }

    function queue(Request $request){
        $queue = $request->session()->get('queue', []);
        return json_encode($queue);
    }

    function playQueue(){
        return view("player");
    }

}
