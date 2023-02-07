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
        Schema::create('mail_lists_sending_servers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('sending_server_id')->index('mailmlss_sending_server_id_fk');
            $table->unsignedInteger('mail_list_id')->index('mailmlss_mail_list_id_fk');
            $table->integer('fitness');
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
        Schema::dropIfExists('mail_lists_sending_servers');
    }
};
