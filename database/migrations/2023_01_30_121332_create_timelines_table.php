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
        Schema::create('timelines', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('automation2_id')->index('mailtimelines_automation2_id_foreign');
            $table->unsignedInteger('subscriber_id')->index('mailtimelines_subscriber_id_foreign');
            $table->unsignedInteger('auto_trigger_id')->index('mailtimelines_auto_trigger_id_foreign');
            $table->string('activity');
            $table->timestamps();
            $table->string('activity_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timelines');
    }
};
