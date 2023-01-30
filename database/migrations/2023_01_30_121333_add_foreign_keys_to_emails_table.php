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
        Schema::table('emails', function (Blueprint $table) {
            $table->foreign(['automation2_id'], 'mailemails_automation2_id_foreign')->references(['id'])->on('automation2s')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailemails_customer_id_foreign')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['template_id'], 'mailemails_template_id_foreign')->references(['id'])->on('templates')->onUpdate('NO ACTION')->onDelete('SET NULL');
            $table->foreign(['tracking_domain_id'], 'mailemails_tracking_domain_id_foreign')->references(['id'])->on('tracking_domains')->onUpdate('NO ACTION')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('emails', function (Blueprint $table) {
            $table->dropForeign('mailemails_automation2_id_foreign');
            $table->dropForeign('mailemails_customer_id_foreign');
            $table->dropForeign('mailemails_template_id_foreign');
            $table->dropForeign('mailemails_tracking_domain_id_foreign');
        });
    }
};
