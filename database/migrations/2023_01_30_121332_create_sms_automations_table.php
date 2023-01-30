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
        Schema::create('sms_automations', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->unsignedBigInteger('mailinglist_id')->nullable()->index('sms_automations_mailinglist_id_foreign');
            $table->unsignedBigInteger('integration_id')->nullable()->index('sms_automations_integration_id_foreign');
            $table->string('campaign_name')->nullable();
            $table->string('sms_sent')->nullable()->default('0');
            $table->string('delivered')->nullable()->default('0');
            $table->string('not_delivered')->nullable()->default('0');
            $table->string('opens')->nullable()->default('0');
            $table->string('unsubscribed')->nullable()->default('0');
            $table->string('senders_name')->nullable();
            $table->string('message')->nullable();
            $table->string('contacts')->nullable();
            $table->string('optout_message')->nullable();
            $table->string('message_timimg')->nullable();
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->index();
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
        Schema::dropIfExists('sms_automations');
    }
};
