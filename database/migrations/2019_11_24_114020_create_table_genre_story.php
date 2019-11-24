<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGenreStory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_story', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger("story_id")->unsigned();
            $table->foreign('story_id')->references('id')->on('stories');
            $table->bigInteger("genre_id")->unsigned();
            $table->foreign('genre_id')->references('id')->on('genres');
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
        Schema::dropIfExists('genre_story');
    }
}
