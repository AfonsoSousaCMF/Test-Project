@extends('layouts.app')

@section('content')

   @include('layouts.errors')
   
   <!-- Page Content -->
  <div class="container mb-5">

   <!-- Page Heading -->
   <h1 class="mt-4 mb-3">
      Update Post
   </h1>

   <div class="row">
      <!-- Post Form -->
      <div class="col-md-12">
         <form action="{{ route('posts-update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="inputTitle">Title</label>
                <input type="text" value="{{ $post->title }}" class="form-control" name="title" required>
              </div>
            </div>

            <div class="form-group">
               <label for="inputContent">Content</label>
               <textarea name="content" class="form-control" cols="5" rows="10" id="textarea" required>{{ $post->content }}</textarea>
            </div>

            <div class="form-group">
               <label for="inputImage">Image</label>
               <div class="custom-file">
                  <input type="file" name="image">
               </div>
            </div>

            @if ($post->image != null)
               <!-- Post Image -->
               <img class="img-fluid rounded" src="{{ $post->image }}" width="300" height="auto">
               <br>
            @else
               <!-- Preview Image -->
               <img class="img-fluid rounded" src="http://placehold.it/750x300" width="300"  alt="Card image cap">
               <br>
            @endif
            
            <a href="{{ route('home') }}" class="btn btn-primary mt-3">Back to your Posts</a>
            <button type="submit" class="btn btn-success mt-3" onclick="return confirm('Are you sure you want to update the Post?');">Update Post</button>
         </form>
      </div>
   </div> <!-- /.row -->
  </div> <!-- /.container -->
@endsection