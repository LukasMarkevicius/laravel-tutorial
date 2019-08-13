<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::with('children')->whereNull('parent_id')->get();

      return view('categories.index')->with([
        'categories'  => $categories
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        'name'  => 'required|min:3|max:255|string'
      ]);

      $data = $request->except('_token');

      Category::create($data);

      return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $this->validate($request, [
        'name'  => 'required|min:3|max:255|string'
      ]);

      $data = $request->except(['_token', '_method']);

      Category::find($id)->update($data);

      return redirect()->route('category.index')->withSuccess('You have successfully updated a Category!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $category = Category::find($id);

      if ($category->children) {
        foreach ($category->children as $child) {
          if ($child->posts) {
            foreach ($child->posts as $post) {
              $post->category_id = NULL;
              $post->save();
            }
          }
        }
        
        $category->children()->delete();
      }

      if ($category->posts) {
        foreach ($category->posts as $post) {
          $post->category_id = NULL;
          $post->save();
        }
      }

      $category->delete();

      return redirect()->route('category.index')->withSuccess('You have successfully deleted a Category!');
    }
}
