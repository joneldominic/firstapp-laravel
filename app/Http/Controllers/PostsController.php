<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Include Storage Library

use App\Post;
use DB; //Adding Database library for mysql approach query

class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     * Prevent Guest from Performing Actions in Posts
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]); //Exception added...
    }

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
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);
        
        // Handle File Upload
        if($request->hasFile('cover_image')) {
            // Get filename with extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); // Issue may occure if this filename will be used directly

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Create Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); //Store in the path(storage/app/public/cover_image)

        } else {    
            $fileNameToStore = 'noimage.jpg';
        }

        // Create Post
        $post = new Post;
        $post->title = $request->input('title'); //Gets data from title field
        $post->body = $request->input('body'); //Gets data from body field
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
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

        // Check for Correct User
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized  Page');  
        }

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
            'body'=>'required',
            'cover_image'=>'image|nullable|max:1999'
        ]);

        // Handle File Upload
        if($request->hasFile('cover_image')) {
            // Get filename with extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName(); // Issue may occure if this filename will be used directly

            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            // Get just extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            // Create Filename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore); //Store in the path(storage/app/public/cover_image)
        
        }

        // Update Post
        $post = Post::find($id);
        $post->title = $request->input('title'); //Gets data from title field
        $post->body = $request->input('body'); //Gets data from body field
        if($request->hasFile('cover_image')) {

            // Delete Old Image
            // Requires Storage Library
            Storage::delete('public/cover_images/'.$post->cover_image);
            
            $post->cover_image = $fileNameToStore;
        }
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

        // Check for Correct User
        if(auth()->user()->id !== $post->user_id) {
            return redirect('/posts')->with('error', 'Unauthorized  Page');  
        }

        if($post->cover_image != 'noimage.jpg'){
            // Requires Storage Library
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();
        return redirect(url('/posts'))->with('success', 'Post Deleted '); 
    }
}
