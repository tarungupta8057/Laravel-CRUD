<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Post::withTrashed()->paginate(10);
        return view("post.index",['posts'=>$post]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // Post::create($request->all());           //first method to store data
        // dd("Data is saved");

        //second method to store data
        Post::create([
            'title'=>$request->title,
            'user_id'=>1,
            'description'=>$request->description,
            'is_published'=>$request->is_published,
            'isActive'=>$request->isActive
        ]);
        // dd("data is saved");
        // Session::flush();
        Session::flash('alert-success','Post creted successfully.');
        // return redirect('/post');
        // return redirect()->route('posts.create');
        return to_route('posts.index');
        // return redirect()->back();
        // return view("post.create");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            abort(403);
        }
        return view("post.show",['posts'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            return abort(403);
        }
        return view('post.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            abort(403);
        }
        else
        {
            $post->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'is_published'=>$request->is_published,
                'isActive'=>$request->isActive
            ]);
            Session::flash('alert-info','Post updated successfully');
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!$post)
        {
            abort(403);
        }
        else
        {
            $post->delete();
            Session::flash('alert-danger','Post deleted successfully');
        }
        return to_route("posts.index");
    }
    public function softDelete($id)
    {
        $post = Post::onlyTrashed()->find($id);
        if(!$post)
        {
            abort(403);
        }
        else
        {
            $post->update([
                'deleted_at'=> Null
            ]);
            Session::flash("undo","Post is recreated");
        }
        return to_route("posts.index");
    }
    public function getAllPosts()
    {
        $post = DB::table("posts")->get();
        return $post;
    }
}
