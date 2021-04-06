<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('purchase_transaction_id');
            $table->foreign("purchase_transaction_id")->references('id')->on("purchase_transactions");

            $table->unsignedBigInteger('product_id');
            $table->foreign("product_id")->references('id')->on("products");

            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('price')->default(0);

            $table->date('date')->default(date('Y-m-d'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}