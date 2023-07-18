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
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_bank_account');
            $table->string('type');
            $table->decimal('amount', 8, 2);
            $table->string('description');
            $table->datetime('transaction_at');
            $table->string('id_transaction_category');
            $table->string('id_transaction_method');
            $table->string('id_transaction_type');
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
        //teste
    }
}