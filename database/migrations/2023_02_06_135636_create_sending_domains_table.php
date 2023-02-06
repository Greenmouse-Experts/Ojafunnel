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
        Schema::create('sending_domains', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('admin_id')->nullable()->index('mailsending_domains_admin_id_foreign');
            $table->unsignedInteger('customer_id')->nullable()->index('mailsending_domains_customer_id_foreign');
            $table->string('name');
            $table->text('dkim_private');
            $table->text('dkim_public');
            $table->string('signing_enabled')->default('1');
            $table->string('status');
            $table->timestamps();
            $table->text('verification_token')->nullable();
            $table->unsignedInteger('sending_server_id')->nullable()->index('mailsending_domains_sending_server_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sending_domains');
    }
};
