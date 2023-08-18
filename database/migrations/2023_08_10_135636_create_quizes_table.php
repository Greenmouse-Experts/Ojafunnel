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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->integer('session');
            $table->integer('course_id');
            $table->integer('user_id');
            $table->string('questions', 100);
            $table->string('option1', 50);
            $table->string('option2', 50);
            $table->string('option3', 50)->nullable();
            $table->string('option4', 50)->nullable();
            $table->string('ans', 50);
            
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
        Schema::dropIfExists('quizzes');
    }
};
