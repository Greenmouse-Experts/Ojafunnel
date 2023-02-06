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
        Schema::create('tracking_domains', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->char('uid', 36);
            $table->unsignedInteger('customer_id')->index('mailtracking_domains_customer_id_foreign');
            $table->string('name');
            $table->string('status');
            $table->timestamps();
            $table->string('scheme');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_domains');
    }
};
