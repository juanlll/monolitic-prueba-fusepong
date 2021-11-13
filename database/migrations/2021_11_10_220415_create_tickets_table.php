<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('comments');
            $table->enum('status', ['ACTIVE','IN_PROCESS','FINISHED']);
            $table->integer('user_story_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_story_id')->references('id')->on('user_stories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tickets');
    }
}
