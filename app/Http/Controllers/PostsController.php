<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use DB; //Adding Database library for mysql approach query

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Using Eloquent (Object Relational Mapper)
        // return Post::all(); //Just For Display

        // $posts = Post::all(); // Fetch all data
        // $posts = Post::orderBy('title', 'asc')->get(); // Fetch all data in ascending order
        // $posts = Post::where('title', 'Post Two')->get(); // anoher way of fetching data via WHERE clause
        // $posts = DB::select('select * from posts'); // Using MySql Query
        // $posts = Post::orderBy('title', 'desc')->take(1)->get(); // Fetch data with limit
        $posts = Post::orderBy('created_at', 'desc')->paginate(10); // Fetch data and create pagination

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
        ]);

        // Create Post
        $post = new Post;
        $post->title = $request->input('title'); //Gets data from title field
        $post->body = $request->input('body'); //Gets data from body field
        $post->save();
        
        // Redirect
        return redirect(url('/posts'))->with('success', 'Post Created');
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
        return view('posts.show')->with('post', $post);
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
        return view('posts.edit')->with('post', $post);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation
        $this->validate($request, [
            'title'=>'required',
            'body'=>'required'
        ]);

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title'); //Gets data from title field
        $post->body = $request->input('body'); //Gets data from body field
        $post->save();
        
        // Redirect
        return redirect(url('/posts').'/'.$post->id)->with('success', 'Post Update ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::Find($id);
        $post->delete();
        return redirect(url('/posts'))->with('success', 'Post Deleted ');
    }
}
