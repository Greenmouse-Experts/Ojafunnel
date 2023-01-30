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
        Schema::create('tracking_logs', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('runtime_message_id')->nullable()->unique('mailtracking_logs_runtime_message_id_unique');
            $table->string('message_id')->nullable()->unique('mailtracking_logs_message_id_unique');
            $table->unsignedInteger('customer_id')->index('mailtracking_logs_customer_id_foreign');
            $table->unsignedInteger('sending_server_id')->index('mailtracking_logs_sending_server_id_foreign');
            $table->unsignedInteger('campaign_id')->nullable()->index('mailtracking_logs_campaign_id_foreign');
            $table->unsignedInteger('subscriber_id')->index('mailtracking_logs_subscriber_id_foreign');
            $table->string('status');
            $table->text('error')->nullable();
            $table->timestamps();
            $table->unsignedInteger('auto_trigger_id')->nullable()->index('mailtracking_logs_auto_trigger_id_foreign');
            $table->unsignedInteger('sub_account_id')->nullable()->index('mailtracking_logs_sub_account_id_foreign');
            $table->unsignedInteger('email_id')->nullable()->index('mailtracking_logs_email_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_logs');
    }
};
