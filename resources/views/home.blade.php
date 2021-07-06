@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            {{ __('Dashboard') }} 
                        </div>
                        
                        <div class="col-md-4 mr-0">
                            <a href="{{ route('posts-create') }}" class="btn btn-outline-primary" type="button">
                                Create Post
                            </a>    
                        </div>
                    </div>
                </div>

                {{-- Message Section --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <!-- Blog Entries Column -->
                        <div class="col-md-8 justify-content-center mx-auto">
                          @if ($posts != null)
                            @foreach ($posts as $post)
                              <div class="card mb-4">
                                
                                @if ($post->image != null)
                                  <!-- Post Image -->
                                  <a href="{{ route('posts-show', $post->id) }}" >
                                    <img class="card-img-top" src="{{ $post->image }}" alt="">
                                  </a>
                                @else
                                  <!-- Preview Image -->
                                  <a href="{{ route('posts-show', $post->id) }}" >
                                    <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                                  </a>
                                @endif
                                
                                <div class="card-body">
                                  <h2 class="card-title">
                                    {{ $post->title }}
                                  </h2>
                  
                                  <p class="card-text">
                                    {{ $post->content }}
                                  </p>
                                                    
                                  {{-- @auth
                                    @can('update', $post) --}}
                                      <div class="row">
                                        <div class="col-lg-2">
                                            <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-success">Edit</a>
                                        </div>
                  
                                        <div class="col-lg-10">
                                          <form method="POST" action="{{ route('posts-delete', $post->id) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Post ?');">Delete</button>
                                          </form>
                                        </div>
                                      </div>
                                    {{-- @endcan
                                  @endauth --}}
                                </div>
                  
                                <div class="card-footer text-muted">
                                  Posted on {{ $post->created_at->format('d/m/Y') }} by
                                  <strong>{{ $post->author->name }}</strong> 
                                </div>
                              </div>
                            @endforeach
                          @else
                            <div class="col-lg-8">
                              <h2> You currently have no Posts! </h2>
                            </div>
                          @endif
                  
                          @include('layouts.pagination')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
