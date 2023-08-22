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
        Schema::create('dynamic_timer_page_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('page_id');
            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('list_contact_id');
            $table->text('payment_link');
            $table->string('status')->default('Pending');
            $table->timestamps();

            $table->foreign(['page_id'])->references(['id'])->on('pages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['list_id'])->references(['id'])->on('list_management')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['list_contact_id'])->references(['id'])->on('list_management_contacts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dynamic_timer_page_submissions');
    }
};
