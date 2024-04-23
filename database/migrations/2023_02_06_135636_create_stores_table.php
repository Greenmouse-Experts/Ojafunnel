<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->string('name')->unique('name');
            $table->longText('description')->nullable();
            $table->string('link')->nullable();
            $table->string('logo')->nullable();
            $table->unsignedBigInteger('user_id')->index('store_user_id_foreign');
            $table->string('theme')->nullable();
            $table->string('color')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('currency')->nullable();
            $table->string('currency_sign')->nullable();
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
        Schema::dropIfExists('stores');
    }
};
