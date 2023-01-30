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
        Schema::table('user_activations', function (Blueprint $table) {
            $table->foreign(['user_id'], 'mailuser_activations_user_id_foreign')->references(['id'])->on('mailusers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_activations', function (Blueprint $table) {
            $table->dropForeign('mailuser_activations_user_id_foreign');
        });
    }
};
