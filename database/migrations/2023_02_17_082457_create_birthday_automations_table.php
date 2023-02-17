<?php

use App\Models\BirthdayContactList;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('birthday_automations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(BirthdayContactList::class);
            $table->string('title');
            $table->string('sms_type');
            $table->longText('message');
            $table->json('automation');
            $table->text('cache')->nullable();
            $table->enum('status', ['processing', 'scheduled', 'delivered', 'stopped', 'paused',])->default('scheduled');
            $table->string('sender_name')->nullable();
            $table->string('sending_server')->nullable();
            $table->string('sender_id')->nullable();
            $table->string('integration')->nullable();
            $table->date('start_date');
            $table->json('end_date');
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
        Schema::dropIfExists('birthday_automations');
    }
};
