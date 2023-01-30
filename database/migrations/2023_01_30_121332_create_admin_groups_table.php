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
        Schema::create('admin_groups', function (Blueprint $table) {
            $table->comment('');
            $table->increments('id');
            $table->string('name');
            $table->text('options')->nullable();
            $table->text('permissions')->nullable();
            $table->unsignedInteger('creator_id')->nullable()->index('mailadmin_groups_creator_id_foreign');
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
        Schema::dropIfExists('admin_groups');
    }
};
