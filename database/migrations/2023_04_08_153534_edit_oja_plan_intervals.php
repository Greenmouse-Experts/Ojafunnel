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
        Schema::table('oja_plan_intervals', function (Blueprint $table) {
            $table->string('currency')->nullable()->change();
            $table->string('currency_sign')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('oja_plan_intervals', function (Blueprint $table) {

        });
    }
};
