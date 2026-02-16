<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $this->call([
            CategoriesSeeder::class,
            BrandsSeeder::class,
            TagsSeeder::class,
            ProductsSeeder::class,
            ProductImagesSeeder::class,
            ProductTagsSeeder::class,
        ]);


        $this->command->info('✅ Base de datos poblada exitosamente!');
    }
}