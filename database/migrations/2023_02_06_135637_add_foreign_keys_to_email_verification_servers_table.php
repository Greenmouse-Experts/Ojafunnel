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
        Schema::table('email_verification_servers', function (Blueprint $table) {
            $table->foreign(['admin_id'], 'mailevs_admin_id_fk')->references(['id'])->on('admins')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['customer_id'], 'mailevs_customer_id_fk')->references(['id'])->on('customers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('email_verification_servers', function (Blueprint $table) {
            $table->dropForeign('mailevs_admin_id_fk');
            $table->dropForeign('mailevs_customer_id_fk');
        });
    }
};
