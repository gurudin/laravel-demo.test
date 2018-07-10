<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAuthGroupItemChild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_group_item_child', function (Blueprint $table) {
            $table->integer('group_id');
            $table->string('item_name', 64);

            $table->primary(['group_id', 'item_name']);
            $table->index('item_name', 'inx-item_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_group_item_child');
    }
}
