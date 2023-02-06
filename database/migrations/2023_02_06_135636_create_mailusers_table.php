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
        Schema::create('mailusers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->string('api_token', 60)->unique();
            $table->unsignedInteger('creator_id')->nullable()->index('mailusers_creator_id_foreign');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->binary('quota')->nullable();
            $table->boolean('activated')->default(false);
            $table->string('one_time_api_token')->nullable();
            $table->unsignedInteger('customer_id')->nullable()->index('mailusers_customer_id_foreign');
            $table->text('first_name')->nullable();
            $table->text('last_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailusers');
    }
};
