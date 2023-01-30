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
        Schema::table('mailtransactions', function (Blueprint $table) {
            $table->foreign(['invoice_id'])->references(['id'])->on('invoices')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mailtransactions', function (Blueprint $table) {
            $table->dropForeign('mailtransactions_invoice_id_foreign');
        });
    }
};
