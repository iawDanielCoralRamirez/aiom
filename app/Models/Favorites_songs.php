<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites_songs extends Model
{
    use HasFactory;
    protected $table = "favorites_songs";

    public function scopeJoinFavorites($query){
        return $query->join('song', 'song.id', 'id_song')
            ->join('account', 'account.id', 'id_account');
    }
    public function scopeListFavorites($query){
        return $query->select('song.id','url','cover','title')->get();
    }
}
