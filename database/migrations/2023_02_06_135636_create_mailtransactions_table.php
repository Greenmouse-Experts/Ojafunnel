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
        Schema::create('mailtransactions', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('invoice_id')->index('mailtransactions_invoice_id_foreign');
            $table->longText('error')->nullable();
            $table->string('status');
            $table->string('method');
            $table->longText('metadata')->nullable();
            $table->timestamps();
            $table->boolean('allow_manual_review')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailtransactions');
    }
};
