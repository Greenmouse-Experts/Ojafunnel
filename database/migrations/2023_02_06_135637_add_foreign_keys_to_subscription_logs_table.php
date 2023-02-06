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
        Schema::table('subscription_logs', function (Blueprint $table) {
            $table->foreign(['subscription_id'], 'mailsl_subscription_id_fk')->references(['id'])->on('subscriptions')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscription_logs', function (Blueprint $table) {
            $table->dropForeign('mailsl_subscription_id_fk');
        });
    }
};
