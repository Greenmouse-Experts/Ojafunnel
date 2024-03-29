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
        Schema::create('series_wa_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wa_campaign_id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->text('message')->nullable();
            $table->double('ContactCount')->nullable();
            $table->double('DeliveredCount')->nullable();
            $table->double('FailedDeliveredCount')->nullable();
            $table->double('NotDeliveredCount')->nullable();
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
        Schema::dropIfExists('series_wa_campaigns');
    }
};
