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
        Schema::table('segment_conditions', function (Blueprint $table) {
            $table->foreign(['field_id'], 'mailsegment_conditions_field_id_foreign')->references(['id'])->on('fields')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['segment_id'], 'mailsegment_conditions_segment_id_foreign')->references(['id'])->on('segments')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('segment_conditions', function (Blueprint $table) {
            $table->dropForeign('mailsegment_conditions_field_id_foreign');
            $table->dropForeign('mailsegment_conditions_segment_id_foreign');
        });
    }
};
