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
        Schema::create('series_sms_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sms_campaign_id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('date')->nullable();
            $table->text('day')->nullable();
            $table->text('message')->nullable();
            $table->double('ContactCount')->nullable();
            $table->double('DeliveredCount')->nullable();
            $table->double('FailedDeliveredCount')->nullable();
            $table->double('NotDeliveredCount')->nullable();
            $table->string('action')->default('Play');
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
        Schema::dropIfExists('series_sms_campaigns');
    }
};
