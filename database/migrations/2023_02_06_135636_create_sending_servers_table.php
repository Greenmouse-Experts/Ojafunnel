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
        Schema::create('sending_servers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('admin_id')->nullable()->index('mailsending_servers_admin_id_foreign');
            $table->unsignedInteger('customer_id')->nullable()->index('mailss_customer_id_fk');
            $table->unsignedInteger('bounce_handler_id')->nullable()->index('mailss_bounce_handler_id_fk');
            $table->unsignedInteger('feedback_loop_handler_id')->nullable()->index('mailss_feedback_loop_handler_id_fk');
            $table->string('name');
            $table->string('type');
            $table->string('host')->nullable();
            $table->string('aws_access_key_id')->nullable();
            $table->string('aws_secret_access_key')->nullable();
            $table->string('aws_region')->nullable();
            $table->string('domain')->nullable();
            $table->string('api_key')->nullable();
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->integer('smtp_port')->nullable();
            $table->string('smtp_protocol')->nullable();
            $table->string('sendmail_path')->nullable();
            $table->integer('quota_value');
            $table->integer('quota_base');
            $table->string('quota_unit');
            $table->string('status');
            $table->timestamps();
            $table->text('api_secret_key')->nullable();
            $table->binary('quota')->nullable();
            $table->string('default_from_email')->nullable();
            $table->longText('options')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sending_servers');
    }
};
