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
        Schema::create('general_exchange_rates', function (Blueprint $table) {
            $table->id();
            $table->string('primary_currency')->nullable();
            $table->string('secondary_currency')->nullable();
            $table->string('fx_symbol')->nullable();
            $table->string('fx_symbol')->nullable();
            $table->string('fx_symbol')->nullable();
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
        Schema::dropIfExists('general_exchange_rates');
    }
};
