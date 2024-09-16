<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Mateo',
                'lastname' => 'Cecchi',
                'email' => 'cecchimateo@gmail.com',
                'phone' => '1123456734',
                'password' => bcrypt('12345678'),
                'is_manager' => false,
                'is_admin' => true,
            ],
            [
                'name' => 'Pepe',
                'lastname' => 'Ojeda',
                'email' => 'pepeojeda@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ],
            [
                'name' => 'Daniel',
                'lastname' => 'Molina',
                'email' => 'danielmolina@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ],
            [
                'name' => 'Paco',
                'lastname' => 'Perez',
                'email' => 'pacoperez@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ],
            [
                'name' => 'Lolo',
                'lastname' => 'Ayala',
                'email' => 'loloayala@gmail.com',
                'phone' => '1123456734',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ],
            [
                'name' => 'Juan',
                'lastname' => 'Ugarte',
                'email' => 'juanugarte@gmail.com',
                'phone' => '1123456734',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ],
            [
                'name' => 'Pedro',
                'lastname' => 'Contreras',
                'email' => 'pedrocontreras@gmail.com',
                'phone' => '12345678',
                'password' => bcrypt('12345678'),
                'is_manager' => true,
                'is_admin' => false,
            ]
        ]);
    }
}
