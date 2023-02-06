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
        Schema::table('templates_categories', function (Blueprint $table) {
            $table->foreign(['category_id'], 'mailtemplates_categories_category_id_foreign')->references(['id'])->on('template_categories')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['template_id'], 'mailtemplates_categories_template_id_foreign')->references(['id'])->on('templates')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('templates_categories', function (Blueprint $table) {
            $table->dropForeign('mailtemplates_categories_category_id_foreign');
            $table->dropForeign('mailtemplates_categories_template_id_foreign');
        });
    }
};
