<?php

use App\Models\StoreOrder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(StoreOrder::class);
            $table->string('email');
            $table->string('name');
            $table->string('phone_no');
            $table->longText('address');
            $table->string('state');
            $table->string('country');
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
        Schema::dropIfExists('order_users');
    }
};
