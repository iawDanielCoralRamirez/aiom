<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = "song";

    public function scopeJoinFavorites($query){
        return $query->Leftjoin('favorites_songs', 'song.id', 'id_song')
            ->join('songs_x_album','song.id','songs_x_album.id_song')
            ->join('album','album.id','songs_x_album.id_album')
            ->join('song_x_artist','song.id','song_x_artist.id_song')
            ->join('artist','artist.id','song_x_artist.id_artist')
            ->where("id_account",auth()->user()->id)
            ->orWhere("id_account",null)
            ->select('song.*','album.name AS album_name','artist.name AS artist_name','id_account');
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function scopeTitle($query, $partOfTitle){
        return $query->where('title', 'like', '%'.$partOfTitle.'%');   
    }
}
