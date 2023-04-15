<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    // protected $fillable = ['title','isActive','description','is_published'];
    protected $guarded =[];
    // public function user()
    // {
    //     return $this->hasOne(User::class,"id","user_id");
    // }
    public function user()
    {
        return $this->belongsTo(User::class,"user_id","id");
    }
    public function image()
    {
        return $this->morphOne(Image::class,'imageable');
    }
    public function images()
    {
        return $this->morphMany(Image::class,'imageable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class,'taggable');
    }
}
