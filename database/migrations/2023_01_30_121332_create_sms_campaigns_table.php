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
        Schema::create('sms_campaigns', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('title', 55);
            $table->longText('message');
            $table->unsignedBigInteger('user_id')->index('sms_campaigns_user_id_foreign');
            $table->text('receivers');
            $table->string('sms_type', 15)->nullable();
            $table->longText('media_url')->nullable();
            $table->string('status', 55)->default('Active');
            $table->timestamp('created_at')->useCurrent();
            $table->string('sender_name')->nullable();
            $table->string('optout_message')->nullable();
            $table->string('integration')->nullable();
            $table->text('cache')->nullable();
            $table->string('timezone')->nullable();
            $table->timestamp('schedule_time')->nullable();
            $table->enum('schedule_type', ['onetime', 'recurring'])->nullable();
            $table->string('frequency_cycle', 50)->nullable();
            $table->integer('frequency_amount')->nullable();
            $table->string('frequency_unit', 8)->nullable();
            $table->timestamp('recurring_end')->nullable();
            $table->timestamp('run_at')->nullable();
            $table->timestamp('delivery_at')->nullable();
            $table->text('reason')->nullable();
            $table->string('batch_id')->nullable();
            $table->integer('running_pid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sms_campaigns');
    }
};
