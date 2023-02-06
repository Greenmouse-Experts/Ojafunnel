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
        Schema::create('plans_email_verification_servers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('server_id')->index('mailpevs_server_id_fk');
            $table->unsignedInteger('plan_id')->index('mailpevs_plan_id_fk');
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
        Schema::dropIfExists('plans_email_verification_servers');
    }
};
