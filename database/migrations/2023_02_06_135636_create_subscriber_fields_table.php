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
        Schema::create('subscriber_fields', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->unsignedInteger('subscriber_id')->index('mailsubscriber_fields_subscriber_id_foreign');
            $table->unsignedInteger('field_id')->index('mailsubscriber_fields_field_id_foreign');
            $table->text('value');
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
        Schema::dropIfExists('subscriber_fields');
    }
};
