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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->string('status');
            $table->dateTime('current_period_ends_at')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->timestamps();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('last_period_ends_at')->nullable();
            $table->unsignedInteger('customer_id')->nullable()->index('mailsubscriptions_customer_id_foreign');
            $table->unsignedInteger('plan_id')->nullable()->index('mailsubscriptions_plan_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
};
