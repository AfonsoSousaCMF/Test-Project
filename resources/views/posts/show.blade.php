@extends('layouts.app')

@section('content')
  <!-- Page Content -->
  <div class="container mb-5 mt-3">

    <div class="row">
        <h1 class="mb-3 mx-auto">
            {{ $post->title }}
        </h1>
    </div>

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-12">

        @if ($post->image != null)
          <!-- Post Image -->
          <img class="img-fluid rounded" src="{{ $post->image }}">
        @else
          <!-- Preview Image -->
          <img class="img-fluid rounded" src="http://placehold.it/1200x500">
        @endif
       
        <hr>

        <!-- Date/Time -->
        <p>
          Posted on {{ $post->created_at->format('d/m/Y') }} by  
          <strong>{{ $post->author->name }} </strong>
        </p>

        <hr>

        <!-- Post Content -->
        <blockquote class="blockquote">
          <p class="lead">
            {{ $post->content }}
          </p>
        </blockquote>

        <hr>

        <div class="post-tags my-3">
          <strong class="mr-2">Tags : </strong>
          @foreach($post->tags as $tag)
            <a href="#" class="badge badge-pill badge-info mr-1">{{$tag->name}}</a>
          @endforeach
        </div>
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection