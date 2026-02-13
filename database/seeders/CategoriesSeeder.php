<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Ron',
                'slug' => 'ron',
                'description' => 'Rones añejos y blancos',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Vodka',
                'slug' => 'vodka',
                'description' => 'Vodkas premium',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Gin',
                'slug' => 'gin',
                'description' => 'Ginebras artesanales y clásicas',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Tequila',
                'slug' => 'tequila',
                'description' => 'Tequilas reposados y añejos',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Licores',
                'slug' => 'licores',
                'description' => 'Licores y cremas',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Vino',
                'slug' => 'vino',
                'description' => 'Vinos tintos, blancos y rosados',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Cerveza',
                'slug' => 'cerveza',
                'description' => 'Cervezas artesanales e importadas',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Azucarados',
                'slug' => 'azucarados',
                'description' => 'Productos energizantes, aguas, e idratantes',
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 9,
                'name' => 'Aguardiente',
                'slug' => 'aguardiente',
                'description' => null,
                'image' => null,
                'is_active' => 1,
                'order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
