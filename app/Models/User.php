<?php

namespace App\Models;
use App\Models\Post;
use App\Models\Role;
use App\Models\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // one to one
    public function post()
    {
        return $this->hasOne(Post::class,"user_id","id");
    }
    // one to many
    public function posts()
    {
        return $this->hasMany(Post::class,"user_id","id");
    }
    //has one through
    public function comment()
    {
        return $this->hasOneThrough(Comment::class,Post::class,"user_id","post_id","id","id");
    }
    //has many through
    public function comments()
    {
        return $this->hasManyThrough(Comment::class,Post::class,"user_id","post_id","id","id");
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
}
