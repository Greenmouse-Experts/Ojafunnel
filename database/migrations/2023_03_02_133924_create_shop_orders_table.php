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
        Schema::create('shop_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('shop_id')->unsigned()->references('id')->on('shops')->onDelete('cascade');
            $table->integer('course_id')->unsigned()->references('id')->on('courses')->onDelete('cascade');
            $table->unsignedBigInteger('enrollment_id')->references('id')->on('enrollments')->onDelete('cascade');
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->string('order_no');
            $table->string('payment_method');
            $table->decimal('amount', 8,2);
            $table->string('description')->nullable();
            $table->decimal('author_earning', 10,2)->nullable();
            $table->decimal('affiliate_earning', 10,2)->nullable();
            $table->integer('referred_by')->nullable();
            $table->integer('transaction_id')->unsigned()->references('id')->on('transactions')->onDelete('cascade');
            $table->string('type')->nullable();
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
        Schema::dropIfExists('shop_orders');
    }
};
