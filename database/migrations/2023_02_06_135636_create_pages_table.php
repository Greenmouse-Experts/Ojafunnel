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
        Schema::create('pages', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->unsignedBigInteger('list_id')->nullable()->references('id')->on('list_management')->onDelete('cascade');
            $table->string('user_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('folder')->nullable();
            $table->string('file_location')->nullable();
            $table->string('type')->nullable();
            $table->string('slug');
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('pages');
    }
};
