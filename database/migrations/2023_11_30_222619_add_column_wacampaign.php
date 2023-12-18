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
        // Auxilliary table for whstapp capaigns.
        // Schema::table('wa_campaigns_listener', function (Blueprint $table) {

        //     $table->boolean('notify_every_newcontact');
        // });

        // Auxilliary table for whstapp capaigns.
        Schema::table('sms_campaigns_listener', function (Blueprint $table) {

            // Contain the list sequence of the scheduled messages in the campaign
            // list ID
            // campaign ID
        });

        // Auxilliary table for whstapp capaigns.
        Schema::table('email_campaigns_listener', function (Blueprint $table) {
            // Contain the list sequence of the scheduled messages in the campaign
            // list ID
            // campaign ID
        });

        // Auxilliary table for whstapp capaigns.
        Schema::table('whatsapp_campaigns_listener', function (Blueprint $table) {
            // Contain the list sequence of the scheduled messages in the campaign
            // list ID
            // campaign ID
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
