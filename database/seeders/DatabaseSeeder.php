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

        DB::table('album')->insert([
            'name' => 'instinto',
            'cover' => null,
        ]);

        DB::table('album')->insert([
            'name' => 'instinto',
            'cover' => null,
        ]);

        DB::table('album')->insert([
            'name' => 'instinto',
            'cover' => null,
        ]);

        DB::table('artist')->insert([
            'name' => 'Pöls',
            'cover' => null,
        ]);

        DB::table('artist')->insert([
            'name' => 'Pöls',
            'cover' => null,
        ]);

        DB::table('artist')->insert([
            'name' => 'Pöls',
            'cover' => null,
        ]);

        DB::table('artist')->insert([
            'name' => 'Pöls',
            'cover' => null,
        ]);
    }
}
