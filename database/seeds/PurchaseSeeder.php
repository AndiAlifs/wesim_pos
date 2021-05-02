<?php

use Illuminate\Database\Seeder;
use App\Purchase;
use App\Product;
use App\PurchaseTransaction;

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
            $random = rand(1, 50);
            $randomAmount = rand(1, 10);
            Purchase::create([
                "purchase_transaction_id" =>  $transaction_number_done[rand(0, 4)],
                "product_id" => $random,
                "date" => Carbon\Carbon::now()->toDateString(),
                "amount" => $randomAmount,
                "price" => Product::find($random)->prices->last()->harga_beli * $randomAmount,
            ]);
        }
        $transaction_number_PO = [6, 7, 8];
        for ($i = 0; $i <= rand(5, 20); $i++) {
            $random = rand(1, 50);
            $randomAmount = rand(1, 10);
            Purchase::create([
                "purchase_transaction_id" => $transaction_number_PO[rand(0, 2)],
                "product_id" => $random,
                "date" => Carbon\Carbon::now()->yesterday()->yesterday()->toDateString(),
                "amount" =>  $randomAmount = rand(1, 10),
                "price" => Product::find($random)->prices->last()->harga_beli * $randomAmount,
            ]);
        }

        $allPurchasesTransaction = PurchaseTransaction::get();
        foreach ($allPurchasesTransaction as $pt) {
            $total_harga = $pt->purchases->sum('price');
            if ($total_harga == 0){
                $pt->delete();
                $pt->save();
            } else {
                $pt->total_price =$total_harga;
                $pt->save();
            }
        }
    }
}