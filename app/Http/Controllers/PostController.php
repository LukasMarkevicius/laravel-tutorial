<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use Image;
use Storage;
use Session;
use Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::with('category')->get();

      return view('post.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $categories = Category::with('children')->whereNull('parent_id')->get();

      return view('post.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $this->validate($request, [
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:posts',
        'image'         => 'sometimes|image',
        'category_id'   => 'required|numeric',
        'description'   => 'required|min:3'
      ]);

      $validatedData['user_id'] = Auth::id();
      $validatedData['slug'] = Str::slug($validatedData['slug'], '-');

      $post = Post::create($validatedData);

      if ($request->hasfile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = storage_path('app/public/images/') . $filename;

        Image::make($image)->save($location);

        $post->image = $filename;
        $post->save();
      }

      Session::flash('success', 'You have successfully created a post!');
      
      return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('post.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
      if ($post->user_id != Auth::id()) {
        return redirect()->back();
      }

      $categories = Category::with('children')->whereNull('parent_id')->get();

      return view('post.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
      $validatedData = $this->validate($request, [
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:posts,id,' . $post->slug,
        'image'         => 'sometimes|image',
        'category_id'   => 'required|numeric',
        'description'   => 'required|min:3'
      ]);

      $validatedData['slug'] = Str::slug($validatedData['slug'], '-');

      $post->update($validatedData);

      if ($request->hasfile('image')) {
        Storage::disk('public')->delete("images/$post->image");

        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $location = storage_path('app/public/images/') . $filename;

        Image::make($image)->save($location);

        $post->image = $filename;
        $post->save();
      }

      Session::flash('success', 'You have successfully updated a post!');

      return redirect()->route('post.show', $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
      Storage::disk('public')->delete("images/$post->image");
      $post->delete();

      Session::flash('success', 'You have successfully deleted a post!');

      return redirect()->route('post.index');
    }
}
