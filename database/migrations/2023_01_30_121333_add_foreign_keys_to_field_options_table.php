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
        Schema::table('field_options', function (Blueprint $table) {
            $table->foreign(['field_id'], 'mailfield_options_field_id_foreign')->references(['id'])->on('fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field_options', function (Blueprint $table) {
            $table->dropForeign('mailfield_options_field_id_foreign');
        });
    }
};
