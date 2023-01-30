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
        Schema::create('plans', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('admin_id')->nullable()->index('mailplans_admin_id_foreign');
            $table->unsignedInteger('currency_id')->index('mailplans_currency_id_foreign');
            $table->string('name');
            $table->decimal('price', 16);
            $table->string('frequency_amount');
            $table->string('frequency_unit');
            $table->text('options');
            $table->string('status');
            $table->timestamps();
            $table->boolean('tax_billing_required')->default(false);
            $table->text('description')->nullable();
            $table->string('visible')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
};
