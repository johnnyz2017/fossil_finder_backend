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

    public function sharedUsers(){
        // return $this->belongsToMany(\App\Models\User::class, 'user_post', 'user_id', 'id');
        return $this->belongsToMany(\App\Models\User::class);
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
            $data['author'] = User::find($this->user_id)->name;
        }else{
            $data['author'] = '未命名';
        }

        if($this->comments){
            $data['comments'] = $this->comments; 
        }else{
            $data['comments'] = [];
        }

        if($this->category_id){
            $data['category_name'] = Category::find($this->category_id)->title;
        }else{
            $data['category_name'] = '';
        }

        return $data;
    }

    public function toOrigArray()
    {
        $data = parent::toArray();
        $data['label'] = $this->title;
        $data['key'] = "p_".(string)$this->id;
        if($this->category_id){
            $data['category_name'] = Category::find($this->category_id)->title;
        }else{
            $data['category_name'] = '未鉴定';
        }
        return $data;
    }
}
