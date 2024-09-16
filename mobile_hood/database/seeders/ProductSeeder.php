<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Buisness;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([

            //------Primera Carniceria------

            [
                'model' => 'Nalga',
                'image' => '',
                'description' => 'Nalga entera x 1kg',
                'price' => 8300,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Tapa de Nalga',
                'image' => '',
                'description' => 'Tapa de Nalga entera x 1kg',
                'price' => 6000,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Peceto',
                'image' => '',
                'description' => 'Peceto Novillo x 1kg',
                'price' => 7900,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Colita de Cuadril',
                'image' => '',
                'description' => 'Colita de cuadril Novillo x 1kg',
                'price' => 10400,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Bola de Lomo',
                'image' => '',
                'description' => 'Bola de lomo x 1kg',
                'price' => 13200,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Tortuguita',
                'image' => '',
                'description' => 'Tortuguita Novillo x 1kg',
                'price' => 6000,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Osobuco',
                'image' => '',
                'description' => 'Osobuco x 1kg',
                'price' => 5500,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Tapa de Asado',
                'image' => '',
                'description' => 'Tapa de Asado x 1kg',
                'price' => 6200,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Marucha',
                'image' => '',
                'description' => 'Marucha Novillo x 1kg',
                'price' => 6500,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Lomo',
                'image' => '',
                'description' => 'Lomo x 1kg',
                'price' => 12000,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Ojo de Bife',
                'image' => '',
                'description' => 'Ojo de Bife Novillo',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Bife de Chorizo',
                'image' => '',
                'description' => 'Bife de Chorizo Novillo x 1kg',
                'price' => 9500,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Asado',
                'image' => '',
                'description' => 'Asado x 1kg',
                'price' => 10200,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Entraña',
                'image' => '',
                'description' => 'Estraña Novillito',
                'price' => 9990,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Matambre de Vaca',
                'image' => '',
                'description' => 'Matambre x 1kg',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Vacío',
                'image' => '',
                'description' => 'Vacío x 1kg',
                'price' => 9500,
                'brand' => 'N/A',
                'fk_products_categories' => 2,
            ],
            [
                'model' => 'Panceta ahumada',
                'image' => '',
                'description' => 'Panceta ahumada mini ev x 1kg',
                'price' => 20925,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Bondiola',
                'image' => '',
                'description' => 'Bondiola de Cerdo x 1kg',
                'price' => 6900,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Matambre de Cerdo',
                'image' => '',
                'description' => 'Matambre de Cerdo x 1kg',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Churrasco',
                'image' => '',
                'description' => 'Churrasquito x 1kg',
                'price' => 11655,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Pechito de Cerdo',
                'image' => '',
                'description' => 'Pechito de Cerdo x 1kg',
                'price' => 4700,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Paleta',
                'image' => '',
                'description' => 'Paleta de Cerdo x 1kg',
                'price' => 5000,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Lomo de Cerdo',
                'image' => '',
                'description' => 'Lomo de Cerdo x 1kg',
                'price' => 11900,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Cuadril de Cerdo',
                'image' => '',
                'description' => 'Cuadril de Cerdo x 1kg',
                'price' => 10400,
                'brand' => 'N/A',
                'fk_products_categories' => 3,
            ],
            [
                'model' => 'Bolsa de Carbón 4Kg',
                'image' => '',
                'description' => '',
                'price' => 3000,
                'brand' => 'N/A',
                'fk_products_categories' => 4,
            ],
            [
                'model' => 'Bolsa de Carbón 5Kg',
                'image' => '',
                'description' => '',
                'price' => 5317,
                'brand' => 'N/A',
                'fk_products_categories' => 4,
            ],
            [
                'model' => 'Maderitas para el asado',
                'image' => '',
                'description' => '',
                'price' => 2140,
                'brand' => 'N/A',
                'fk_products_categories' => 5,
            ],


            //------Segunda Carniceria------


            [
                'model' => 'Nalga',
                'image' => '',
                'description' => 'Nalga entera x 1kg',
                'price' => 8300,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Tapa de Nalga',
                'image' => '',
                'description' => 'Tapa de Nalga entera x 1kg',
                'price' => 6000,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Peceto',
                'image' => '',
                'description' => 'Peceto Novillo x 1kg',
                'price' => 7900,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Colita de Cuadril',
                'image' => '',
                'description' => 'Colita de cuadril Novillo x 1kg',
                'price' => 10400,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Bola de Lomo',
                'image' => '',
                'description' => 'Bola de lomo x 1kg',
                'price' => 13200,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Tortuguita',
                'image' => '',
                'description' => 'Tortuguita Novillo x 1kg',
                'price' => 6000,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Osobuco',
                'image' => '',
                'description' => 'Osobuco x 1kg',
                'price' => 5500,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Tapa de Asado',
                'image' => '',
                'description' => 'Tapa de Asado x 1kg',
                'price' => 6200,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Marucha',
                'image' => '',
                'description' => 'Marucha Novillo x 1kg',
                'price' => 6500,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Lomo',
                'image' => '',
                'description' => 'Lomo x 1kg',
                'price' => 12000,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Ojo de Bife',
                'image' => '',
                'description' => 'Ojo de Bife Novillo',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Bife de Chorizo',
                'image' => '',
                'description' => 'Bife de Chorizo Novillo x 1kg',
                'price' => 9500,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Asado',
                'image' => '',
                'description' => 'Asado x 1kg',
                'price' => 10200,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Entraña',
                'image' => '',
                'description' => 'Estraña Novillito',
                'price' => 9990,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Matambre de Vaca',
                'image' => '',
                'description' => 'Matambre x 1kg',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Vacío',
                'image' => '',
                'description' => 'Vacío x 1kg',
                'price' => 9500,
                'brand' => 'N/A',
                'fk_products_categories' => 7,
            ],
            [
                'model' => 'Panceta ahumada',
                'image' => '',
                'description' => 'Panceta ahumada mini ev x 1kg',
                'price' => 20925,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Bondiola',
                'image' => '',
                'description' => 'Bondiola de Cerdo x 1kg',
                'price' => 6900,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Matambre de Cerdo',
                'image' => '',
                'description' => 'Matambre de Cerdo x 1kg',
                'price' => 9600,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Churrasco',
                'image' => '',
                'description' => 'Churrasquito x 1kg',
                'price' => 11655,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Pechito de Cerdo',
                'image' => '',
                'description' => 'Pechito de Cerdo x 1kg',
                'price' => 4700,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Paleta',
                'image' => '',
                'description' => 'Paleta de Cerdo x 1kg',
                'price' => 5000,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Lomo de Cerdo',
                'image' => '',
                'description' => 'Lomo de Cerdo x 1kg',
                'price' => 11900,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Cuadril de Cerdo',
                'image' => '',
                'description' => 'Cuadril de Cerdo x 1kg',
                'price' => 10400,
                'brand' => 'N/A',
                'fk_products_categories' => 8,
            ],
            [
                'model' => 'Bolsa de Carbón 4Kg',
                'image' => '',
                'description' => '',
                'price' => 3000,
                'brand' => 'N/A',
                'fk_products_categories' => 9,
            ],
            [
                'model' => 'Bolsa de Carbón 5Kg',
                'image' => '',
                'description' => '',
                'price' => 5317,
                'brand' => 'N/A',
                'fk_products_categories' => 9,
            ],
            [
                'model' => 'Maderitas para el asado',
                'image' => '',
                'description' => '',
                'price' => 2140,
                'brand' => 'N/A',
                'fk_products_categories' => 10,
            ],


            //------Primera Verduleria------


            [
                'model' => 'Limón',
                'image' => '',
                'description' => 'Limón x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Mandarina',
                'image' => '',
                'description' => 'Mandarina x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Naranja',
                'image' => '',
                'description' => 'Naranja x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Pomelo',
                'image' => '',
                'description' => 'Pomelo x 1kg',
                'price' => 920,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Melon',
                'image' => '',
                'description' => 'Melon blanco x 1kg',
                'price' => 3999,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Sandía',
                'image' => '',
                'description' => 'Sandía x 1kg',
                'price' => 1499,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Kiwi',
                'image' => '',
                'description' => 'Kiwi x 1kg',
                'price' => 3199,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Banana',
                'image' => '',
                'description' => 'Banana x 1kg',
                'price' => 1839,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Pera',
                'image' => '',
                'description' => 'Pera x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Manzana',
                'image' => '',
                'description' => 'Manzana x 1kg',
                'price' => 1839,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Ciruela',
                'image' => '',
                'description' => 'Ciruela x 11kg',
                'price' => 3759,
                'brand' => 'N/A',
                'fk_products_categories' => 11,
            ],
            [
                'model' => 'Apio',
                'image' => '',
                'description' => 'Apio x 1kg',
                'price' => 3890,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Berenjena',
                'image' => '',
                'description' => 'Berenjena x 1kg',
                'price' => 2490,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Brócoli',
                'image' => '',
                'description' => 'Brócoli x 1kg',
                'price' => 4399,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Cebolla',
                'image' => '',
                'description' => 'Cebolla x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Repollo',
                'image' => '',
                'description' => 'Repollo x 1kg',
                'price' => 1999,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Champiñon',
                'image' => '',
                'description' => 'Champiñon Laminado Porto',
                'price' => 2319,
                'brand' => 'Porto',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Coliflor',
                'image' => '',
                'description' => 'Coliflor x 1kg',
                'price' => 5519,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Lechuga',
                'image' => '',
                'description' => 'Lechuga x 1kg',
                'price' => 2159,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Choclo',
                'image' => '',
                'description' => 'Choclo x Unidad',
                'price' => 2079,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Papa',
                'image' => '',
                'description' => 'Papa x 1kg',
                'price' => 1599,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Tomate',
                'image' => '',
                'description' => 'Tomate x 1kg',
                'price' => 3224,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Pepino',
                'image' => '',
                'description' => 'Pepino x 1kg',
                'price' => 2079,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Morrón',
                'image' => '',
                'description' => 'Morrón x 1kg',
                'price' => 5199,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Zanahoria',
                'image' => '',
                'description' => 'Zanahoria x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 12,
            ],
            [
                'model' => 'Natura 900ml',
                'image' => '',
                'description' => 'Aceite de Girasol Natura 900ml',
                'price' => 1866,
                'brand' => 'Natura',
                'fk_products_categories' => 14,
            ],
            [
                'model' => 'Natura',
                'image' => '',
                'description' => 'Aceite de Girasol Natura 1.5 L',
                'price' => 2995,
                'brand' => 'Natura',
                'fk_products_categories' => 14,
            ],
            [
                'model' => 'Cocinero',
                'image' => '',
                'description' => 'Aceite Oliva Extra Virgen Suave Cocinero 500ml',
                'price' => 8850,
                'brand' => 'Cocinero',
                'fk_products_categories' => 15,
            ],
            [
                'model' => 'Lira',
                'image' => '',
                'description' => 'Aceite Oliva Lira Extra Virgen Pet 500ml',
                'price' => 123,
                'brand' => 'Lira',
                'fk_products_categories' => 15,
            ],
            [
                'model' => 'Maple',
                'image' => '',
                'description' => 'Huevos Blancos Carnave Maples 30u',
                'price' => 6400,
                'brand' => 'N/A',
                'fk_products_categories' => 16,
            ],


            //------Segunda Verduleria------


            [
                'model' => 'Limón',
                'image' => '',
                'description' => 'Limón x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Mandarina',
                'image' => '',
                'description' => 'Mandarina x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Naranja',
                'image' => '',
                'description' => 'Naranja x 1kg',
                'price' => 890,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Pomelo',
                'image' => '',
                'description' => 'Pomelo x 1kg',
                'price' => 920,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Melon',
                'image' => '',
                'description' => 'Melon blanco x 1kg',
                'price' => 3999,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Sandía',
                'image' => '',
                'description' => 'Sandía x 1kg',
                'price' => 1499,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Kiwi',
                'image' => '',
                'description' => 'Kiwi x 1kg',
                'price' => 3199,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Banana',
                'image' => '',
                'description' => 'Banana x 1kg',
                'price' => 1839,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Pera',
                'image' => '',
                'description' => 'Pera x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Manzana',
                'image' => '',
                'description' => 'Manzana x 1kg',
                'price' => 1839,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Ciruela',
                'image' => '',
                'description' => 'Ciruela x 11kg',
                'price' => 3759,
                'brand' => 'N/A',
                'fk_products_categories' => 17,
            ],
            [
                'model' => 'Apio',
                'image' => '',
                'description' => 'Apio x 1kg',
                'price' => 3890,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Berenjena',
                'image' => '',
                'description' => 'Berenjena x 1kg',
                'price' => 2490,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Brócoli',
                'image' => '',
                'description' => 'Brócoli x 1kg',
                'price' => 4399,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Cebolla',
                'image' => '',
                'description' => 'Cebolla x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Repollo',
                'image' => '',
                'description' => 'Repollo x 1kg',
                'price' => 1999,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Champiñon',
                'image' => '',
                'description' => 'Champiñon Laminado Porto',
                'price' => 2319,
                'brand' => 'Porto',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Coliflor',
                'image' => '',
                'description' => 'Coliflor x 1kg',
                'price' => 5519,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Lechuga',
                'image' => '',
                'description' => 'Lechuga x 1kg',
                'price' => 2159,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Choclo',
                'image' => '',
                'description' => 'Choclo x Unidad',
                'price' => 2079,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Papa',
                'image' => '',
                'description' => 'Papa x 1kg',
                'price' => 1599,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Tomate',
                'image' => '',
                'description' => 'Tomate x 1kg',
                'price' => 3224,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Pepino',
                'image' => '',
                'description' => 'Pepino x 1kg',
                'price' => 2079,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Morrón',
                'image' => '',
                'description' => 'Morrón x 1kg',
                'price' => 5199,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Zanahoria',
                'image' => '',
                'description' => 'Zanahoria x 1kg',
                'price' => 1199,
                'brand' => 'N/A',
                'fk_products_categories' => 18,
            ],
            [
                'model' => 'Natura 900ml',
                'image' => '',
                'description' => 'Aceite de Girasol Natura 900ml',
                'price' => 1866,
                'brand' => 'Natura',
                'fk_products_categories' => 19,
            ],
            [
                'model' => 'Natura',
                'image' => '',
                'description' => 'Aceite de Girasol Natura 1.5 L',
                'price' => 2995,
                'brand' => 'Natura',
                'fk_products_categories' => 19,
            ],
            [
                'model' => 'Cocinero',
                'image' => '',
                'description' => 'Aceite Oliva Extra Virgen Suave Cocinero 500ml',
                'price' => 8850,
                'brand' => 'Cocinero',
                'fk_products_categories' => 20,
            ],
            [
                'model' => 'Lira',
                'image' => '',
                'description' => 'Aceite Oliva Lira Extra Virgen Pet 500ml',
                'price' => 123,
                'brand' => 'Lira',
                'fk_products_categories' => 20,
            ],
            [
                'model' => 'Maple',
                'image' => '',
                'description' => 'Huevos Blancos Carnave Maples 30u',
                'price' => 6400,
                'brand' => 'N/A',
                'fk_products_categories' => 21,
            ],


            //------Primera Bodega------


            [
                'model' => 'Elementos Malbec',
                'image' => '',
                'description' => 'Vino Elementos Malbec 750ml',
                'price' => 6600,
                'brand' => 'Elementos',
                'fk_products_categories' => 23,
            ],
            [
                'model' => 'Portillo Malbec',
                'image' => '',
                'description' => 'Vino Portillo Malbec X 750ml',
                'price' => 5499,
                'brand' => 'Portillo',
                'fk_products_categories' => 23,
            ],
            [
                'model' => 'Trumpeter Malbec',
                'image' => '',
                'description' => 'Vino Tinto Trumpeter Malbec 750ml Botella Rutini Wines',
                'price' => 7898,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 23,
            ],
            [
                'model' => 'Alma Mora Malbec',
                'image' => '',
                'description' => 'Vino Alma Mora Malbec X 750ml',
                'price' => 6500,
                'brand' => 'Alma Mora',
                'fk_products_categories' => 23,
            ],
            [
                'model' => 'Vino Blanco Dilema',
                'image' => '',
                'description' => 'Vino Blanco Dilema Dulce Natural 750ml',
                'price' => 6000,
                'brand' => 'Dilema',
                'fk_products_categories' => 24,
            ],
            [
                'model' => 'Cosecha Tardía Norton',
                'image' => '',
                'description' => 'Norton Cosecha Tardia Vino Dulce 750ml',
                'price' => 3692,
                'brand' => 'Norton',
                'fk_products_categories' => 24,
            ],
            [
                'model' => 'Marló de Bianchi',
                'image' => '',
                'description' => 'Vino Blanco Dulce 750ml Marlo Vinos Tradic',
                'price' => 6590,
                'brand' => 'Bianchi',
                'fk_products_categories' => 24,
            ],
            [
                'model' => 'Vino Emilia Dulce Natural',
                'image' => '',
                'description' => 'Vino Emilia Nieto Senetiner Dulce Moscatel 750ml',
                'price' => 6590,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 24,
            ],
            [
                'model' => 'Vino Rosado Dulce Cosecha Tardia',
                'image' => '',
                'description' => 'Cosecha Tardía Vino Rosado Dulce 750ml',
                'price' => 5230,
                'brand' => 'Norton',
                'fk_products_categories' => 25,
            ],
            [
                'model' => 'Vino Rosado Emilia Malbec Dulce Natural',
                'image' => '',
                'description' => 'Vino Emilia Malbec Rosé Dulce Natural 750ml',
                'price' => 7150,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 25,
            ],
            [
                'model' => 'Vino Rosado Dilema',
                'image' => '',
                'description' => 'Vino Rosado Dilema 750ml',
                'price' => 4800,
                'brand' => 'Dilema',
                'fk_products_categories' => 25,
            ],
            [
                'model' => 'Vino Rosado Trivento Rose Malbec',
                'image' => '',
                'description' => 'Vino Trivento Reserve Malbec Rose',
                'price' => 6000,
                'brand' => 'Rose Malbec',
                'fk_products_categories' => 25,
            ],
            [
                'model' => 'Vino Trumpeter Syrah',
                'image' => '',
                'description' => 'Vino Trumpeter Syrah 750ml',
                'price' => 7500,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 26,
            ],
            [
                'model' => 'Elementos Syrah',
                'image' => '',
                'description' => 'Botella De Vino Tinto Elementos Syrah El Esteco De 750ml',
                'price' => 4735,
                'brand' => 'Elementos',
                'fk_products_categories' => 26,
            ],
            [
                'model' => 'Vino Syrah Benjamin',
                'image' => '',
                'description' => 'Vino Syrah 750ml Benjamin Vinos Varietales',
                'price' => 6500,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 26,
            ],
            [
                'model' => 'Vino Syrah Nieto Senetiner',
                'image' => '',
                'description' => 'Nieto Senetiner Vino Syrah 750ml',
                'price' => 10000,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 26,
            ],
            [
                'model' => 'Champagne Trumpeter Brut Nature',
                'image' => '',
                'description' => 'Champagne Trumpeter Brut Nature 750ml',
                'price' => 9940,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 27,
            ],
            [
                'model' => 'Espumante Cinzano',
                'image' => '',
                'description' => 'Espumante Cinzano Pro Spritz 750ml',
                'price' => 7510,
                'brand' => 'Cinzano',
                'fk_products_categories' => 27,
            ],
            [
                'model' => 'Chandon Extra Brut',
                'image' => '',
                'description' => 'Chandon Extra Brut 750ml',
                'price' => 11799,
                'brand' => 'Chandon',
                'fk_products_categories' => 27,
            ],
            [
                'model' => 'Champagne Alta Vista Extra Brut',
                'image' => '',
                'description' => 'Champagne Alta Vista Extra Brut 750ml',
                'price' => 10763,
                'brand' => 'N/A',
                'fk_products_categories' => 27,
            ],


            //------Segunda Bodega------


            [
                'model' => 'Elementos Malbec',
                'image' => '',
                'description' => 'Vino Elementos Malbec 750ml',
                'price' => 6600,
                'brand' => 'Elementos',
                'fk_products_categories' => 28,
            ],
            [
                'model' => 'Portillo Malbec',
                'image' => '',
                'description' => 'Vino Portillo Malbec X 750ml',
                'price' => 5499,
                'brand' => 'Portillo',
                'fk_products_categories' => 28,
            ],
            [
                'model' => 'Trumpeter Malbec',
                'image' => '',
                'description' => 'Vino Tinto Trumpeter Malbec 750ml Botella Rutini Wines',
                'price' => 7898,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 28,
            ],
            [
                'model' => 'Alma Mora Malbec',
                'image' => '',
                'description' => 'Vino Alma Mora Malbec X 750ml',
                'price' => 6500,
                'brand' => 'Alma Mora',
                'fk_products_categories' => 28,
            ],
            [
                'model' => 'Vino Blanco Dilema',
                'image' => '',
                'description' => 'Vino Blanco Dilema Dulce Natural 750ml',
                'price' => 6000,
                'brand' => 'Dilema',
                'fk_products_categories' => 29,
            ],
            [
                'model' => 'Cosecha Tardía Norton',
                'image' => '',
                'description' => 'Norton Cosecha Tardia Vino Dulce 750ml',
                'price' => 3692,
                'brand' => 'Norton',
                'fk_products_categories' => 29,
            ],
            [
                'model' => 'Marló de Bianchi',
                'image' => '',
                'description' => 'Vino Blanco Dulce 750ml Marlo Vinos Tradic',
                'price' => 6590,
                'brand' => 'Bianchi',
                'fk_products_categories' => 29,
            ],
            [
                'model' => 'Vino Emilia Dulce Natural',
                'image' => '',
                'description' => 'Vino Emilia Nieto Senetiner Dulce Moscatel 750ml',
                'price' => 6590,
                'brand' => 'Moscatel',
                'fk_products_categories' => 29,
            ],
            [
                'model' => 'Vino Rosado Dulce Cosecha Tardia',
                'image' => '',
                'description' => 'Cosecha Tardía Vino Rosado Dulce 750ml',
                'price' => 5230,
                'brand' => 'Norton',
                'fk_products_categories' => 30,
            ],
            [
                'model' => 'Vino Rosado Emilia Malbec Dulce Natural',
                'image' => '',
                'description' => 'Vino Emilia Malbec Rosé Dulce Natural 750ml',
                'price' => 7150,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 30,
            ],
            [
                'model' => 'Vino Rosado Dilema',
                'image' => '',
                'description' => 'Vino Rosado Dilema 750ml',
                'price' => 4800,
                'brand' => 'Dilema',
                'fk_products_categories' => 30,
            ],
            [
                'model' => 'Vino Rosado Trivento Rose Malbec',
                'image' => '',
                'description' => 'Vino Trivento Reserve Malbec Rose',
                'price' => 6000,
                'brand' => 'Rose Malbec',
                'fk_products_categories' => 30,
            ],
            [
                'model' => 'Vino Trumpeter Syrah',
                'image' => '',
                'description' => 'Vino Trumpeter Syrah 750ml',
                'price' => 7500,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 31,
            ],
            [
                'model' => 'Elementos Syrah',
                'image' => '',
                'description' => 'Botella De Vino Tinto Elementos Syrah El Esteco De 750ml',
                'price' => 4735,
                'brand' => 'Elementos',
                'fk_products_categories' => 31,
            ],
            [
                'model' => 'Vino Syrah Benjamin',
                'image' => '',
                'description' => 'Vino Syrah 750ml Benjamin Vinos Varietales',
                'price' => 6500,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 31,
            ],
            [
                'model' => 'Vino Syrah Nieto Senetiner',
                'image' => '',
                'description' => 'Nieto Senetiner Vino Syrah 750ml',
                'price' => 10000,
                'brand' => 'Nieto Senetiner',
                'fk_products_categories' => 31,
            ],
            [
                'model' => 'Champagne Trumpeter Brut Nature',
                'image' => '',
                'description' => 'Champagne Trumpeter Brut Nature 750ml',
                'price' => 9940,
                'brand' => 'Trumpeter',
                'fk_products_categories' => 32,
            ],
            [
                'model' => 'Espumante Cinzano',
                'image' => '',
                'description' => 'Espumante Cinzano Pro Spritz 750ml',
                'price' => 7510,
                'brand' => 'Cinzano',
                'fk_products_categories' => 32,
            ],
            [
                'model' => 'Chandon Extra Brut',
                'image' => '',
                'description' => 'Chandon Extra Brut 750ml',
                'price' => 11799,
                'brand' => 'Chandon',
                'fk_products_categories' => 32,
            ],
            [
                'model' => 'Champagne Alta Vista Extra Brut',
                'image' => '',
                'description' => 'Champagne Alta Vista Extra Brut 750ml',
                'price' => 10763,
                'brand' => 'N/A',
                'fk_products_categories' => 32,
            ],


        ]);

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 1);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/butchery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 2);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/butchery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 3);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/grocery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 4);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/grocery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 5);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/winery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }

        $products = Product::whereHas('category', function ($query) {
            $query->where('fk_categories_buisnesses', 6);
        })->get();


        foreach ($products as $product) {
            $name = $product->model;
            $product_img = public_path("img/products/winery/{$name}.png");
            $product_img = new UploadedFile($product_img, 'product_img');
            $image_path = $product_img->store('products', 'public');
            $product->image = $image_path;
            $product->save();
        }
    }
}
