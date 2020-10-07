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

    public function toArray()
    {
        $data = parent::toArray();

        if($this->posts){
            $data['posts'] = $this->posts->toArray();
        }else{
            $data['posts'] = null;
        }

        if($this->childs){
            $children = [];
            foreach($this->childs as $child){
                array_push($children, $child->toArray());
            }
            $data['children'] = $children;
        }

        return $data;
    }
}
