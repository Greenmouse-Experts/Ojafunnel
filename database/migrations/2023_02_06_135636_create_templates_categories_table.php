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
        Schema::create('templates_categories', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('template_id')->index('mailtemplates_categories_template_id_foreign');
            $table->unsignedInteger('category_id')->index('mailtemplates_categories_category_id_foreign');
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
        Schema::dropIfExists('templates_categories');
    }
};
