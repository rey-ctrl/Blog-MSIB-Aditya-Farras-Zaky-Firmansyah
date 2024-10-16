<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Create Posts</title>
  </head>
  <body>

    <div class="bg-dark py-3">
      <h1 class="text-white text-center">BLOG MSIB CREATE</h1>
    </div>
    
    <div class="container">
      <div class="row justify-content-end mt-4">
        <div class="col-md d-flex justify-content-end">
            <a href="{{ route('posts.index') }}" class="btn btn-dark">Back</a>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-md-10">
          <div class="card border-0 shadow-lg d-flex my-4">

            <div class="card-header text-white bg-dark">
              <h3>Create Post</h3>
            </div>

            <form enctype="multipart/form-data" action="{{ route('posts.store') }}" method="post">
              @csrf
              <div class="card-body">
                <!-- Name Field -->
                <div class="mb-3">
                  <label for="name" class="form-label h5">Name</label>
                  <input id="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control form-control-lg" 
                  placeholder="Name" name="name">
                  @error('name')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Category Field -->
                <div class="mb-3">
                  <label for="category" class="form-label h5">Category</label>
                  <input id="category" value="{{ old('category') }}" type="text" class="@error('category') is-invalid @enderror form-control form-control-lg" 
                  placeholder="Category" name="category"> 
                  @error('category')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Description Field -->
                <div class="mb-3">
                  <label for="description" class="form-label h5">Description</label>
                  <textarea id="description" placeholder="Description" class="form-control" name="description" cols="30" rows="5">{{ old('description') }}</textarea>
                  @error('description')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                  <label for="image" class="form-label h5">Image</label>
                  <input id="image" type="file" class="form-control form-control-lg" placeholder="Image" name="image">
                  @error('image')
                      <p class="invalid-feedback">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid">
                  <button class="btn btn-lg btn-primary">Submit</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
