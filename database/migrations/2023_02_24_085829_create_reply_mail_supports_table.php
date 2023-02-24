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
        Schema::create('reply_mail_supports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mail_id');
            $table->string('user_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->enum('status', ['Read', 'Unread', 'Replied'])->default('Unread');
            $table->enum('by_who', ['Administrator', 'User']);

            $table->foreign('mail_id')->references('id')->on('ojafunnel_mail_supports')->onDelete('cascade');
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
        Schema::dropIfExists('reply_mail_supports');
    }
};
