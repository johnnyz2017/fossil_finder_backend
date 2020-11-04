<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $hidden = ['created_at', 'updated_at'];

    public function parent(){
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childs(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }


    public function audit_posts(){
        return $this->hasMany(Post::class, 'final_category_id', 'id');
    }

    public function toWithAllParentsArray(){
        $data = parent::toArray();

        if($this->parent){
            $data['parent'] = $this->parent->toWithAllParentsArray();
        }else{
            $data['prarent'] = null;
        }

        return $data;
    }

    public function toOrigArray(){
        $data = parent::toArray();

        // dd($this->childs);// 4 5

        $children = [];
        if($this->childs){
            foreach($this->childs as $child){
                array_push($children, $child->toOrigArray());
            }
        }
        return $data;
    }

    public function toArray()
    {
        $data = parent::toArray();

        // if($this->posts){
        //     // $data['posts'] = $this->posts->toArray();
        //     $data['posts'] = $this->posts->map(function($post){
        //         return $post->toArrayTest();
        //     });
        // }else{
        //     $data['posts'] = null;
        // }

        // $data['key'] = (string)$data['id'];
        // $date['label'] = $data['title'];

        $children = [];
        if($this->childs){
            foreach($this->childs as $child){
                array_push($children, $child->toArray());
            }
        }

        // if($this->posts){
        //     $post = $this->posts->map(function($post){
        //         return $post->toArrayTest();
        //     });
        //     array_push($children, $post);
        // }

        $data['label'] = $this->title;
        $data['key'] = (string)$this->id;

        $data['children'] = $children;

        // if($this->parent){
        //     $data['parent'] = $this->parent;
        // }

        return $data;
    }
}
