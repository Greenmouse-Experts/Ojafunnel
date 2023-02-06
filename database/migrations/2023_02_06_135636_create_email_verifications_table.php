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
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('result', 20)->index('mailemail_verifications_result_index');
            $table->text('details');
            $table->unsignedInteger('subscriber_id')->index('mailemail_verifications_subscriber_id_foreign');
            $table->unsignedInteger('email_verification_server_id')->index('mailev_email_verification_server_id_fk');
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
        Schema::dropIfExists('email_verifications');
    }
};
