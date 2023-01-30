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
        Schema::table('feedback_loop_handlers', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailfeedback_loop_handlers_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('feedback_loop_handlers', function (Blueprint $table) {
            $table->dropForeign('mailfeedback_loop_handlers_admin_id_foreign');
        });
    }
};
