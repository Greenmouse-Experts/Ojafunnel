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
        Schema::create('plugins', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->char('uid', 36);
            $table->string('name');
            $table->string('type')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('version');
            $table->string('status');
            $table->timestamps();
            $table->longText('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plugins');
    }
};
