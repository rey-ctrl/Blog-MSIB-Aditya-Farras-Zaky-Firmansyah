<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Laravel 11 CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="bg-dark py-3">
        <h3 class="text-white text-center">Simple Laravel 11 CRUD</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('posts.create') }}" class="btn btn-dark">Create</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            @if (Session::has('success'))
            <div class="col-md-10 mt-4">
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>    
            @endif            
            <div class="col-md-10">
                <div class="card borde-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Posts</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>ID</th>
                                <th></th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            @if ($posts->isNotEmpty())
                            @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    @if ($post->image != "")
                                        <img width="50" src="{{ asset('upload/posts/'.$post->image) }}" alt="">
                                    @endif
                                </td>
                                <td>{{ $post->name }}</td>
                                <td>{{ $post->category }}</td>
                                <td>{{ \Carbon\Carbon::parse($post->created_at)->format('d M, Y') }}</td>
                                <td>
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-dark">Edit</a>
                                    <a href="#" onclick="deletePost({{ $post->id }});" class="btn btn-danger">Delete</a>
                                    <form id="delete-post-form-{{ $post->id }}" action="{{ route('posts.destroy',$post->id) }}" method="post" style="display: none;">
                                        @csrf
                                        @method('delete')
                                    </form>
                                </td>
                            </tr>   
                            @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  </body>
</html>

<script>
    function deletePost(id) {
        if (confirm("Are you sure you want to delete this post?")) {
            document.getElementById("delete-post-form-" + id).submit();
        }
    }
</script>
