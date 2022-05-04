<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $table = "playlist";

    // public function scopeJoinFavorites($query){
    //     return $query->join('favorites_songs', 'song.id', 'id_song')
    //         ->join('account', 'id_account', 'account.id');
    // }

    //para pillar todas las canciones de una playlist
    public function songs(){
        return $this->belongsToMany(Song::class, 'song_x_playlist');
    }
}
