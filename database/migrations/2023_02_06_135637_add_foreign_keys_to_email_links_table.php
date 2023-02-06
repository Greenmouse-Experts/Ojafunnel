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
        Schema::table('email_links', function (Blueprint $table) {
            $table->foreign(['email_id'], 'mailemail_links_email_id_foreign')->references(['id'])->on('emails')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_links', function (Blueprint $table) {
            $table->dropForeign('mailemail_links_email_id_foreign');
        });
    }
};
