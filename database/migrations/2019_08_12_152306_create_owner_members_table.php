<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwnerMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('owner_members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('owner_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->index(['owner_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('owner_members');
    }
}
