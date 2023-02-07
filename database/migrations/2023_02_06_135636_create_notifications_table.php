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
        Schema::create('notifications', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->text('type');
            $table->text('title');
            $table->text('message');
            $table->text('level');
            $table->unsignedInteger('admin_id')->nullable()->index('mailnotifications_admin_id_foreign');
            $table->unsignedInteger('customer_id')->nullable()->index('mailnotifications_customer_id_foreign');
            $table->timestamps();
            $table->boolean('visibility')->default(true);
            $table->mediumText('debug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
