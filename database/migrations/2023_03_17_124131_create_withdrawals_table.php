<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('wallet')->nullable();
            $table->string('payment_method')->nullable();
            $table->double('amount', 8,2)->nullable();
            $table->string('description')->nullable();
            $table->string('gateway_payment_id')->nullable();
            $table->integer('transaction_id')->unsigned()->nullable();
            $table->enum('status', ['created', 'refunded', 'finalized'])->default('created');
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
        Schema::dropIfExists('withdrawals');
    }
};
