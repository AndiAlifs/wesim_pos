<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('transaction_time');
            $table->enum('status', ["Succesfully", "Holded", "PO"])->nullable();
            $table->integer('selling_amount');

            $table->integer('member_id');
            $table->foreign("member_id")->reference('id')->on("member");

            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->reference('id')->on('product');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->reference('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_transaction');
    }
}
