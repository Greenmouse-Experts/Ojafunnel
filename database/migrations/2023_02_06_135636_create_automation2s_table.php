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
        Schema::create('automation2s', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->string('name');
            $table->unsignedInteger('customer_id')->index('mailautomation2s_customer_id_foreign');
            $table->unsignedInteger('mail_list_id')->index('mailautomation2s_mail_list_id_foreign');
            $table->string('time_zone')->nullable();
            $table->string('status');
            $table->longText('data')->nullable();
            $table->timestamps();
            $table->text('segment_id')->nullable();
            $table->text('cache')->nullable();
            $table->text('last_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automation2s');
    }
};
