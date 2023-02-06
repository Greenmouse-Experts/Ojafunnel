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
        Schema::table('customers', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailcustomers_admin_id_foreign')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['contact_id'], 'mailcustomers_contact_id_foreign')->references(['id'])->on('contacts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['language_id'], 'mailcustomers_language_id_foreign')->references(['id'])->on('languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('mailcustomers_admin_id_foreign');
            $table->dropForeign('mailcustomers_contact_id_foreign');
            $table->dropForeign('mailcustomers_language_id_foreign');
        });
    }
};
