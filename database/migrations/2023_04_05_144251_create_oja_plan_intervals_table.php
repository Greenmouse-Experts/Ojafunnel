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
        Schema::create('oja_plan_intervals', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id')->unsigned();
            $table->decimal('price');
            $table->enum('type', ['monthly', 'yearly'])->nullable();
            $table->integer('currency')->nullable();
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
        Schema::dropIfExists('oja_plan_intervals');
    }
};
