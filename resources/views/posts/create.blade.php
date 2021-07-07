@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Page Heading -->
                <h1 class="mt-4 mb-3">
                    Create Post
                </h1>

                @include('layouts.errors')

                <div class="row">
                    <!-- Posts Form -->
                    <div class="col-md-12">
                        <form action="{{ route('posts-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputTitle">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContent">Content</label>
                                <textarea name="content" class="form-control" cols="5" rows="10" id="textarea" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputImage">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            
                            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to your Posts</a>
                            <button type="reset" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to erase everything?');">Clear</button>
                            <button type="submit" class="btn btn-success mt-3" onclick="return confirm('Are you sure you want to submit the Post?');">Submit Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection