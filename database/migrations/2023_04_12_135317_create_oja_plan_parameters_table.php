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
        Schema::create('oja_plan_parameters', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id')->unsigned();
            $table->integer('page_builder')->default(0);
            $table->integer('funnel_builder')->default(0);
            $table->integer('wa_number')->default(0);
            $table->integer('sms_contact_list')->default(0);
            $table->integer('sms_automation')->default(0);
            $table->integer('whatsapp_automation')->default(0);
            $table->integer('store')->default(0);
            $table->integer('shop')->default(0);
            $table->integer('products')->default(0);
            $table->integer('courses')->default(0);
            $table->integer('birthday_contact_list')->default(0);
            $table->integer('birthday_automation')->default(0);
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
        Schema::dropIfExists('oja_plan_parameters');
    }
};
