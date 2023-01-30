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
        Schema::table('notifications', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailnotifications_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailnotifications_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropForeign('mailnotifications_admin_id_foreign');
            $table->dropForeign('mailnotifications_customer_id_foreign');
        });
    }
};
