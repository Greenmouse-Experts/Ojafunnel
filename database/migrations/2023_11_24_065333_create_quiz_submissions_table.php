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
        Schema::create('quiz_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Course
            $table->unsignedBigInteger('quiz_id'); // LMS Quiz
            $table->unsignedBigInteger('session'); // Session
            $table->unsignedBigInteger('question_id'); // Quiz
            $table->string('submitted');
            $table->string('answer');
            $table->string('status'); // Pass | Wrong
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
        Schema::dropIfExists('quiz_submissions');
    }
};
