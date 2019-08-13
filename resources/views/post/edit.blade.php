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
        <script src="{{ asset('js/app.js') }}" defer></script>


    </head>
    <body>

          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('index') }}">Laravel Authentication Tutorial</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                  <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>
              {{-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> --}}
                <a href="{{ route('post.create') }}" class="btn btn-success my-2 my-sm-0">Create Post</a>
              {{-- </form> --}}
            </div>
          </nav>

          @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <h4 class="alert-heading">Success!</h4>
              <p>{{ Session::get('success') }}</p>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

          @if (Session::has('errors'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <h4 class="alert-heading">Error!</h4>

              <p>
                <ul>
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </p>

              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif

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

                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="title" class="form-control" value="{{ $post->title }}">
                    </div>

                    <div class="form-group">
                      <label for="slug">Slug</label>
                      <input type="text" name="slug" class="form-control" value="{{ $post->slug }}">
                    </div>

                    <div class="form-group">
                      <label for="category_id">Category</label>
                      <select class="form-control" name="category_id" required>
                        <option value="">Select a Category</option>

                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>{{ $category->name }}</option>

                          @if ($category->children)
                            @foreach ($category->children as $child)
                              <option value="{{ $child->id }}" {{ $child->id == $post->category_id ? 'selected' : '' }}>&nbsp;&nbsp;{{ $child->name }}</option>
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="image">Post Image</label>
                      <ul>
                        <li>{{ $post->image }}</li>
                      </ul>
                      <input type="file" class="form-control-file" name="image">
                    </div>

                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" rows="8" cols="80" class="form-control">{{ $post->description }}</textarea>
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
