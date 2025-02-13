<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hugo_img = public_path('img/business_logos/butcher_shops/hugo.png');
        $hugo_business_img = new UploadedFile($hugo_img, 'hugo_business_img');
        $hugo_image_path = $hugo_business_img->store('businesses_logos', 'public');

        $hugo_front_img = public_path('img/business_front_pages/loDeHugo.jpg');
        $hugo_front_img = new UploadedFile($hugo_front_img, 'hugo_front_img');
        $hugo_front_image_path = $hugo_front_img->store('businesses_fronts', 'public');

        $los_chinitos_img = public_path('img/business_logos/butcher_shops/los_chinitos.png');
        $los_chinitos_business_img = new UploadedFile($los_chinitos_img, 'los_chinitos_business_img');
        $los_chinitos_image_path = $los_chinitos_business_img->store('businesses_logos', 'public');

        $los_chinitos_front_img = public_path('img/business_front_pages/losChinitos.jpg');
        $los_chinitos_front_img = new UploadedFile($los_chinitos_front_img, 'los_chinitos_front_img');
        $los_chinitos_front_image_path = $los_chinitos_front_img->store('businesses_fronts', 'public');

        $la_verdura_img = public_path('img/business_logos/grocery_stores/la_verdura.png');
        $la_verdura_business_img = new UploadedFile($la_verdura_img, 'la_verdura_business_img');
        $la_verdura_image_path = $la_verdura_business_img->store('businesses_logos', 'public');

        $la_verdura_front_img = public_path('img/business_front_pages/laVerdura.jpg');
        $la_verdura_front_img = new UploadedFile($la_verdura_front_img, 'la_verdura_front_img');
        $la_verdura_front_image_path = $la_verdura_front_img->store('businesses_fronts', 'public');

        $verduleria_peñaflor_img = public_path('img/business_logos/grocery_stores/verduleria_peñaflor.png');
        $verduleria_peñaflor_business_img = new UploadedFile($verduleria_peñaflor_img, 'verduleria_peñaflor_business_img');
        $verduleria_peñaflor_image_path = $verduleria_peñaflor_business_img->store('businesses_logos', 'public');

        $verduleria_peñaflor_front_img = public_path('img/business_front_pages/verduleriaPeñaflor.jpg');
        $verduleria_peñaflor_front_img = new UploadedFile($verduleria_peñaflor_front_img, 'verduleria_peñaflor_front_img');
        $verduleria_peñaflor_front_image_path = $verduleria_peñaflor_front_img->store('businesses_fronts', 'public');

        $d_agostino_img = public_path('img/business_logos/wineries/d_agostino.png');
        $d_agostino_business_img = new UploadedFile($d_agostino_img, 'd_agostino_business_img');
        $d_agostino_image_path = $d_agostino_business_img->store('businesses_logos', 'public');

        $d_agostino_front_img = public_path('img/business_front_pages/dangostino.jpg');
        $d_agostino_front_img = new UploadedFile($d_agostino_front_img, 'd_agostino_front_img');
        $d_agostino_front_image_path = $d_agostino_front_img->store('businesses_fronts', 'public');

        $dupont_img = public_path('img/business_logos/wineries/dupont.png');
        $dupont_business_img = new UploadedFile($dupont_img, 'dupont_business_img');
        $dupont_image_path = $dupont_business_img->store('businesses_logos', 'public');

        $dupont_front_img = public_path('img/business_front_pages/dupont.jpg');
        $dupont_front_img = new UploadedFile($dupont_front_img, 'dupont_front_img');
        $dupont_front_image_path = $dupont_front_img->store('businesses_fronts', 'public');

        DB::table('businesses')->insert([
            [
                'name' => 'Lo de Hugo',
                'logo' => $hugo_image_path,
                'street' => 'Liniers',
                'number' => 483,
                'category' => 'butcher_shop',
                'fk_businesses_users' => 2,
                'frontPage' => $hugo_front_image_path,
            ],
            [
                'name' => 'Los Chinitos',
                'logo' => $los_chinitos_image_path,
                'street' => 'Libertador',
                'number' => 1000,
                'category' => 'butcher_shop',
                'fk_businesses_users' => 3,
                'frontPage' => $los_chinitos_front_image_path,
            ],
            [
                'name' => 'La Verdura',
                'logo' => $la_verdura_image_path,
                'street' => 'La Plata',
                'number' => 255,
                'category' => 'grocery_store',
                'fk_businesses_users' => 4,
                'frontPage' => $la_verdura_front_image_path,
            ],
            [
                'name' => 'Verdulería Peñaflor',
                'logo' => $verduleria_peñaflor_image_path,
                'street' => 'Libertador',
                'number' => 5936,
                'category' => 'grocery_store',
                'fk_businesses_users' => 5,
                'frontPage' => $verduleria_peñaflor_front_image_path,
            ],
            [
                'name' => "D'agostino",
                'logo' => $d_agostino_image_path,
                'street' => 'Colon',
                'number' => 770,
                'category' => 'winery',
                'fk_businesses_users' => 6,
                'frontPage' => $d_agostino_front_image_path,
            ],
            [
                'name' => 'Dupont',
                'logo' => $dupont_image_path,
                'street' => 'Mariano Acha',
                'number' => 2170,
                'category' => 'winery',
                'fk_businesses_users' => 7,
                'frontPage' => $dupont_front_image_path,
            ],
        ]);
    }
}
