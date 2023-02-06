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
        Schema::table('bounce_handlers', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailbounce_handlers_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bounce_handlers', function (Blueprint $table) {
            $table->dropForeign('mailbounce_handlers_admin_id_foreign');
        });
    }
};
