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
        Schema::create('user_payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('logo')->nullable();
            $table->string('PAYSTACK_PUBLIC_KEY')->nullable();
            $table->string('PAYSTACK_SECRET_KEY')->nullable();
            $table->string('FLW_PUBLIC_KEY')->nullable();
            $table->string('FLW_SECRET_KEY')->nullable();
            $table->string('PAYPAL_MODE')->nullable();
            $table->string('PAYPAL_CURRENCY')->nullable();
            $table->string('PAYPAL_SANDBOX_API_CERTIFICATE')->nullable();
            $table->string('PAYPAL_CLIENT_ID')->nullable();
            $table->string('PAYPAL_CLIENT_SECRET')->nullable();
            $table->string('STRIPE_KEY')->nullable();
            $table->string('STRIPE_SECRET')->nullable();
            $table->string('status')->default('Inactive');
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
        Schema::dropIfExists('user_payment_gateways');
    }
};
