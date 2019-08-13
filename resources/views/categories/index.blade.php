<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Tutorial</title>


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer></script>


    </head>
    <body>

          <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{ route('index') }}">Laravel Tutorial</a>
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
          <div class="container py-3">

            <div class="modal" tabindex="-1" role="dialog" id="editCategoryModal">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>

                  <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                      <div class="form-group">
                        <input type="text" name="name" class="form-control" value="" placeholder="Category Name" required>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                  </div>
                  </form>
              </div>
            </div>

          <div class="row">
            <div class="col-md-8">

              <div class="card">
                <div class="card-header">
                  <h3>Categories</h3>
                </div>
                <div class="card-body">
                  <ul class="list-group">
                    @foreach ($categories as $category)
                      <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                          {{ $category->name }}

                          <div class="button-group d-flex">
                            <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $category->id }}" data-name="{{ $category->name }}">Edit</button>

                            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
                              @csrf
                              @method('DELETE')

                              <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>

                        @if ($category->children)
                          <ul class="list-group mt-2">
                            @foreach ($category->children as $child)
                              <li class="list-group-item">
                                <div class="d-flex justify-content-between">
                                  {{ $child->name }}

                                  <div class="button-group d-flex">
                                    <button type="button" class="btn btn-sm btn-primary mr-1 edit-category" data-toggle="modal" data-target="#editCategoryModal" data-id="{{ $child->id }}" data-name="{{ $child->name }}">Edit</button>

                                    <form action="{{ route('category.destroy', $child->id) }}" method="POST">
                                      @csrf
                                      @method('DELETE')

                                      <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                  </div>
                                </div>
                              </li>
                            @endforeach
                          </ul>
                        @endif
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3>Create Category</h3>
                </div>

                <div class="card-body">
                  <form action="{{ route('category.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                      <select class="form-control" name="parent_id">
                        <option value="">Select Parent Category</option>

                        @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                      </select>
                    </div>

                    <div class="form-group">
                      <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Category Name" required>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>

        <script type="text/javascript">
          $('.edit-category').on('click', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var url = "{{ url('category') }}/" + id;

            $('#editCategoryModal form').attr('action', url);
            $('#editCategoryModal form input[name="name"]').val(name);
          });
        </script>
    </body>


</html>
