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
        Schema::create('series_email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_campaign_id')->onDelete('cascade');
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->datetime('date')->nullable();
            $table->text('day')->nullable();
            $table->string('email_template_id')->nullable();
            $table->text('attachment_paths')->nullable();
            $table->text('slug')->nullable();
            $table->string('sent');
            $table->string('bounced');
            $table->string('spam_score');
            $table->string('action')->default('Play');
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
        Schema::dropIfExists('series_email_campaigns');
    }
};
