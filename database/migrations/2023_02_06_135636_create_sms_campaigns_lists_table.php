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
        Schema::create('sms_campaigns_lists', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contact_list_id')->index('sms_campaigns_lists_contact_list_id_foreign');
            $table->unsignedBigInteger('sms_campaign_id')->index('sms_campaign_id');
            $table->timestamps();

            $table->index(['sms_campaign_id'], 'sms_campaigns_lists_campaign_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_campaigns_lists');
    }
};
