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
            ->join('account','account.id','song.account_id')
            ->join('music_x_genre','music_x_genre.id_song','song.id')
            ->join('genres','genres.id','music_x_genre.id_genre')
            ->where("id_account",auth()->user()->id)
            ->orWhere("id_account",null)
            ->where("account_id",auth()->user()->id)
            ->select('song.*','genres.genre','album.name AS album_name','artist.name AS artist_name','id_account','account_id');
    }
    public function scopeJoinOnlyFavorites($query){
        return $query->join('favorites_songs', 'song.id', 'id_song')
            ->join('songs_x_album','song.id','songs_x_album.id_song')
            ->join('album','album.id','songs_x_album.id_album')
            ->join('song_x_artist','song.id','song_x_artist.id_song')
            ->join('artist','artist.id','song_x_artist.id_artist')
            ->join('account','account.id','song.account_id')
            ->where("account_id",auth()->user()->id)
            ->select('song.*','album.name AS album_name','artist.name AS artist_name','id_account');
    }
    public function scopeGetQueue($query){
        return $query->join('songs_x_album','song.id','songs_x_album.id_song')
            ->join('album','album.id','songs_x_album.id_album')
            ->join('song_x_artist','song.id','song_x_artist.id_song')
            ->join('artist','artist.id','song_x_artist.id_artist')
            ->select('song.*','album.name AS album_name','artist.name AS artist_name');
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function scopeTitle($query, $partOfTitle){
        return $query->where('title', 'like', '%'.$partOfTitle.'%');   
    }
}
