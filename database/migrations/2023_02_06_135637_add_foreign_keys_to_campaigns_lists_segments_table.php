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
        Schema::table('campaigns_lists_segments', function (Blueprint $table) {
            $table->foreign(['campaign_id'], 'mailcls_campaign_id_fk')->references(['id'])->on('campaigns')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['mail_list_id'], 'mailcls_mail_list_id_fk')->references(['id'])->on('mail_lists')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['segment_id'], 'mailcls_segment_id_fk')->references(['id'])->on('segments')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns_lists_segments', function (Blueprint $table) {
            $table->dropForeign('mailcls_campaign_id_fk');
            $table->dropForeign('mailcls_mail_list_id_fk');
            $table->dropForeign('mailcls_segment_id_fk');
        });
    }
};
