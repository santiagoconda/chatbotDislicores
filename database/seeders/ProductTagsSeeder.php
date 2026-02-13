<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTagsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('product_tags')->insert([
            [
                'product_id' => 1,
                'tag_id' => 1,
            ],
        ]);
    }
}
