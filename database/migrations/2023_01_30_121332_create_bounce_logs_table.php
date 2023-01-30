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
        Schema::create('bounce_logs', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('runtime_message_id')->nullable();
            $table->string('message_id')->nullable();
            $table->string('bounce_type');
            $table->text('raw');
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
        Schema::dropIfExists('bounce_logs');
    }
};
