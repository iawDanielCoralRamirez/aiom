<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = "song";



    public function scopeJoinFavorites($query){
        return $query->join('favorites_songs', 'song.id', 'id_song')
            ->join('account', 'id_account', 'account.id');
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
}
