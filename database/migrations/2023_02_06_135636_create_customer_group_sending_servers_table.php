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
        Schema::create('customer_group_sending_servers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->integer('sending_server_id');
            $table->string('customer_group_id');
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
        Schema::dropIfExists('customer_group_sending_servers');
    }
};
