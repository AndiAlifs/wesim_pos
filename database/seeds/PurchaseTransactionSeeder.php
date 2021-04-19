<?php

use Illuminate\Database\Seeder;
use App\PurchaseTransaction;

class PurchaseTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 5; $i++) {
            PurchaseTransaction::create([
                "transaction_number" => ('TRXP' . time() . '000' . $i),
                "status_id" => 1, //successfully
                "user_id" => 1, //admin
                "supplier_id" => rand(1, 3), //
            ]);
        }
        for ($i = 6; $i <= 8; $i++) {
            PurchaseTransaction::create([
                "transaction_number" => ('PO-' . time() . '000' . $i),
                "status_id" => 3, //Pre Order
                "user_id" => 1, //admin
                "supplier_id" => rand(1, 3),
            ]);
        }
        // !! tidak pake HOLD
    }
}