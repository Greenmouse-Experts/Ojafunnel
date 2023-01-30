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
        Schema::table('sending_servers', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailsending_servers_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['bounce_handler_id'], 'mailss_bounce_handler_id_fk')->references(['id'])->on('bounce_handlers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailss_customer_id_fk')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['feedback_loop_handler_id'], 'mailss_feedback_loop_handler_id_fk')->references(['id'])->on('feedback_loop_handlers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sending_servers', function (Blueprint $table) {
            $table->dropForeign('mailsending_servers_admin_id_foreign');
            $table->dropForeign('mailss_bounce_handler_id_fk');
            $table->dropForeign('mailss_customer_id_fk');
            $table->dropForeign('mailss_feedback_loop_handler_id_fk');
        });
    }
};
