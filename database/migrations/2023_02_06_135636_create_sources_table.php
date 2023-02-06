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
        Schema::create('sources', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->string('type');
            $table->unsignedInteger('customer_id')->index('mailsources_customer_id_foreign');
            $table->longText('meta')->nullable();
            $table->timestamps();
            $table->unsignedInteger('mail_list_id')->nullable()->index('mailsources_mail_list_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
};
