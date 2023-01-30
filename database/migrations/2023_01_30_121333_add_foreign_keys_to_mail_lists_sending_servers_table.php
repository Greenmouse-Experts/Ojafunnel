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
        Schema::table('mail_lists_sending_servers', function (Blueprint $table) {
            $table->foreign(['mail_list_id'], 'mailmlss_mail_list_id_fk')->references(['id'])->on('mail_lists')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sending_server_id'], 'mailmlss_sending_server_id_fk')->references(['id'])->on('sending_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mail_lists_sending_servers', function (Blueprint $table) {
            $table->dropForeign('mailmlss_mail_list_id_fk');
            $table->dropForeign('mailmlss_sending_server_id_fk');
        });
    }
};
