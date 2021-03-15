<?php

use Illuminate\Database\Seeder;
use App\Selling;

class SellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_number = [1, 2, 3];
        for ($i = 0; $i <= 10; $i++) {
            Selling::create([
                "selling_transaction_id" => $transaction_number[rand(0, 2)],
                "product_id" => rand(1, 50),
                "amount" => rand(1, 10), //kasir
                "price" => 0,
            ]);
        }
    }
}