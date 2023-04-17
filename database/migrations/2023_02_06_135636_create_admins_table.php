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
        Schema::create('admins', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->char('uid', 36);
            $table->unsignedInteger('user_id')->index('mailadmins_user_id_foreign');
            // $table->unsignedInteger('creator_id')->nullable()->index('mailadmins_creator_id_foreign');
            // $table->unsignedInteger('contact_id')->nullable()->index('mailadmins_contact_id_foreign');
            $table->unsignedInteger('admin_group_id')->index('mailadmins_admin_group_id_foreign');
            $table->unsignedInteger('language_id')->nullable()->index('mailadmins_language_id_foreign');
            $table->string('timezone');
            $table->string('status')->nullable();
            $table->string('color_scheme')->nullable();
            $table->timestamps();
            $table->string('text_direction')->default('ltr');
            $table->string('menu_layout')->default('none');
            $table->string('theme_mode')->default('light');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
