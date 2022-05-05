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
            ->where("id_account",auth()->user()->id)
            ->orWhere("id_account",null)
            ->select('song.*','id_account');
    }
    //select song.*, favorites_songs.id_account from song left join favorites_songs on song.id = favorites_songs.id_song where favorites_songs.id_account = 8 OR favorites_songs.id_account is NULL;
    //select * from song left join favorites_songs on song.id = favorites_songs.id_song where favorites_songs.id_account = 8 OR favorites_songs.id_account is NULL;

}
