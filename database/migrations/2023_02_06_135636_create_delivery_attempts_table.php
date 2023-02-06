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
        Schema::create('delivery_attempts', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->char('uid', 36);
            $table->unsignedInteger('subscriber_id')->index('maildelivery_attempts_subscriber_id_foreign');
            $table->unsignedInteger('email_id')->index('maildelivery_attempts_email_id_foreign');
            $table->unsignedInteger('auto_trigger_id')->nullable()->index('maildelivery_attempts_auto_trigger_id_foreign');
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
        Schema::dropIfExists('delivery_attempts');
    }
};
