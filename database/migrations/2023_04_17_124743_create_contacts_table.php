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
        Schema::create('contacts', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->unsignedInteger('country_id')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->text('tax_number')->nullable();
            $table->text('billing_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
