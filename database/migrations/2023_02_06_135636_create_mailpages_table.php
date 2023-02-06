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
        Schema::create('mailpages', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('layout_id')->index('mailpages_layout_id_foreign');
            $table->unsignedInteger('mail_list_id')->index('mailpages_mail_list_id_foreign');
            $table->longText('content');
            $table->timestamps();
            $table->string('subject');
            $table->boolean('use_outside_url')->default(false);
            $table->string('outside_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailpages');
    }
};
