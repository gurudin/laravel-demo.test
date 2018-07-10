<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAuthGroupUserChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_group_user_child', function (Blueprint $table) {
            $table->integer('group_id');
            $table->string('user_id', 64);

            $table->primary(['group_id', 'user_id']);
            $table->index('user_id', 'inx-user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_group_user_child');
    }
}
