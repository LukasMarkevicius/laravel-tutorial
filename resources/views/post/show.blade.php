<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Authentication Tutorial</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    </head>
    <body>

          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Laravel Authentication Tutorial</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>
              {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> --}}
                <a href="{{ route('post.create') }}" class="btn btn-success my-2 my-sm-0">Create Post</a>
              {{-- </form> --}}
            </div>
          </nav>
          <div class="container py-3">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <div class="card">
                <div class="card-header">
                  <h1>{{ $post->title }}</h1>
                </div>

                <div class="card-body">
                  <p>{{ $post->description }}</p>

                  <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-primary">Edit Post</a>
                  <form action="{{ route('post.destroy', $post->slug) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger mt-3">Delete</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
