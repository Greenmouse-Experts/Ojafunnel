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
        Schema::table('click_logs', function (Blueprint $table) {
            $table->foreign(['message_id'], 'mailclick_logs_message_id_foreign')->references(['message_id'])->on('tracking_logs')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('click_logs', function (Blueprint $table) {
            $table->dropForeign('mailclick_logs_message_id_foreign');
        });
    }
};