<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('selling_transaction_id');
            $table->foreign("selling_transaction_id")->references('id')->on("selling_transactions");

            $table->unsignedBigInteger('product_id');
            $table->foreign("product_id")->references('id')->on("products");

            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('price')->default(0);

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
        Schema::dropIfExists('sellings');
    }
}