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
        Schema::create('products', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('customer_id')->index('mailproducts_customer_id_foreign');
            $table->unsignedInteger('source_id')->index('mailproducts_source_id_foreign');
            $table->string('title')->nullable();
            $table->mediumText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('price')->nullable();
            $table->timestamps();
            $table->string('source_item_id')->nullable();
            $table->longText('meta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
