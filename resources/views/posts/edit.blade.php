<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MSIB BLOG EDIT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>

    <div class="bg-dark py-3">
        <h3 class="text-white text-center">MSIB BLOG EDIT</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-10 d-flex justify-content-end">
                <a href="{{ route('posts.index') }}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header bg-dark">
                        <h3 class="text-white">Edit Post</h3>
                    </div>
                    <form enctype="multipart/form-data" action="{{ route('posts.update', $post->id) }}" method="post">
                        @method('put')
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="" class="form-label h5">Name</label>
                                <input value="{{ old('name', $post->name) }}" type="text" class="@error('name') is-invalid @enderror form-control-lg form-control" placeholder="Name" name="name">
                                @error('name')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Category</label>
                                <input value="{{ old('category', $post->category) }}" type="text" class="@error('category') is-invalid @enderror form-control form-control-lg" placeholder="Category" name="category">
                                @error('category')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Description</label>
                                <textarea placeholder="Description" class="form-control" name="description" cols="30" rows="5">{{ old('description', $post->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label h5">Image</label>
                                <input type="file" class="form-control form-control-lg" name="image">
                                
                                @if ($post->image != "")
                                    <img class="w-50 my-3" src="{{ asset('uploads/posts/' . $post->image) }}" alt="">
                                @endif
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>