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
        Schema::table('sms_campaigns', function (Blueprint $table) {
            // Make 'message' column nullable
            $table->longText('message')->nullable()->change();
            // Make 'receivers' column nullable
            $table->text('receivers')->nullable()->change();
            $table->enum('schedule_type', ['onetime', 'recurring', 'series'])->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_campaigns', function (Blueprint $table) {
            $table->longText('message')->change();
            $table->text('receivers')->change();
            $table->enum('schedule_type', ['onetime', 'recurring'])->nullable()->change();
        });
    }
};
