<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            
            $table->bigInteger('user_id')->unsigned(); //发布用户
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->bigInteger('auth_user_id')->unsigned()->nullable(); //最后审核用户？
            $table->foreign('auth_user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->string('temp_id');
            $table->string('perm_id')->nullable();
            $table->string('title');
            $table->longText('content');
            $table->boolean('private')->default(true); //个人设置，是否私有
            $table->boolean('published')->default(false); //管理员审核，是否可以发布
            $table->longText('images'); //images url array
            
            $table->bigInteger('category_id')->unsigned()->nullable(); //类别
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('final_category_id')->unsigned()->nullable(); //最终类别
            $table->foreign('final_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('final_category_id_from')->unsigned()->nullable(); //最终类别来自于，默认会是自己
            $table->foreign('final_category_id_from')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            
            $table->double('coordinate_longitude'); //经度
            $table->double('coordinate_latitude'); //纬度
            $table->double('coordinate_altitude')->nullable(); //高度 海拔
            $table->string('address')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
