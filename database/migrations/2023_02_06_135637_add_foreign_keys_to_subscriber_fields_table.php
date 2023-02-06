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
        Schema::table('subscriber_fields', function (Blueprint $table) {
            $table->foreign(['field_id'], 'mailsubscriber_fields_field_id_foreign')->references(['id'])->on('fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['subscriber_id'], 'mailsubscriber_fields_subscriber_id_foreign')->references(['id'])->on('subscribers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriber_fields', function (Blueprint $table) {
            $table->dropForeign('mailsubscriber_fields_field_id_foreign');
            $table->dropForeign('mailsubscriber_fields_subscriber_id_foreign');
        });
    }
};
