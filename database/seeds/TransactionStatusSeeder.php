<?php

use Illuminate\Database\Seeder;
use App\TransactionStatus;

class TransactionStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TransactionStatus::create([
            'status' => 'Successfully',
        ]);
        TransactionStatus::create([
            'status' => 'Holded',
        ]);
        TransactionStatus::create([
            'status' => 'PO',
        ]);
        TransactionStatus::create([
            'status' => 'PO-cart',
        ]);
    }
}