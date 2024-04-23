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
        Schema::create('contact_numbers', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone_number');
            $table->unsignedBigInteger('contact_list_id')->index('contact_numbers_contact_list_id_foreign');
            $table->string('status')->nullable()->default('subscribe');
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
        Schema::dropIfExists('contact_numbers');
    }
};
