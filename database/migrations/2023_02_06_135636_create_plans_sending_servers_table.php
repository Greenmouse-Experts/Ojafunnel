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
        Schema::create('plans_sending_servers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('sending_server_id')->index('mailpss_sending_server_id_fk');
            $table->unsignedInteger('plan_id')->index('mailplans_sending_servers_plan_id_foreign');
            $table->integer('fitness');
            $table->timestamps();
            $table->boolean('is_primary')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans_sending_servers');
    }
};
