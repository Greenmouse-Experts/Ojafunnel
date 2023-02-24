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
            $table->enum('type', ['Digital', 'Physical'])->default('Physical');
            $table->string('ref_number')->nullable();
            $table->string('comm_type')->nullable();
            $table->string('comm_level')->nullable();
            $table->string('commission')->nullable();
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
