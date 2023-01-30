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
        Schema::table('plans_sending_servers', function (Blueprint $table) {
            $table->foreign(['plan_id'], 'mailplans_sending_servers_plan_id_foreign')->references(['id'])->on('plans')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sending_server_id'], 'mailpss_sending_server_id_fk')->references(['id'])->on('sending_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans_sending_servers', function (Blueprint $table) {
            $table->dropForeign('mailplans_sending_servers_plan_id_foreign');
            $table->dropForeign('mailpss_sending_server_id_fk');
        });
    }
};
