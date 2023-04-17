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
        Schema::create('mail_contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->integer('mail_list_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email', 250)->unique();
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('country')->nullable();
            $table->string('state');
            $table->string('zip');
            $table->string('phone')->nullable();
            $table->boolean('subscribe')->index();
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
        Schema::dropIfExists('mail_contacts');
    }
};
