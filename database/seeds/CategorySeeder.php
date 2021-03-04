<?php

use Illuminate\Database\Seeder;
use App\category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::create([
            "name" => "primary",
            "description" => "kategori produk primary"
        ]);
        category::create([
            "name" => "special",
            "description" => "kategori produk special"
        ]);
        category::create([
            "name" => "rare",
            "description" => "kategori produk rare"
        ]);
    }
}
