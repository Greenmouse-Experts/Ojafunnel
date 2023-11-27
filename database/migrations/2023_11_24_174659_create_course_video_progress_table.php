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
        Schema::create('course_video_progress', function (Blueprint $table) {
            $table->id();
            $table->string('candidate');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedBigInteger('lesson_id');
            $table->string('time'); // 4:03
            $table->string('achieved'); //0% - 100%
            $table->timestamps();

            $table->foreign(['course_id'])
                ->references(['id'])
                ->on('courses')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign(['section_id'])
                ->references(['id'])
                ->on('sections')->onUpdate('NO ACTION')->onDelete('NO ACTION');

            $table->foreign(['lesson_id'])
                ->references(['id'])
                ->on('lessons')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('course_video_progress');
    }
};
