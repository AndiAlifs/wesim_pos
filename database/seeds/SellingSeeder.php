<?php

use App\Product;
use Illuminate\Database\Seeder;
use App\Selling;
use App\SellingTransaction;

class SellingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $jumlahTransaksi = SellingTransaction::count();
        for ($j=1; $j <= $jumlahTransaksi-1; $j++) { 
            for ($i = 0; $i <= rand(20, 20); $i++) {
                $random = rand(1, 50);
                $randomAmount = rand(1, 10);
                Selling::create([
                    "selling_transaction_id" => $j,
                    "product_id" => $random,
                    "date" => Carbon\Carbon::now()->toDateString(),
                    "amount" => $randomAmount,
                    "price" => Product::find($random)->prices->last()->harga_jual * $randomAmount,
                ]);
            }
        }

        for ($i = 0; $i <= rand(5, 10); $i++) {
            $random = rand(1, 50);
            $randomAmount = rand(1, 10);
            Selling::create([
                "selling_transaction_id" => $jumlahTransaksi,
                "product_id" => $random,
                "date" => Carbon\Carbon::now()->yesterday()->toDateString(),
                "amount" => $randomAmount,
                "price" => Product::find($random)->prices->last()->harga_jual * $randomAmount,
        ]);
        }

        $allSellingTransaction = SellingTransaction::get();
        foreach ($allSellingTransaction as $pt) {
            $total_harga = $pt->sellings->sum('price');
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