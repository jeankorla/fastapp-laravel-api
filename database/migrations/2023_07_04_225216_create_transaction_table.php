<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_bank_account');
            $table->string('type');
            $table->decimal('amount', 8, 2);
            $table->string('description');
            $table->datetime('transaction_at');
            $table->unsignedBigInteger('id_transaction_category');
            $table->unsignedBigInteger('id_transaction_method');
            $table->unsignedBigInteger('id_transaction_type');
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
        Schema::dropIfExists('transactions');
    }
}