<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
         $this->middleware('auth')->except(['index', 'show']);
     }

    public function index()
    {
      $posts = Post::all();

      return view('index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:posts',
        'description'   => 'required|min:3'
      ]);

      $post = new Post;

      $post->title = $request->title;
      $post->slug = str_slug($request->slug);
      $post->description = $request->description;

      $post->save();

      return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $post = Post::where('slug', $slug)->first();

      return view('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
      $post = Post::where('slug', $slug)->first();

      return view('post.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
      $this->validate($request, [
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:posts,id,' . $slug,
        'description'   => 'required|min:3'
      ]);

      $post = Post::where('slug', $slug)->first();

      $post->title = $request->title;
      $post->slug = str_slug($request->slug);
      $post->description = $request->description;

      $post->save();

      return redirect()->route('post.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
      $post = Post::where('slug', $slug)->first();

      $post->delete();

      return redirect()->route('index');
    }
}
