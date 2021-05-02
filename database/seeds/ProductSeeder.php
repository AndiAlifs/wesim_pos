<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\inventory;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i=0; $i <= 49; $i++) { 
            $new_product = new Product;

            $new_product->name = "Mie ".$faker->firstName();
            $temp_angka = rand(0,2);
            $new_product->image = "image/product/gambarIndomie".($temp_angka+1).".JPG";
            $new_product->product_code = $faker->isbn13();
            $new_product->producer = $faker->lastName();
            $new_product->description = $faker->sentence(5);
            $new_product->save();

            $new_product->Category()->attach(rand(1,3));
            
            $new_inventory = new inventory;
            $new_inventory->product_id = $new_product->id;
            $stocks = rand(2,6);
            $new_inventory->min_stock = $stocks*5;
            $new_inventory->full_stock = rand($stocks+2,30)*5;
            $in_stock = rand(0,$new_inventory->full_stock);
            $new_inventory->in_stock =  $in_stock;

            $new_inventory->save();
        }
    }
}
