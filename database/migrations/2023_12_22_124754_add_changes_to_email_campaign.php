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
        Schema::table('email_campaign', function (Blueprint $table) {
            $table->longText('message')->nullable()->change();
            $table->string('user_id')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->string('subject')->nullable()->change();
            $table->string('replyto_email')->nullable()->change();
            $table->string('replyto_name')->nullable()->change();
            $table->string('email_kit_id')->nullable()->change();
            $table->string('list_id')->nullable()->change();
            $table->string('email_template_id')->nullable()->change();
            $table->string('sent')->nullable()->change();
            $table->string('bounced')->nullable()->change();
            $table->string('spam_score')->nullable()->change();
            $table->string('message_timing')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_campaign', function (Blueprint $table) {
            //
        });
    }
};
