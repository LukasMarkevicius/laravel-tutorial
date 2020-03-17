@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>{{ $post->title }}</h1>
                        <p class="text-muted">{{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
                    </div>

                    <div class="card-body">
                        @if ($post->image)
                            <img src="{{ asset('storage/images/' . $post->image) }}" alt="{{ $post->title }} photo" class="img-fluid">
                        @endif

                        <p>{{ $post->description }}</p>

                        @if (Auth::id() === $post->user_id)
                            <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-primary">Edit Post</a>
                            <form action="{{ route('post.destroy', $post->slug) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mt-3">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
