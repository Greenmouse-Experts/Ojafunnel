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
        Schema::create('oja_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('plan_id')->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->dateTime('current_period_ends_at')->nullable();
            $table->boolean('canceled_immediately')->nullable();
            $table->date('expiry_notify_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->integer('extended')->default(0);
            $table->integer('renewed')->default(0);
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
        Schema::dropIfExists('oja_subscriptions');
    }
};
