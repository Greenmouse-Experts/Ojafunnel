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
        Schema::create('emails', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('automation2_id')->index('mailemails_automation2_id_foreign');
            $table->string('subject')->nullable();
            $table->string('from_email')->nullable();
            $table->string('from_name')->nullable();
            $table->string('reply_to')->nullable();
            $table->timestamps();
            $table->boolean('sign_dkim')->default(true);
            $table->boolean('track_open')->default(true);
            $table->boolean('track_click')->default(true);
            $table->string('action_id')->nullable();
            $table->longText('plain')->nullable();
            $table->unsignedBigInteger('tracking_domain_id')->nullable()->index('mailemails_tracking_domain_id_foreign');
            $table->unsignedInteger('template_id')->nullable()->index('mailemails_template_id_foreign');
            $table->unsignedInteger('customer_id')->default(0)->index('mailemails_customer_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emails');
    }
};
