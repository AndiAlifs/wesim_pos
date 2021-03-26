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
            "transaction_date" => '2021-03-01'
        ]);
        finance::create([
            "transaction_name" => "ATK",
            "amount" => 200000,
            "jenis" => "debit",
            "transaction_date" => '2021-03-02'
        ]);
        finance::create([
            "transaction_name" => "Bahan Habis Pakai",
            "amount" => 250000,
            "jenis" => "debit",
            "transaction_date" => '2021-03-15'
        ]); 
        finance::create([
            "transaction_name" => "Transportasi",
            "amount" => 800000,
            "jenis" => "debit",
            "transaction_date" => '2021-03-18'
        ]);
        finance::create([
            "transaction_name" => "Gaji",
            "amount" => 2500000,
            "jenis" => "debit",
            "transaction_date" => '2021-03-19'
        ]);
        finance::create([
            "transaction_name" => "Utang Bank",
            "amount" => 1500000,
            "jenis" => "kredit",
            "transaction_date" => '2021-03-22'
        ]);
        finance::create([
            "transaction_name" => "Modal Alip",
            "amount" => 1300000,
            "jenis" => "kredit",
            "transaction_date" => '2021-03-25'
        ]);
        finance::create([
            "transaction_name" => "Pendapatan",
            "amount" => 2000000,
            "jenis" => "kredit",
            "transaction_date" => '2021-03-31'
        ]);

        finance::create([
            "transaction_name" => "Kas",
            "amount" => 1550000,
            "jenis" => "debit",
            "transaction_date" => '2021-04-01'
        ]);
        finance::create([
            "transaction_name" => "ATK",
            "amount" => 200000,
            "jenis" => "debit",
            "transaction_date" => '2021-04-02'
        ]);
        finance::create([
            "transaction_name" => "Bahan Habis Pakai",
            "amount" => 250000,
            "jenis" => "debit",
            "transaction_date" => '2021-04-15'
        ]); 
        finance::create([
            "transaction_name" => "Transportasi",
            "amount" => 800000,
            "jenis" => "debit",
            "transaction_date" => '2021-04-18'
        ]);
        finance::create([
            "transaction_name" => "Gaji",
            "amount" => 2500000,
            "jenis" => "debit",
            "transaction_date" => '2021-04-19'
        ]);
        finance::create([
            "transaction_name" => "Utang Bank",
            "amount" => 1700000,
            "jenis" => "kredit",
            "transaction_date" => '2021-04-22'
        ]);
        finance::create([
            "transaction_name" => "Modal Alip",
            "amount" => 1500000,
            "jenis" => "kredit",
            "transaction_date" => '2021-04-25'
        ]);
        finance::create([
            "transaction_name" => "Pendapatan",
            "amount" => 2100000,
            "jenis" => "kredit",
            "transaction_date" => '2021-04-30'
        ]);
    }
}
