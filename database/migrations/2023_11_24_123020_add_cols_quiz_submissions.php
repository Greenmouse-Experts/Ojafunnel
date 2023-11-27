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
        Schema::table('quiz_submissions', function (Blueprint $table) {
            $table->string('candidate');

            $table->foreign(['course_id'])
                ->references(['id'])
                ->on('courses')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign(['quiz_id'])
                ->references(['id'])
                ->on('lms_quizzes')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign(['question_id'])
                ->references(['id'])
                ->on('quizzes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
