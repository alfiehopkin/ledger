<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // swapped out fields to allow for encryption
            // $table->unsignedBigInteger('amount');
            // $table->enum('type', ['credit', 'debit']);
            $table->text('amount');
            $table->text('type');
            $table->uuid('account_id');
            $table->timestamp('transacted_at', 3);
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
