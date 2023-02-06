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
        Schema::table('admin_groups', function (Blueprint $table) {
            $table->foreign(['creator_id'], 'mailadmin_groups_creator_id_foreign')->references(['id'])->on('mailusers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_groups', function (Blueprint $table) {
            $table->dropForeign('mailadmin_groups_creator_id_foreign');
        });
    }
};
