<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(MemberSeeder::class);
        $this->call(PriceSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(TransactionStatusSeeder::class);
        $this->call(PurchaseTransactionSeeder::class);
        $this->call(PurchaseSeeder::class);
        $this->call(SellingTransactionSeeder::class);
        $this->call(SellingSeeder::class);
        $this->call(FinanceSeeder::class);
    }
}