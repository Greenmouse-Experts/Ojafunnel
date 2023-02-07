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
        Schema::table('delivery_attempts', function (Blueprint $table) {
            $table->foreign(['auto_trigger_id'], 'maildelivery_attempts_auto_trigger_id_foreign')->references(['id'])->on('auto_triggers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['email_id'], 'maildelivery_attempts_email_id_foreign')->references(['id'])->on('emails')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['subscriber_id'], 'maildelivery_attempts_subscriber_id_foreign')->references(['id'])->on('subscribers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_attempts', function (Blueprint $table) {
            $table->dropForeign('maildelivery_attempts_auto_trigger_id_foreign');
            $table->dropForeign('maildelivery_attempts_email_id_foreign');
            $table->dropForeign('maildelivery_attempts_subscriber_id_foreign');
        });
    }
};
