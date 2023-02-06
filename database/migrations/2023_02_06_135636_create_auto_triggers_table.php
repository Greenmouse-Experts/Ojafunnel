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
        Schema::create('auto_triggers', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('subscriber_id')->nullable()->index('mailauto_triggers_subscriber_id_foreign');
            $table->timestamps();
            $table->text('data')->nullable();
            $table->unsignedInteger('automation2_id')->index('mailauto_triggers_automation2_id_foreign');
            $table->text('executed_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auto_triggers');
    }
};
