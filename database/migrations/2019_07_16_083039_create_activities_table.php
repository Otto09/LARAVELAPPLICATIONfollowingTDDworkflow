<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('user_id');

            $table->unsignedInteger('owner_id');
            
            // $table->morphs('subject');
            $table->nullableMorphs('subject');
            // $table->unsignedInteger('subject_id');            
            // $table->string('subject_type');

            $table->string('explanation');

            $table->text('changes')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')
                
                ->onDelete('cascade');

            $table->foreign('owner_id')->references('id')->on('owners')
                
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
