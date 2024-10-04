<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business_hours')->insert([
            [
                'day_of_week' => 0,
                'opening_time' => '07:00:00',
                'closing_time' => '13:00:00',
                'fk_business_hours_business' => 1
            ],
            [
                'day_of_week' => 3,
                'opening_time' => '07:00:00',
                'closing_time' => '15:00:00',
                'fk_business_hours_business' => 1
            ],
            [
                'day_of_week' => 4,
                'opening_time' => '07:00:00',
                'closing_time' => '15:00:00',
                'fk_business_hours_business' => 1
            ],
            [
                'day_of_week' => 5,
                'opening_time' => '07:00:00',
                'closing_time' => '18:00:00',
                'fk_business_hours_business' => 1
            ],
            [
                'day_of_week' => 6,
                'opening_time' => '07:00:00',
                'closing_time' => '18:00:00',
                'fk_business_hours_business' => 1
            ]
        ]);

        for ($i = 0; $i < 7; $i++) {
            DB::table('business_hours')->insert([
                [
                    'day_of_week' => $i,
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'fk_business_hours_business' => 2
                ]
            ]);
        }

        for ($i = 0; $i < 7; $i++) {
            DB::table('business_hours')->insert([
                [
                    'day_of_week' => $i,
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'fk_business_hours_business' => 3
                ]
            ]);
        }

        for ($i = 0; $i < 7; $i++) {
            DB::table('business_hours')->insert([
                [
                    'day_of_week' => $i,
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'fk_business_hours_business' => 4
                ]
            ]);
        }

        for ($i = 0; $i < 7; $i++) {
            DB::table('business_hours')->insert([
                [
                    'day_of_week' => $i,
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'fk_business_hours_business' => 5
                ]
            ]);
        }

        for ($i = 0; $i < 7; $i++) {
            DB::table('business_hours')->insert([
                [
                    'day_of_week' => $i,
                    'opening_time' => '07:00:00',
                    'closing_time' => '18:00:00',
                    'fk_business_hours_business' => 6
                ]
            ]);
        }
    }
}
