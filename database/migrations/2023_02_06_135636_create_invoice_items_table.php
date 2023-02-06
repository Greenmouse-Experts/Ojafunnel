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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('invoice_id')->index('mailinvoice_items_invoice_id_foreign');
            $table->string('item_id');
            $table->string('item_type');
            $table->double('amount', 16, 2)->default(0);
            $table->double('tax', 16, 2)->default(0);
            $table->double('discount', 16, 2)->default(0);
            $table->string('title');
            $table->text('description');
            $table->timestamps();
            $table->decimal('vat', 16)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_items');
    }
};
