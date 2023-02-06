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
        Schema::create('subscribers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('mail_list_id');
            $table->string('email')->index('mailsubscribers_email_index');
            $table->string('status')->nullable();
            $table->text('from')->nullable();
            $table->text('ip')->nullable();
            $table->timestamps();
            $table->string('subscription_type')->nullable();
            $table->text('tags')->nullable();
            $table->string('verification_status', 100)->nullable();
            $table->dateTime('last_verification_at')->nullable();
            $table->string('last_verification_by', 100)->nullable();
            $table->mediumText('last_verification_result')->nullable();

            $table->index(['mail_list_id', 'email'], 'mailsubscribers_mail_list_id_email_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscribers');
    }
};
