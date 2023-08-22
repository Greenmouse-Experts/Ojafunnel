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
        Schema::table('store_products', function (Blueprint $table) {
            $table->string('date_from', 50)->nullable();
            $table->string('date_to', 50)->nullable();
            $table->double('new_price')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('store_products', function (Blueprint $table) {
            //
        });
    }
};
