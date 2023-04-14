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
        Schema::create('email_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('email_kit_id');
            $table->string('list_id');
            $table->string('name');
            $table->string('description');
            $table->string('email_template_id');
            $table->string('message');
            $table->string('sent');
            $table->string('bounced');
            $table->string('spam_score');
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
        Schema::dropIfExists('email_campaigns');
    }
};
