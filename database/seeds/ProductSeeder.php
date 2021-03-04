<?php

use Illuminate\Database\Seeder;
use App\Product;

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

        for ($i=0; $i <= 10; $i++) { 
            $new_product = new Product;

            $new_product->name = $faker->firstName();
            $new_product->product_code = $faker->isbn10();
            $new_product->producer = $faker->lastName();
            $new_product->description = $faker->sentence(5);
            $temp_angka = rand(0,2);
            $new_product->purchase_price = $purchase_price[$temp_angka];
            $new_product->price = $price[$temp_angka];
            $new_product->save();

            $new_product->Category()->attach(rand(1,3));
        }
    }
}
