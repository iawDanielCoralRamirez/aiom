<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Song_x_artist;
use Illuminate\Http\Request;

class Player extends Controller
{
    private $song;
    private $playedSong;
    private $songXartist;
    private $query;
    
    function __construct()
    {
        $this->song = new Song();
        $this->songXartist = new Song_x_artist();
        $this->query = $this->songXartist->query();
    }

    function playSong($idSong){
        // $this->playedSong = Song::find($idSong);
        $this->playedSong = $this->songXartist->songsArtists($this->query)
        ->where('id_song',$idSong)
        ->get()->first();
        return view("player")
            ->with("song", $this->playedSong);
    }

}
