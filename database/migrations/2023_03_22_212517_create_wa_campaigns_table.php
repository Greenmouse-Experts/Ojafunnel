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
        Schema::create('wa_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('whatsapp_account');
            $table->string('user_id');
            $table->string('contact_list_id');
            $table->string('template');

            // template 1
            $table->string('template1_message')->nullable();
            // template 2
            $table->string('template2_message')->nullable();
            $table->string('template2_file')->nullable();
            // template 3
            $table->string('template3_header')->nullable();
            $table->string('template3_message')->nullable();
            $table->string('template3_footer')->nullable();
            $table->string('template3_link_url')->nullable();
            $table->string('template3_link_cta')->nullable();
            $table->string('template3_phone_number')->nullable();
            $table->string('template3_phone_cta')->nullable();

            //
            $table->string('message_timing');

            // schedule
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('next_due_date')->nullable();
            $table->string('frequency_cycle')->nullable();
            $table->string('frequency_amount')->nullable();
            $table->string('frequency_unit')->nullable();

            $table->tinyInteger('notify_every_newcontact')->nullable();

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
        Schema::dropIfExists('wa_campaigns');
    }
};
