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
            $table->id();
            $table->string('user_id');
            $table->unsignedBigInteger('mailinglist_id')->nullable();
            $table->foreign('mailinglist_id')->references('id')->on('mailinglists');
            $table->unsignedBigInteger('integration_id')->nullable();
            $table->foreign('integration_id')->references('id')->on('integrations');
            $table->string('senders_name');
            $table->string('message');
            $table->string('contacts');
            $table->string('optout_message');
            $table->string('message_timimg');
            $table->string('schedule_date');
            $table->string('schedule_time');
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
