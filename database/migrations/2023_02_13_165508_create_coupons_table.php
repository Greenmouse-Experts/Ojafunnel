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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->unsigned()->nullable()->references('id')->on('courses')->onDelete('cascade');
            $table->string('code')->nullable();
            $table->integer('percent')->nullable();
            $table->integer('quantity')->nullable();
            $table->date('expires')->nullable();
            $table->boolean('active')->default(false);
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
        Schema::dropIfExists('coupons');
    }
};
