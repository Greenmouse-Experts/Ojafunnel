<?php

use App\Models\BirthdayContactList;
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
        Schema::create('birthday_contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BirthdayContactList::class);
            $table->string('name');
            $table->date('date_of_birth');
            $table->date('anniv_date')->nullable();
            $table->string('phone_number');
            $table->string('email');
            $table->enum('status', ['subscribed', 'unsubscribed'])->default('subscribed');
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
        Schema::dropIfExists('birthday_contacts');
    }
};
