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
        Schema::create('whatapp_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('list_mgt_id')->onDelete('cascade');
            $table->string('sender_id');
            $table->text('message');
            $table->date('date')->nullable();
            $table->time('time')->nullable();
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
        Schema::dropIfExists('whatapp_broadcasts');
    }
};
