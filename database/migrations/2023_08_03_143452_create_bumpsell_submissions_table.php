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
        Schema::create('bumpsell_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bumpsell_products_id');
            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('list_contact_id');
            $table->string('amount');
            $table->text('payment_link');
            $table->string('checkout_bump_products_ids');
            $table->string('status')->default('Pending');
            $table->unsignedBigInteger('page_id');
            $table->string('ref')->nullable();


            $table->timestamps();
            $table->foreign(['page_id'])->references(['id'])->on('pages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['bumpsell_products_id'])->references(['id'])->on('bumpsell_products')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
        Schema::dropIfExists('bumpsell_submissions');
    }
};
