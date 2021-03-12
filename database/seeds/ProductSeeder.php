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

        $purchase_price = [20000,10000,15000];
        $price = [28000,15000,20000];
        for ($i=0; $i <= 49; $i++) { 
            $new_product = new Product;

            $new_product->name = "Mie ".$faker->firstName();
            $temp_angka = rand(0,2);
            $new_product->product_code = $faker->isbn13();
            $new_product->producer = $faker->lastName();
            $new_product->description = $faker->sentence(5);
            $new_product->purchase_price = $purchase_price[$temp_angka];
            $new_product->price = $price[$temp_angka];
            $new_product->save();

            $new_product->Category()->attach(rand(1,3));
            
            $new_inventory = new inventory;
            $new_inventory->product_id = $new_product->id;
            $stocks = rand(2,6);
            $new_inventory->min_stock = $stocks*5;
            $new_inventory->full_stock = rand($stocks+2,30)*5;
            $in_stock = rand(0,$new_inventory->full_stock);
            $new_inventory->in_stock =  $in_stock;

            if ($in_stock  <= 20){
                if(rand(0,1) == 1){
                    $new_inventory->incoming = rand(10,$new_inventory->full_stock - $new_inventory->in_stock);
                } else {
                    $new_inventory->incoming = 0;
                }
            } else {
                $new_inventory->incoming = 0;
            }

            $new_inventory->save();
        }
    }
}
