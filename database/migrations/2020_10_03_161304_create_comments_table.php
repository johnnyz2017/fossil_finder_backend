<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned();  //发表评论的用户id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('reply_comment_id')->unsigned(); //回复某个评论的id
            // $table->foreign('reply_comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('reply_comment_id')->references('id')->on('comments');

            $table->string('title'); //标题
            $table->longText('content'); //内容
            
            $table->bigInteger('category_id')->unsigned(); //该用户认为对分类信息，可能会被采用
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            
            $table->boolean('sticky')->default(false); //是否置顶
            $table->timestamp('sticky_time'); //被置顶时间
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
        Schema::dropIfExists('comments');
    }
}
