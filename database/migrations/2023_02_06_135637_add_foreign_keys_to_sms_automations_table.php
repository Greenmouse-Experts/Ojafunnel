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
        Schema::table('sms_automations', function (Blueprint $table) {
            $table->foreign(['integration_id'])->references(['id'])->on('integrations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['mailinglist_id'])->references(['id'])->on('linglists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sms_automations', function (Blueprint $table) {
            $table->dropForeign('sms_automations_integration_id_foreign');
            $table->dropForeign('sms_automations_mailinglist_id_foreign');
        });
    }
};
