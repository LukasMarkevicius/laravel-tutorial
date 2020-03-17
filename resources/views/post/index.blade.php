@extends('layouts.app')

@section('content')
    <div class="container py-3">
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{ $post->title }}</h3>
                            <p class="text-muted">{{ $post->category ? $post->category->name : 'Uncategorized' }}</p>
                        </div>
                        <div class="card-body">
                            <p>{{ substr($post->description, 0, 100) }}</p>
                            <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary btn-block">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
