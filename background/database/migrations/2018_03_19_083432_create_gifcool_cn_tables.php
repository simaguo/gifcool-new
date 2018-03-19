<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGifcoolCnTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gifs',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->comment('标题');
            $table->string('remote_img_url')->comment('远程地址');
            $table->string('local_img_url')->comment('本地地址');
            $table->integer('tag_id')->comment('tags表ID');
            $table->integer('source_id')->comment('sources表主键');
            $table->tinyInteger('https')->comment('remote是否支持https，1表示支持');
        });
        Schema::create('tags',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment('中文名');
            $table->string('mark')->comment('英文名');

        });
        Schema::create('sources',function (Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment('网站名');
            $table->string('site')->comment('域名');
            $table->string('api')->nullable()->comment('直接资源api');
            $table->string('type')->comment('采集资源类型：gif、img、video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gifs');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('sources');
    }
}
