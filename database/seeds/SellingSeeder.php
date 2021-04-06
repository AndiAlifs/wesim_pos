<?php

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
                Selling::create([
                    "selling_transaction_id" => $j,
                    "product_id" => rand(1, 50),
                    "date" => Carbon\Carbon::now()->toDateString(),
                    "amount" => rand(1, 10),
                    "price" => 0,
                ]);
            }
        }

        for ($i = 0; $i <= rand(5, 10); $i++) {
            Selling::create([
                "selling_transaction_id" => $jumlahTransaksi,
                "product_id" => rand(1, 50),
                "date" => Carbon\Carbon::now()->yesterday()->toDateString(),
                "amount" => rand(1, 10),
                "price" => 0,
            ]);
        }
    }
}