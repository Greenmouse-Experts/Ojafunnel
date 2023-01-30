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
        Schema::table('mailusers', function (Blueprint $table) {
            $table->foreign(['creator_id'])->references(['id'])->on('mailusers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['customer_id'])->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailusers', function (Blueprint $table) {
            $table->dropForeign('mailusers_creator_id_foreign');
            $table->dropForeign('mailusers_customer_id_foreign');
        });
    }
};
