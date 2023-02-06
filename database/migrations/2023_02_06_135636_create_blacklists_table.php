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
        Schema::create('blacklists', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('email');
            $table->timestamps();
            $table->text('reason')->nullable();
            $table->unsignedInteger('admin_id')->nullable()->index('mailblacklists_admin_id_foreign');
            $table->unsignedInteger('customer_id')->nullable()->index('mailblacklists_customer_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blacklists');
    }
};
