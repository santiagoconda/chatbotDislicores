<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'id' => 1,
                'name' => 'Ron Viejo de Caldas',
                'slug' => 'ron-viejo-de-caldas',
                'description' => null,
                'logo' => null,
                'country_origin' => 'Colombia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Aguardiente Amarillo De Manzanarez',
                'slug' => 'aguardiente-amarillo-de-manzanarez',
                'description' => null,
                'logo' => null,
                'country_origin' => 'Colombia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Aguardiente Antiqueño',
                'slug' => 'aguardiente-antioqueno',
                'description' => null,
                'logo' => null,
                'country_origin' => 'Colombia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Ron Medellín',
                'slug' => 'ron-edellín',
                'description' => null,
                'logo' => null,
                'country_origin' => 'Mexico',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Vodka',
                'slug' => 'vodka',
                'description' => null,
                'logo' => null,
                'country_origin' => 'México',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Bavaria',
                'slug' => 'bavaria',
                'description' => null,
                'logo' => null,
                'country_origin' => 'Colombia',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Buchanans',
                'slug' => 'buchanans',
                'description' => null,
                'logo' => null,
                'country_origin' => 'mexico',
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
