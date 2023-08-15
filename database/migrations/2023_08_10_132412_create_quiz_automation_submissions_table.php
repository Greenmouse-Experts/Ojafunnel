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
        Schema::create('quiz_automation_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_automation_id');
            $table->longText('response')->nullable();
            $table->timestamps();

            $table->foreign(['quiz_automation_id'])->references(['id'])->on('quiz_automation_forms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quiz_automation_submissions');
    }
};
