<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutCommentsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //评论表
        Schema::create('gif_comments',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('pid')->default(0)->comment('父id');
            $table->integer('gif_id')->index()->comment('gifs主键');
            $table->integer('user_id')->index()->comment('users主键');
            $table->string('content',300)->comment('评论内容');
        });
        //收藏表
        Schema::create('gif_collections',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->softDeletes();
            $table->integer('gif_id')->index()->comment('gifs主键');
            $table->integer('user_id')->index()->comment('users主键');
        });
        //喜欢/不喜欢
        Schema::create('gif_supports',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->integer('gif_id')->index()->comment('gifs主键');
            $table->integer('user_id')->index()->comment('users主键');
            $table->tinyInteger('support')->default(0)->comment('0中立,1喜欢，2讨厌');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gif_comments');
        Schema::dropIfExists('gif_collections');
        Schema::dropIfExists('gif_supports');
    }
}
