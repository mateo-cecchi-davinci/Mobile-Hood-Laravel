<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Mateo',
            'lastname' => 'Cecchi',
            'email' => 'cecchimateo@gmail.com',
            'phone' => '1123456734',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);
    }
}
