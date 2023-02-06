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
        Schema::table('contact_numbers', function (Blueprint $table) {
            $table->foreign(['contact_list_id'])->references(['id'])->on('contact_lists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contact_numbers', function (Blueprint $table) {
            $table->dropForeign('contact_numbers_contact_list_id_foreign');
        });
    }
};
