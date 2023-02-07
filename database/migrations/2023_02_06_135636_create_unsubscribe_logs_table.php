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
        Schema::create('unsubscribe_logs', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('message_id')->nullable()->index('mailunsubscribe_logs_message_id_foreign');
            $table->text('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->unsignedInteger('subscriber_id')->nullable()->index('mailunsubscribe_logs_subscriber_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('unsubscribe_logs');
    }
};
