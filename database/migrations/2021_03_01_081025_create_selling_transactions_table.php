<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('transaction_number');

            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('transaction_statuses');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('member_id')->default(1);
            $table->foreign("member_id")->references('id')->on("members");

            $table->unsignedBigInteger('pay_cost')->default(0);
            $table->unsignedBigInteger('total_price')->default(0);
            $table->string('transaction_date')->default('');

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
        Schema::dropIfExists('selling_transactions');
    }
}