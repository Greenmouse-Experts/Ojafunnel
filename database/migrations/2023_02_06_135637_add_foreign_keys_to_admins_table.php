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
        Schema::table('admins', function (Blueprint $table) {
            //$table->foreign(['admin_group_id'], 'mailadmins_admin_group_id_foreign')->references(['id'])->on('admin_groups')->onUpdate('NO ACTION')->onDelete('CASCADE');
            // $table->foreign(['contact_id'], 'mailadmins_contact_id_foreign')->references(['id'])->on('contacts')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            // $table->foreign(['creator_id'], 'mailadmins_creator_id_foreign')->references(['id'])->on('mailusers')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            // $table->foreign(['language_id'], 'mailadmins_language_id_foreign')->references(['id'])->on('languages')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            //$table->foreign(['user_id'], 'mailadmins_user_id_foreign')->references(['id'])->on('mailusers')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign('mailadmins_admin_group_id_foreign');
            $table->dropForeign('mailadmins_contact_id_foreign');
            $table->dropForeign('mailadmins_creator_id_foreign');
            $table->dropForeign('mailadmins_language_id_foreign');
            $table->dropForeign('mailadmins_user_id_foreign');
        });
    }
};
