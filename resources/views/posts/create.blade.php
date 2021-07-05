@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Posts') }}</div>

                    @include('layouts.errors')

                    <div class="row">
                        <!-- Posts Form -->
                        <div class="col-md-12">
                            <form action="{{ route('posts-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputTitle">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="inputVideo">Video Link</label>
                                        <input type="text" class="form-control" name="video" placeholder="The link must be embeded from Youtube...">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDescription">Description</label>
                                    <textarea name="description" class="form-control" cols="5" rows="10" id="textarea" required></textarea>
                                </div>

                                <div class="form-group">
                                        <label for="inputImage">Image</label>
                                        <div class="custom-file">
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                </div>
                                
                                <a href="{{ route('posts') }}" class="btn btn-primary mt-3">Back to Posts</a>
                                <button type="reset" class="btn btn-danger mt-3" onclick="return confirm('Are you sure you want to erase everything?');">Clear</button>
                                <button type="submit" class="btn btn-success mt-3" onclick="return confirm('Are you sure you want to submit the Post?');">Submit Post</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection