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
        Schema::table('timelines', function (Blueprint $table) {
            $table->foreign(['automation2_id'], 'mailtimelines_automation2_id_foreign')->references(['id'])->on('automation2s')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['auto_trigger_id'], 'mailtimelines_auto_trigger_id_foreign')->references(['id'])->on('auto_triggers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['subscriber_id'], 'mailtimelines_subscriber_id_foreign')->references(['id'])->on('subscribers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('timelines', function (Blueprint $table) {
            $table->dropForeign('mailtimelines_automation2_id_foreign');
            $table->dropForeign('mailtimelines_auto_trigger_id_foreign');
            $table->dropForeign('mailtimelines_subscriber_id_foreign');
        });
    }
};
