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
        Schema::create('sms_queues', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('sms_campaign_id')->index('sms_queues_sms_campaign_id_foreign');
            $table->string('phone_number', 20);
            $table->string('status')->default('Waiting');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_queues');
    }
};
