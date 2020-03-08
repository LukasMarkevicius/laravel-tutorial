<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Post;
use Image;
use Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::all();

      return view('post.index')->withPosts($posts);
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
      $validatedData = $this->validate($request, [
        'title'         => 'required|min:3|max:255',
        'slug'          => 'required|min:3|max:255|unique:posts',
        'image'         => 'sometimes|image',
        'description'   => 'required|min:3'
      ]);

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
      return view('post.edit')->withPost($post);
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

      return redirect()->route('post.index');
    }
}
