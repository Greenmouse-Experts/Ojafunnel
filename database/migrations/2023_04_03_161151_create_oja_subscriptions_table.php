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
            $table->string('status');
            $table->dateTime('current_period_ends_at')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('last_period_ends_at')->nullable();
            $table->unsignedInteger('plan_id')->nullable();
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
