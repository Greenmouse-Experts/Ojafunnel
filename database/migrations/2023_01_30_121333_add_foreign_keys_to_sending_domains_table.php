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
        Schema::table('sending_domains', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailsending_domains_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailsending_domains_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sending_server_id'], 'mailsending_domains_sending_server_id_foreign')->references(['id'])->on('sending_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sending_domains', function (Blueprint $table) {
            $table->dropForeign('mailsending_domains_admin_id_foreign');
            $table->dropForeign('mailsending_domains_customer_id_foreign');
            $table->dropForeign('mailsending_domains_sending_server_id_foreign');
        });
    }
};
