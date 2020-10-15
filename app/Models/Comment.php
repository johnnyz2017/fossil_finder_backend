<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'sticky_time'];

    public function post(){
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // public function comment(){
    //     return $this->belongsTo(Comment::class, 'reply_comment_id', 'id');
    // }

    // public function category(){
    //     return $this->belongsTo(Category::class, 'category_id', 'id');
    // }
}

// $table->bigInteger('user_id')->unsigned()->nullable();  //发表评论的用户id

// $table->bigInteger('reply_comment_id')->unsigned()->nullable(); //回复某个评论的id

// $table->string('title'); //标题
// $table->longText('content'); //内容

// $table->bigInteger('category_id')->unsigned()->nullable(); //该用户认为对分类信息，可能会被采用
// $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

// $table->boolean('sticky')->default(false); //是否置顶
// $table->timestamp('sticky_time'); //被置顶时间
// $table->timestamps();
