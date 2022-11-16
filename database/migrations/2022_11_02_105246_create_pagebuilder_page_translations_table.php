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
        Schema::create('pagebuilder_page_translations', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedInteger('page_id');
            // $table->string('locale', 50);
            // $table->string('title', 255);
            // $table->string('route', 255);
            // $table->timestamps();

            // $table->unique(['page_id', 'locale']);
            // $table->foreign('page_id')->references('id')
            //     ->on('pagebuilder_pages')
            //     ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('pagebuilder_pages', function (Blueprint $table) {
        //     $table->string('route', 512)->unique()->after('name');
        //     $table->string('title', 256)->after('name');
        // });

        // Schema::dropIfExists('pagebuilder_page_translations');
    }
};
