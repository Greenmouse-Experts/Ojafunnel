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
        Schema::create('mail_lists', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid');
            $table->integer('user_id')->unsigned();
            $table->string('name', 250)->index();
            $table->string('display_name', 250);
            $table->string('slug', 250)->unique();
            $table->text('description')->nullable();
            $table->boolean('unsubscribe_notification')->default(false);
            $table->string('status')->default(true);
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
        Schema::dropIfExists('mail_lists');
    }
};
