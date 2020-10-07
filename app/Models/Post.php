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
}
