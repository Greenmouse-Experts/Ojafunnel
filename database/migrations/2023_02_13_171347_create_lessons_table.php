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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id')->unsigned()->references('id')->on('sections')->onDelete('cascade');;
            $table->integer('course_id')->unsigned()->references('id')->on('courses')->onDelete('cascade');
            $table->string('lesson_type')->default('lecture');
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('content_type', ['video', 'youtube', 'article', 'quiz'])->nullable();
            $table->decimal('duration')->default(0);
            $table->boolean('preview')->default(false);
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
        Schema::dropIfExists('lessons');
    }
};
