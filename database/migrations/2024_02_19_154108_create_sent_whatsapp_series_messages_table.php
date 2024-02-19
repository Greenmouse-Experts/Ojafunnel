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
        Schema::create('sent_whatsapp_series_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('whatapp_campaign_id')->onDelete('cascade');
            $table->foreignId('contact_id')->onDelete('cascade');
            $table->string('type');
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
        Schema::dropIfExists('sent_whatsapp_series_messages');
    }
};
