<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 7; $i++) {
            DB::table('locations')->insert([
                [
                    'lat' => '-34.4376063',
                    'lng' => '-58.5625781',
                    'fk_locations_buisnesses' => $i
                ]
            ]);
        }
    }
}
