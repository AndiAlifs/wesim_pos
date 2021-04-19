<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Price;
use Carbon\Carbon;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $purchase_price = [20000,10000,15000];
        $price = [28000,15000,20000];

        $allProducts = Product::get();
        foreach ($allProducts as $product) {
            $temp_angka = rand(0,2);
            $new_price = new Price();
            $new_price->product_id = $product->id;
            $new_price->harga_beli = $purchase_price[$temp_angka];
            $new_price->profit = rand(1,3)*0.05;
            $new_price->harga_jual = $new_price->harga_beli * $new_price->profit;
            $new_price->harga_jual += $new_price->harga_beli;
            $new_price->last_update = Carbon::now();
            $new_price->save();
        }
    }
}
