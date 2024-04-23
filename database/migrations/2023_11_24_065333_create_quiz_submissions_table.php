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
            $table->foreign(['course_id'])
                ->references(['id'])
                ->on('courses')->onUpdate('NO ACTION')->onDelete('NO ACTION'); // Course
            $table->foreign(['quiz_id'])
                ->references(['id'])
                ->on('lms_quizzes')->onUpdate('NO ACTION')->onDelete('NO ACTION'); // LMS Quiz
            $table->unsignedBigInteger('session'); // Session
            $table->foreign(['question_id'])
                ->references(['id'])
                ->on('quizzes')->onUpdate('NO ACTION')->onDelete('NO ACTION'); // Quiz
            $table->string('submitted')->nullable();
            $table->string('answer')->nullable();
            $table->string('order_no')->nullable();
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
