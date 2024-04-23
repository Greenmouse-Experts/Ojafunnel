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
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('subject')->nullable();
            $table->string('replyto_email')->nullable();
            $table->string('replyto_name')->nullable();
            $table->string('email_kit_id')->nullable();
            $table->string('list_id')->nullable();
            $table->string('email_template_id')->nullable();
            $table->string('sent')->nullable();
            $table->string('bounced')->nullable();
            $table->string('spam_score')->nullable();
            $table->string('message_timing')->nullable();
            $table->string('attachment_paths')->nullable();
            $table->string('slug')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('next_due_date')->nullable();
            $table->string('frequency_cycle')->nullable();
            $table->string('frequency_amount')->nullable();
            $table->string('frequency_unit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_campaigns');
    }
};
