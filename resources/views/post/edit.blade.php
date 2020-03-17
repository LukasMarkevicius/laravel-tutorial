@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit Post</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('post.update', $post->slug) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                            </div>

                            <div class="form-group">
                                <label for="slug">Slug</label>
                                <input type="text" name="slug" class="form-control" value="{{ $post->slug }}"
                                    placeholder="post-slug">
                            </div>

                            <div class="form-group">
                                <label for="image">Post Image</label>
                                @if ($post->image)
                                    <ul>
                                        <li>{{ $post->image }}</li>
                                    </ul>
                                @endif
                                <input type="file" class="form-control-file" name="image">
                            </div>

                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" name="category_id" required>
                                    <option value="">Select a Category</option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id === $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @if ($category->children)
                                            @foreach ($category->children as $child)
                                                <option value="{{ $child->id }}" {{ $child->id === $post->category_id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                                            @endforeach
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" rows="8" cols="80"
                                    class="form-control">{{ $post->description }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
