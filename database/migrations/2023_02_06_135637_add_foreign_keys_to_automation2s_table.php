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
        Schema::table('automation2s', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'mailautomation2s_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['mail_list_id'], 'mailautomation2s_mail_list_id_foreign')->references(['id'])->on('mail_lists')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('automation2s', function (Blueprint $table) {
            $table->dropForeign('mailautomation2s_customer_id_foreign');
            $table->dropForeign('mailautomation2s_mail_list_id_foreign');
        });
    }
};
