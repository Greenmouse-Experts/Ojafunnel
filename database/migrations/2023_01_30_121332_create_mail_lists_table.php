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
        Schema::create('mail_lists', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('customer_id')->index('mailmail_lists_customer_id_foreign');
            $table->unsignedInteger('contact_id')->index('mailmail_lists_contact_id_foreign');
            $table->string('name');
            $table->text('default_subject')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->text('remind_message')->nullable();
            $table->text('email_subscribe')->nullable();
            $table->text('email_unsubscribe')->nullable();
            $table->text('email_daily')->nullable();
            $table->boolean('send_welcome_email')->default(false);
            $table->boolean('unsubscribe_notification')->default(false);
            $table->string('status')->nullable();
            $table->timestamps();
            $table->boolean('subscribe_confirmation')->default(true);
            $table->text('cache')->nullable();
            $table->boolean('all_sending_servers')->nullable()->default(false);
            $table->text('embedded_form_options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mail_lists');
    }
};
