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
        Schema::table('campaign_links', function (Blueprint $table) {
            $table->foreign(['campaign_id'], 'mailcampaign_links_campaign_id_foreign')->references(['id'])->on('campaigns')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_links', function (Blueprint $table) {
            $table->dropForeign('mailcampaign_links_campaign_id_foreign');
        });
    }
};
