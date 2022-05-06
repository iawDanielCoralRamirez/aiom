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

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function scopeTitle($query, $partOfTitle){
        return $query->where('title', 'like', '%'.$partOfTitle.'%');   
    }
}
