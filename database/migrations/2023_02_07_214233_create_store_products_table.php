<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Store;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('name');
            $table->longText('description');
            $table->string('image');
            $table->string('price')->default('0.00');
            $table->bigInteger('quantity')->default(1);
            $table->foreignIdFor(Store::class);
            $table->enum('type', ['Digital', 'Physical'])->default('Physical');
            // $table->string('ref_number')->nullable();
            // $table->string('comm_type')->nullable();
            // $table->string('comm_level')->nullable();
            // $table->string('commission')->nullable();
            $table->string('date_from', 50)->nullable();
            $table->string('date_to', 50)->nullable();
            $table->string('new_price')->default(0);
            $table->string('level1_comm');
            $table->string('level2_comm');
            $table->string('currency')->nullable();
            $table->string('currency_sign')->nullable();
            $table->enum('content_type', ['video', 'audio', 'ebook'])->nullable();
            $table->string('link')->nullable();
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
        Schema::dropIfExists('store_products');
    }
};
