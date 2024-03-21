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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('promoter_id')->onDelete('cascade');
            $table->foreignId('order_item_id')->onDelete('cascade');
            $table->foreignId('store_owner_id')->onDelete('cascade');
            $table->foreignId('store_id')->onDelete('cascade');
            $table->foreignId('transaction_id')->onDelete('cascade');
            $table->string('gateway_payment_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('pending');
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
        Schema::dropIfExists('promotions');
    }
};
