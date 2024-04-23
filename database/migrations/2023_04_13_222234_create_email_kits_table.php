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
        Schema::create('email_kits', function (Blueprint $table) {
            $table->id();
            $table->string('account_id');
            $table->string('is_admin');
            $table->string('host');
            $table->string('port');
            $table->string('username');
            $table->string('password');
            $table->string('encryption');
            $table->string('from_email');
            $table->string('from_name');
            $table->string('type');
            $table->string('sent');
            $table->string('bounced');
            $table->string('master')->default(false);
            $table->string('replyto_email');
            $table->string('replyto_name');
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
        Schema::dropIfExists('email_kits');
    }
};
