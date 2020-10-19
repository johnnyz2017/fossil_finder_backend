<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }

    public function category(){
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
    }

    public function final_category(){
        return $this->belongsTo(\App\Models\Category::class, 'final_category_id', 'id');
    }

    public function category_user(){
        return $this->belongsTo(\App\Models\User::class, 'final_category_id_from', 'id');
    }

    public function auth_user(){
        return $this->belongsTo(\App\Models\User::class, 'auth_user_id', 'id');
    }

    public function comments(){
        return $this->hasMany(\App\Models\Comment::class, 'post_id', 'id');
    }

    public function toArray()
    {
        $data = parent::toArray();
        if($this->images){
            $image_list = explode(',', $this->images);
            $images = [];
            foreach($image_list as $image){
                $img = [];
                $img['url'] = $image; // use url($image);
                array_push($images, $img);
            }
            $data['images'] = $images; 
        }else{
            $data['images'] = [];
        }

        if($this->user_id){
            //echo $this->user_id;
            //echo User::find($this->user_id)->name;
            $data['author'] = User::find($this->user_id)->name;
        }else{
            $data['author'] = 'unkown';
        }

        if($this->comments){
            $data['comments'] = $this->comments; 
        }else{
            $data['comments'] = [];
        }
        // $data['author'] = 'Author Test';

        return $data;

        //test
        // $newdata  = array(
        //     'id' => $this->id, 
        //     'title' => $this->title,
        //     'contents' => $this->content,
        //     'author' => 'autor test',
        //     'images' => [],
        //     'comments' => []
        // );

        // return $newdata;
    }
}
