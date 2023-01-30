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
        Schema::table('campaigns', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'mailcampaigns_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['default_mail_list_id'], 'mailcampaigns_default_mail_list_id_foreign')->references(['id'])->on('mail_lists')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['template_id'], 'mailcampaigns_template_id_foreign')->references(['id'])->on('templates')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['tracking_domain_id'], 'mailcampaigns_tracking_domain_id_foreign')->references(['id'])->on('tracking_domains')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaigns', function (Blueprint $table) {
            $table->dropForeign('mailcampaigns_customer_id_foreign');
            $table->dropForeign('mailcampaigns_default_mail_list_id_foreign');
            $table->dropForeign('mailcampaigns_template_id_foreign');
            $table->dropForeign('mailcampaigns_tracking_domain_id_foreign');
        });
    }
};
