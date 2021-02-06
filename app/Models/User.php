<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens;
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image', 'description', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verified_at', 'updated_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function name(){
        return $this->name;
    }

    public function role(){
        return $this->role;
    }

    public function categories(){
        return $this->hasMany(Category::class, 'user_id', 'id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function roles(){
        // return $this->belongsToMany(Role::class, '')
        return User::whereRoles('administrator')->get();
    }

    // public function admins(){
    //     // return $this->query('');
    //     // return Role::with
    // }

    // public

    public function toArray()
    {
        $data = parent::toArray();
        $data['posts_count'] = $this->posts()->count();
        $data['categories_count'] = $this->categories()->count();
        $data['comments_count'] = $this->comments()->count();

        return $data;
    }
}
