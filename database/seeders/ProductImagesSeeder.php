<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_images')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'image_path' => 'products/ron/viejodecaldas/rvctradicional.jpg',
                'alt_text' => null,
                'is_primary' => 1,
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_id' => 3,
                'image_path' => 'products/ron/medellin/ronmedellin3años.webp',
                'alt_text' => null,
                'is_primary' => 0,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_id' => 4,
                'image_path' => 'products/ron/medellin/ronmedellin8años.webp',
                'alt_text' => null,
                'is_primary' => 0,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'product_id' => 6,
                'image_path' => 'products/ron/viejodecaldas/cheers.png',
                'alt_text' => null,
                'is_primary' => 0,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'product_id' => 2,
                'image_path' => 'products/aguardiente/antioqueno/tapazul.webp',
                'alt_text' => null,
                'is_primary' => 0,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
