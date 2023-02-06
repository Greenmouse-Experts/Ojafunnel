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
        Schema::table('mailpages', function (Blueprint $table) {
            $table->foreign(['layout_id'])->references(['id'])->on('layouts')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['mail_list_id'])->references(['id'])->on('mail_lists')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailpages', function (Blueprint $table) {
            $table->dropForeign('mailpages_layout_id_foreign');
            $table->dropForeign('mailpages_mail_list_id_foreign');
        });
    }
};
