<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('like_post', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('like_id')->unsigned();
          $table->foreign('like_id')->references('id')->on('likes')->onDelete('cascade');

          $table->integer('post_id')->unsigned();
          $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('like_post');
    }
}
