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
            $table->string('user_id');
            $table->string('name');
            $table->string('subject');
            $table->string('replyto_email');
            $table->string('replyto_name');
            $table->string('email_kit_id');
            $table->string('list_id');
            $table->string('email_template_id');
            $table->string('sent');
            $table->string('bounced');
            $table->string('spam_score');
            $table->string('message_timing');
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
