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
        Schema::table('plans_email_verification_servers', function (Blueprint $table) {
            $table->foreign(['plan_id'], 'mailpevs_plan_id_fk')->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['server_id'], 'mailpevs_server_id_fk')->references(['id'])->on('email_verification_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans_email_verification_servers', function (Blueprint $table) {
            $table->dropForeign('mailpevs_plan_id_fk');
            $table->dropForeign('mailpevs_server_id_fk');
        });
    }
};
