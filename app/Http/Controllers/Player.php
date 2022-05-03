<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class Player extends Controller
{
    private $song;
    
    function __construct()
    {
        $this->song = new Song();
    }

    function playSong($idSong){
        
    }

}
