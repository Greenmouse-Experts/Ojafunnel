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
        Schema::table('email_verifications', function (Blueprint $table) {
            $table->foreign(['subscriber_id'], 'mailemail_verifications_subscriber_id_foreign')->references(['id'])->on('subscribers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['email_verification_server_id'], 'mailev_email_verification_server_id_fk')->references(['id'])->on('email_verification_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_verifications', function (Blueprint $table) {
            $table->dropForeign('mailemail_verifications_subscriber_id_foreign');
            $table->dropForeign('mailev_email_verification_server_id_fk');
        });
    }
};
