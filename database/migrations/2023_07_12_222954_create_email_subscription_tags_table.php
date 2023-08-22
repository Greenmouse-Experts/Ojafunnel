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
        Schema::create('email_subscription_tags', function (Blueprint $table) {
            $table->id();
            $table->string('recepient');
            $table->string('tags');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return voidemail_subscription_tags
     */
    public function down()
    {
        Schema::dropIfExists('email_subscription_tags');
    }
};
