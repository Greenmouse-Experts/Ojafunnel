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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('category_id')->unsigned()->references('id')->on('categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('language')->nullable();
            $table->string('image')->nullable();
            $table->enum('level', ['all', 'beginner', 'intermediate', 'advanced'])->nullable();
            $table->boolean('featured')->default(false);
            $table->decimal('price', 10,2)->default(0);
            $table->boolean('published')->default(false);
            $table->boolean('approved')->default(false);
            $table->text('settings')->nullable();
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
        Schema::dropIfExists('courses');
    }
};
