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
        Schema::table('sms_queues', function (Blueprint $table) {
            $table->foreign(['sms_campaign_id'])->references(['id'])->on('sms_campaigns')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_queues', function (Blueprint $table) {
            $table->dropForeign('sms_queues_sms_campaign_id_foreign');
        });
    }
};
