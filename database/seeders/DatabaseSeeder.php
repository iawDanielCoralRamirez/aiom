<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('account')->insert([
            'nick' => 'acuesta',
            'email' => 'adan@adan.com',
            'password' => Hash::make('adan')
        ]);
        DB::table('account')->insert([
            'nick' => 'dani',
            'email' => 'dani@dani.com',
            'password' => Hash::make('dani')
        ]);
        DB::table('song')->insert([
            'title' => 'catedral',
            'url' => 'Pöls - Instinto - 01 Catedral.mp3',
            'cover' => 'pols_instinto.jpg'
        ]);

        DB::table('song')->insert([
            'title' => 'instinto',
            'url' => 'Pöls - Instinto - 02 Instinto.mp3',
            'cover' => 'pols_instinto.jpg'
        ]);

        DB::table('song')->insert([
            'title' => 'no te preu',
            'url' => 'Pöls - Instinto - 03 No té preu.mp3',
            'cover' => 'pols_instinto.jpg'
        ]);

        DB::table('song')->insert([
            'title' => 'sigo aqui',
            'url' => 'Pöls - Instinto - 04 Sigo aquí.mp3',
            'cover' => 'pols_instinto.jpg'
        ]);

        DB::table('album')->insert([
            'name' => 'instinto',
            'cover' => null,
        ]);

        DB::table('artist')->insert([
            'name' => 'Pöls',
            'cover' => null,
        ]);


        DB::table('song_x_artist')->insert([
            'id_song' => 1,
            'id_artist' => 1,
        ]);

        DB::table('song_x_artist')->insert([
            'id_song' => 2,
            'id_artist' => 1,
        ]);

        DB::table('song_x_artist')->insert([
            'id_song' => 3,
            'id_artist' => 1,
        ]);

        DB::table('song_x_artist')->insert([
            'id_song' => 4,
            'id_artist' => 1,
        ]);

        DB::table('songs_x_album')->insert([
            'id_song' => 1,
            'id_album' => 1,
        ]);

        DB::table('songs_x_album')->insert([
            'id_song' => 2,
            'id_album' => 1,
        ]);

        DB::table('songs_x_album')->insert([
            'id_song' => 3,
            'id_album' => 1,
        ]);

        DB::table('songs_x_album')->insert([
            'id_song' => 4,
            'id_album' => 1,
        ]);
        DB::table('genres')->insert([
            'genre' => 'rock',
            'cover' => 'rock.img'
        ]);
        DB::table('music_x_genre')->insert([
            'id_genre' => 1,
            'id_song' => 1
        ]);
        DB::table('music_x_genre')->insert([
            'id_genre' => 1,
            'id_song' => 2
        ]);
        DB::table('music_x_genre')->insert([
            'id_genre' => 1,
            'id_song' => 3
        ]);
        DB::table('music_x_genre')->insert([
            'id_genre' => 1,
            'id_song' => 4
        ]);
        
    }
}
