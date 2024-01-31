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
            $table->string('submitted')->nullable()->change();
            $table->string('answer')->nullable()->change();
            $table->string('order_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quiz_submissions', function (Blueprint $table) {
            $table->dropColumn('submitted');
            $table->dropColumn('answer');
            $table->dropColumn('order_no');
        });
    }
};
