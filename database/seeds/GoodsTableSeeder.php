<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods')->insert([
            'stock' => 10,
            'cost' => 20,
            'user_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('goods')->insert([
            'stock' => 10,
            'cost' => 20,
            'user_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('goods')->insert([
            'stock' => 10,
            'cost' => 20,
            'user_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('goods')->insert([
            'stock' => 10,
            'cost' => 20,
            'user_id' => 1,
            'product_id' => 1,
        ]);

        DB::table('goods')->insert([
            'stock' => 10,
            'cost' => 20,
            'user_id' => 1,
            'product_id' => 1,
        ]);
    }
}
