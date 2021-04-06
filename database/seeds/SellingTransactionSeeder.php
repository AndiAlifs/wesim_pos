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
        for ($i = 1; $i <= 5; $i++) {
            SellingTransaction::create([
                "transaction_number" => ('TRXS' . time() . '000' . $i),
                "status_id" => 1, //successfully
                "user_id" => 3, //kasir
                "member_id" => rand(1, 10), //
            ]);
        }
        SellingTransaction::create([
            "transaction_number" => ('Cart-' . time() . '0006'),
            "status_id" => 2, //holded
            "user_id" => 3, //kasir
            "member_id" => rand(1, 10), //
        ]);
        // !! tidak usah pake PO
    }
}