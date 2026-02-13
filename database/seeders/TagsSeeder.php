<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tags')->insert([
            [
                'id' => 1,
                'name' => 'Licor',
                'slug' => 'licor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
