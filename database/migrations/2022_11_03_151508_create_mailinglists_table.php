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
        Schema::create('mailinglists', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('mailinglist_name');
            $table->string('no_of_contacts')->default(0);
            $table->string('email')->default(0);
            $table->string('phone_number')->default(0);
            $table->enum('status', ['Active', 'Inactive'])->default('Active')->index();
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
        Schema::dropIfExists('mailinglists');
    }
};
