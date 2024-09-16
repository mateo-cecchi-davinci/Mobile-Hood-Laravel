<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'name' => 'Carne',
                'parent_id' => null,
                'fk_categories_buisnesses' => 1,
            ],
            [
                'name' => 'Carne de vaca',
                'parent_id' => '1',
                'fk_categories_buisnesses' => 1,
            ],
            [
                'name' => 'Carne de cerdo',
                'parent_id' => '1',
                'fk_categories_buisnesses' => 1,
            ],
            [
                'name' => 'Carbón',
                'parent_id' => null,
                'fk_categories_buisnesses' => 1,
            ],
            [
                'name' => 'Maderitas',
                'parent_id' => null,
                'fk_categories_buisnesses' => 1,
            ],
            [
                'name' => 'Carne',
                'parent_id' => null,
                'fk_categories_buisnesses' => 2,
            ],
            [
                'name' => 'Carne de vaca',
                'parent_id' => '6',
                'fk_categories_buisnesses' => 2,
            ],
            [
                'name' => 'Carne de cerdo',
                'parent_id' => '6',
                'fk_categories_buisnesses' => 2,
            ],
            [
                'name' => 'Carbón',
                'parent_id' => null,
                'fk_categories_buisnesses' => 2,
            ],
            [
                'name' => 'Maderitas',
                'parent_id' => null,
                'fk_categories_buisnesses' => 2,
            ],
            [
                'name' => 'Fruta',
                'parent_id' => null,
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Verdura',
                'parent_id' => null,
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Aceite',
                'parent_id' => null,
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Aceite de Girasol',
                'parent_id' => '13',
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Aceite de Oliva',
                'parent_id' => '13',
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Huevos',
                'parent_id' => null,
                'fk_categories_buisnesses' => 3,
            ],
            [
                'name' => 'Fruta',
                'parent_id' => null,
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Verdura',
                'parent_id' => null,
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Aceite',
                'parent_id' => null,
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Aceite de Girasol',
                'parent_id' => '19',
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Aceite de Oliva',
                'parent_id' => '19',
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Huevos',
                'parent_id' => null,
                'fk_categories_buisnesses' => 4,
            ],
            [
                'name' => 'Malbec',
                'parent_id' => null,
                'fk_categories_buisnesses' => 5,
            ],
            [
                'name' => 'Blanco',
                'parent_id' => null,
                'fk_categories_buisnesses' => 5,
            ],
            [
                'name' => 'Rosado',
                'parent_id' => null,
                'fk_categories_buisnesses' => 5,
            ],
            [
                'name' => 'Syrah',
                'parent_id' => null,
                'fk_categories_buisnesses' => 5,
            ],
            [
                'name' => 'Champagne',
                'parent_id' => null,
                'fk_categories_buisnesses' => 5,
            ],
            [
                'name' => 'Malbec',
                'parent_id' => null,
                'fk_categories_buisnesses' => 6,
            ],
            [
                'name' => 'Blanco',
                'parent_id' => null,
                'fk_categories_buisnesses' => 6,
            ],
            [
                'name' => 'Rosado',
                'parent_id' => null,
                'fk_categories_buisnesses' => 6,
            ],
            [
                'name' => 'Syrah',
                'parent_id' => null,
                'fk_categories_buisnesses' => 6,
            ],
            [
                'name' => 'Champagne',
                'parent_id' => null,
                'fk_categories_buisnesses' => 6,
            ],
        ]);
    }
}
