@extends('layouts.app')

@section('content')
  <!-- Page Content -->
  <div class="container mb-5 mt-3">

    <div class="row">
        <h1 class="mb-3 mx-auto">
            {{ $post->title }}
        </h1>
    </div>
    
    {{-- Message Section --}}
    @if (session('status'))
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
    @endif

    @include('layouts.errors')

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
      </div>
    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->
@endsection