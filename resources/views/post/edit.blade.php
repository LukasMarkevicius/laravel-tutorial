<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('post.index') }}">{{ config('app.name') }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('post.index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <a href="{{ route('post.create') }}" class="btn btn-success my-2 my-sm-0">Create Post</a>
            </div>
        </nav>
        <div class="container py-3">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <h1>Edit Post</h1>
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
    </body>

</html>
