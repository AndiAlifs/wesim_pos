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
        $transaction_number_done = [1, 2, 3, 4, 5];
        for ($i = 0; $i <= rand(50, 100); $i++) {
            Selling::create([
                "selling_transaction_id" => $transaction_number_done[rand(0, 4)],
                "product_id" => rand(1, 50),
                "date" => Carbon\Carbon::now()->toDateString(),
                "amount" => rand(1, 10),
                "price" => 0,
            ]);
        }
        $transaction_number_holded = [6];
        for ($i = 0; $i <= rand(5, 10); $i++) {
            Selling::create([
                "selling_transaction_id" => $transaction_number_holded[rand(0, 0)],
                "product_id" => rand(1, 50),
                "date" => Carbon\Carbon::now()->yesterday()->toDateString(),
                "amount" => rand(1, 10),
                "price" => 0,
            ]);
        }
    }
}