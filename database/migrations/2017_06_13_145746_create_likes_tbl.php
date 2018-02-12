<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLikesTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('likes', function (Blueprint $table) {
            //$table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();

            //references
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

            //$table->primary(['user_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
        });
        Schema::dropIfExists('likes');
    }
}
