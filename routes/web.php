<?php

use App\Http\Controllers\OldPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostsController;
use App\Models\Image;
use App\Models\Post;
use App\Models\Role;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/con', function () {
//     try {
//         DB::connection()->getPdo();
//         return "connection created";
//     } catch (\Exception $e) {
//         dd($e->getMessage());
//     }
// });

// Route::get('/',function(){
//     Post::create([
//         'title'=>'laravel 9',
//         'isActive'=>false,
//         'description'=>'this is laravel 9 tut',
//         'is_published'=>false
//     ]);
//     return "insertion success";
// });
// Route::get('/fetch',function(){
//     // $post = Post::all();
//     // $post = Post::find(1);
//     // $post = Post::findorfail(4);
//     $post = Post::where(['title'=>'laravel 9',"description"=>"this is laravel 9 tut"])->get();
//     return $post;
// });
// Route::get('/update',function(){
//     $post = Post::where(["title"=>"Laravel 9","description"=>"This is Laravel 9 tutorial"])->first();
//     if(!$post){
//         return "Data not found";
//     }
//     $post->update([
//         "title"=>"Laravel 10",
//         "description"=>"This is Laravel 10 tutorial"
//     ]);
//     return "data updated";
// });
// Route::get('/delete',function(){
//     $post = Post::findorfail(2);
//     $post->delete();
//     return "Deleted successfully";
// });


// Route::resource("posters",PostController::class);
Route::resource("post",PostsController::class)->names("posts");
Route::get("post/soft-delete/{id}",[PostsController::class,"softDelete"])->name("posts.softDelete");
Route::get("demo/posts",[PostsController::class,'getAllPosts'])->name("demo.getPost");

// FOR ONE TO ONE RELATIONSHIP 
Route::get("/test",function(){
    $user = User::first();
    // return $user->post->title;
    return $user->post;
});

//FOR ONE TO ONE INREVERSE AND ONE TO MANY INVERSE RELATIONSHIP
Route::get("/testing",function(){
    $post = Post::first();
    return $post->user;
});

//FOR ONE TO MANY RELATIONSHIP
Route::get("mulitplePosts",function(){
    // $post = User::first();
    $post = User::find(2);
    return $post->posts;
});

/*FOR DEFAULT RELATIONSHIP 
it is used just want to print the default value using `withDefault()`helper in User model post method.
*/


// hasOneThrough RELATIONSHIP(fetch the comment)
Route::get("hasonethr",function(){
    $user = User::first();
    return $user->comment;
});

// hasManyThrough RELATIONSHIP(fetch the comments)
Route::get("hasmanythr",function(){
    $user = User::first();
    return $user->comments;
});

// MANY TO MANY RALATIONSHIP
Route::get("manytomany",function(){
    $user = User::first();
    $role = Role::first();

    // return $user->roles()->attach($role);
    // return $user->roles()->detach($role);
    // return $user->roles()->attach(2);
    // return $user->roles()->detach(2);
    // return $role->users()->attach($user);
    // return $role->users()->detach($user);
    // return $role->users()->attach(2);
    // return $role->users()->detach(2);
    // return $role->users()->detach([2,1]); // first role link with both values [a,b].{(first,a),(first,b)}
    // return $user->roles()->attach([2,2]);   // first user link with both values [a,b].{(first,a),(first,b)}
    // return $role->users;
    return $user->roles;
    // return $user->roles()->sync([1]); //when user has 1 then sync and remove other values.
    // return $role->users()->sync([1]); //when role has 1 then sync and remove other values.
    // return 

});
Route::get('onetoonepolymorphic',function(){
    // $user = User::find(1);
    $user = User::first();
    // return $user->images;
    $post = Post::first();
    // return $post->images;
    // $image = Image::all();
    $image = Image::find(1);
    return $image->imageable;
});
Route::get('manytomanypoly',function(){
    $post = Post::first();
    return $post->tags;
    $tags = Tag::all();
    // return $tags;
});