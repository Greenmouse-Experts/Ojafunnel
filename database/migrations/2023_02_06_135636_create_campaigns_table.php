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
        Schema::create('campaigns', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('customer_id')->index('mailcampaigns_customer_id_foreign');
            $table->text('type');
            $table->text('name');
            $table->text('subject')->nullable();
            $table->longText('plain')->nullable();
            $table->text('from_email')->nullable();
            $table->text('from_name')->nullable();
            $table->text('reply_to')->nullable();
            $table->text('status')->nullable();
            $table->boolean('sign_dkim')->nullable();
            $table->boolean('track_open')->nullable();
            $table->boolean('track_click')->nullable();
            $table->integer('resend')->nullable();
            $table->timestamp('run_at')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->timestamps();
            $table->text('template_source')->nullable();
            $table->longText('last_error')->nullable();
            $table->text('image')->nullable();
            $table->unsignedInteger('default_mail_list_id')->nullable()->index('mailcampaigns_default_mail_list_id_foreign');
            $table->text('cache')->nullable();
            $table->unsignedBigInteger('tracking_domain_id')->nullable()->index('mailcampaigns_tracking_domain_id_foreign');
            $table->boolean('use_default_sending_server_from_email')->default(false);
            $table->text('preheader')->nullable();
            $table->integer('running_pid')->nullable();
            $table->unsignedInteger('template_id')->nullable()->index('mailcampaigns_template_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
};
