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
        Schema::create('campaigns_lists_segments', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('campaign_id')->index('mailcls_campaign_id_fk');
            $table->unsignedInteger('mail_list_id')->index('mailcls_mail_list_id_fk');
            $table->unsignedInteger('segment_id')->nullable()->index('mailcls_segment_id_fk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns_lists_segments');
    }
};
