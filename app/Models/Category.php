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

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function parent(){
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function childs(){
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    // public function countChilds(){
    //     // return count($this->hasMany(self::class, 'parent_id', 'id'));
    //     return $this->hasMany(self::class, 'parent_id', 'id')->count();
    // }

    public function posts(){
        return $this->hasMany(Post::class, 'category_id', 'id');
    }

    // public function countPosts(){
    //     //return count($this->hasMany(Post::class, 'category_id', 'id'));
    //     return 1;
    // }


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

    public function toArray()
    {
        $data = parent::toArray();

        return $data;
    }

    public function toChildrenArray(){
        $data = parent::toArray();

        $children = [];
        if($this->childs){
            foreach($this->childs as $child){
                array_push($children, $child->toChildrenArray());
            }
        }

        $data['label'] = $this->title;
        $data['key'] = "c_".(string)$this->id;
        $data['children'] = $children;
        
        return $data;
    }

    public function toChildrenPostArray()
    {
        $data = parent::toArray();

        $children = [];
        if($this->childs){
            foreach($this->childs as $child){
                array_push($children, $child->toChildrenPostArray());
            }
        }

        if($this->posts){
            foreach($this->posts as $post){
                if($post->published == true && $post->private == false)
                    array_push($children, $post->toOrigArray());
            }
        }

        $data['label'] = $this->title;
        $data['key'] = "c_".(string)$this->id;
        $data['children'] = $children;

        return $data;
    }
}
