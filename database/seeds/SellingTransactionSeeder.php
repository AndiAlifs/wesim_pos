<?php

use Illuminate\Database\Seeder;
use App\SellingTransaction;

class SellingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SellingTransaction::create([
            "transaction_number" => ('TRX' . time() . '0001'),
            "status_id" => 1,
            "user_id" => 3, //kasir
            "member_id" => rand(1, 10), //
        ]);
        SellingTransaction::create([
            "transaction_number" => ('Cart ' . time() . '0002'),
            "status_id" => 2,
            "user_id" => 3, //kasir
            "member_id" => rand(1, 10), //
        ]);
        SellingTransaction::create([
            "transaction_number" => ('TRX' . time() . '0003'),
            "status_id" => 3,
            "user_id" => 3, //kasir
            "member_id" => rand(1, 10), //
        ]);
    }
}