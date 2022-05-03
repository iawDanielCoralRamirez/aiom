<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song_x_artist extends Model
{
    use HasFactory;
    protected $table = "song_x_artist";

    public function scopeSongsArtists($query){
        return $query->join('song', 'song.id','id_song')
        ->join('artist', 'artist.id', 'id_artist')
        ->select('song.id','song.cover', 'name', 'url', 'title');   
    }
}
