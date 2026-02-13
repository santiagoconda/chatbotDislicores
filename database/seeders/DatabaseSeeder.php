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
        // Desactivar foreign key checks para evitar errores de orden
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call([
            CategoriesSeeder::class,
            BrandsSeeder::class,
            TagsSeeder::class,
            ProductsSeeder::class,
            ProductImagesSeeder::class,
            ProductTagsSeeder::class,
        ]);

        // Reactivar foreign key checks
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Base de datos poblada exitosamente!');
    }
}