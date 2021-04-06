<?php

use Illuminate\Database\Seeder;
use App\Purchase;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $transaction_number_done = [1, 2, 3, 4, 5];
        for ($i = 0; $i <= rand(5, 20); $i++) {
            Purchase::create([
                "purchase_transaction_id" =>  $transaction_number_done[rand(0, 4)],
                "product_id" => rand(1, 50),
                "date" => Carbon\Carbon::now()->toDateString(),
                "amount" => rand(1, 10),
                "price" => 0,
            ]);
        }
        $transaction_number_PO = [6, 7, 8];
        for ($i = 0; $i <= rand(5, 20); $i++) {
            Purchase::create([
                "purchase_transaction_id" => $transaction_number_PO[rand(0, 2)],
                "product_id" => rand(1, 50),
                "date" => Carbon\Carbon::now()->yesterday()->yesterday()->toDateString(),
                "amount" => rand(1, 10),
                "price" => 0,
            ]);
        }
    }
}