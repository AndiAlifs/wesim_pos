<?php

use Illuminate\Database\Seeder;
use App\finance;
use Carbon\Carbon;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $dateNow = Carbon::now();

        finance::create([
            "transaction_name" => "Kas",
            "amount" => 1050000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->toDateString()
        ]);
        finance::create([
            "transaction_name" => "ATK",
            "amount" => 200000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Bahan Habis Pakai",
            "amount" => 250000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Pendapatan",
            "amount" => 2000000,
            "jenis" => "kredit",
            "transaction_date" => $dateNow->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Transportasi",
            "amount" => 800000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Konsumsi",
            "amount" => 1500000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Gaji",
            "amount" => 2500000,
            "jenis" => "debit",
            "transaction_date" => $dateNow->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Utang Bank",
            "amount" => 3000000,
            "jenis" => "kredit",
            "transaction_date" => $dateNow->yesterday()->yesterday()->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Modal Fatwa",
            "amount" => 450000,
            "jenis" => "kredit",
            "transaction_date" => $dateNow->toDateString()
        ]);
        finance::create([
            "transaction_name" => "Modal Alip",
            "amount" => 850000,
            "jenis" => "kredit",
            "transaction_date" => $dateNow->toDateString()
        ]);
    }
}
