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
        Schema::table('tracking_logs', function (Blueprint $table) {
            $table->foreign(['auto_trigger_id'], 'mailtracking_logs_auto_trigger_id_foreign')->references(['id'])->on('auto_triggers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['campaign_id'], 'mailtracking_logs_campaign_id_foreign')->references(['id'])->on('campaigns')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailtracking_logs_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['email_id'], 'mailtracking_logs_email_id_foreign')->references(['id'])->on('emails')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sending_server_id'], 'mailtracking_logs_sending_server_id_foreign')->references(['id'])->on('sending_servers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['subscriber_id'], 'mailtracking_logs_subscriber_id_foreign')->references(['id'])->on('subscribers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['sub_account_id'], 'mailtracking_logs_sub_account_id_foreign')->references(['id'])->on('sub_accounts')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracking_logs', function (Blueprint $table) {
            $table->dropForeign('mailtracking_logs_auto_trigger_id_foreign');
            $table->dropForeign('mailtracking_logs_campaign_id_foreign');
            $table->dropForeign('mailtracking_logs_customer_id_foreign');
            $table->dropForeign('mailtracking_logs_email_id_foreign');
            $table->dropForeign('mailtracking_logs_sending_server_id_foreign');
            $table->dropForeign('mailtracking_logs_subscriber_id_foreign');
            $table->dropForeign('mailtracking_logs_sub_account_id_foreign');
        });
    }
};
