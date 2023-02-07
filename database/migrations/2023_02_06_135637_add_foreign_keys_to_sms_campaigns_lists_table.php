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
        Schema::table('sms_campaigns_lists', function (Blueprint $table) {
            $table->foreign(['contact_list_id'])->references(['id'])->on('contact_lists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_campaigns_lists', function (Blueprint $table) {
            $table->dropForeign('sms_campaigns_lists_contact_list_id_foreign');
        });
    }
};
