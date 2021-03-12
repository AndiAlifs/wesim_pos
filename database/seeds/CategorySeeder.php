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
            "name" => "Primary",
            "description" => "kategori produk primary"
        ]);
        category::create([
            "name" => "Special",
            "description" => "kategori produk special"
        ]);
        category::create([
            "name" => "Rare",
            "description" => "kategori produk rare"
        ]);
    }
}
