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
        Schema::create('list_management_contacts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->integer('list_management_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('email', 250)->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
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
        Schema::dropIfExists('list_management_contacts');
    }
};
