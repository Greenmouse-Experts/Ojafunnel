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
        Schema::create('open_logs', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('message_id')->index('mailopen_logs_message_id_foreign');
            $table->string('ip_address')->nullable()->index('mailopen_logs_ip_address_index');
            $table->text('user_agent')->nullable();
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
        Schema::dropIfExists('open_logs');
    }
};
