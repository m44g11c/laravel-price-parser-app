<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'code' => 'P00'.Str::random(7),
            'name' => Str::random(10),
            'description' => Str::random(20),
        ]);

        DB::table('products')->insert([
            'code' => 'P00'.Str::random(7),
            'name' => Str::random(10),
            'description' => Str::random(20),
        ]);

        DB::table('products')->insert([
            'code' => 'P00'.Str::random(7),
            'name' => Str::random(10),
            'description' => Str::random(20),
        ]);

        DB::table('products')->insert([
            'code' => 'P00'.Str::random(7),
            'name' => Str::random(10),
            'description' => Str::random(20),
        ]);

        DB::table('products')->insert([
            'code' => 'P00'.Str::random(7),
            'name' => Str::random(10),
            'description' => Str::random(20),
        ]);
    }
}
