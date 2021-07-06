@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Message Section --}}
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @include('layouts.errors')
                   
                <div class="row">
                    <h1 class="col-md-7 ml-auto">
                        Posts
                    </h1>
                </div>

                <div class="col-md-10 mt-4 mb-3 mx-auto">
                    @if ($posts->count() > 0)
                    
                        {{-- @if (isset($details)) --}}
                
                        {{-- <h2>{{ $posts->count() }} result(s) for <b> {{ $query }} </b>: </h2>
                        <a href="{{ route('posts') }}" class="btn btn-outline-info mt-2">Return to Posts</a>
                        <br>
                        <br> --}}
                
                        @foreach ($posts as $post)
                            <div class="card mb-5">
                            
                                @if ($post->image != null)
                                    <!-- Preview Image -->
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
                    
                                    <p class="card-text text-truncate desc">
                                    {{ $post->content }}
                                    </p>
                    
                                    {{-- @auth
                                        @if (auth()->user()->isAdmin == 1)
                                            @can('update', $post)
                                            <br><br>
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-success">Edit</a>
                                                </div>
                        
                                                <div class="col-lg-11">
                                                <form method="POST" action="{{ route('posts-delete', $post->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Post ?');">Delete</button>
                                                </form>
                                                </div>
                                            </div>
                                            @endcan
                                        @endif
                                    @endauth --}}
                                </div>
                    
                                <div class="card-footer text-muted">
                                    Posted on {{ $post->created_at->format('d/m/Y') }} by
                                    <strong>{{ $post->author->name }}</strong> 
                                </div>
                            </div>
                        @endforeach
                            
                       
                        {{-- @else --}}
                        

                        {{-- @foreach ($posts as $post)
                            <div class="card mb-4">
                            
                                @if ($post->image != null)
                                    <!-- Preview Image -->
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
                    
                                    <p class="card-text text-truncate desc">
                                    {{ $post->description }}
                                    </p>
                                    
                                    {{-- @auth
                                        @if (auth()->user()->isAdmin == 1)
                                            @can('update', $post)
                                            <br>
                                            <div class="row">
                                                <div class="col-lg-1">
                                                    <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-success">Edit</a>
                                                </div>
                        
                                                <div class="col-lg-11">
                                                <form method="POST" action="{{ route('posts-delete', $post->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Post ?');">Delete</button>
                                                </form>
                                                </div>
                                            </div>
                                            @endcan
                                        @endif
                                    @endauth
                                </div>
                    
                                <div class="card-footer text-muted">
                                    Posted on {{ $post->created_at->format('d/m/Y') }} by
                                    <strong>{{ $post->author->name }}</strong> 
                                </div>
                            </div>
                        @endforeach 
                        {{-- @endif --}}
                    @else
                        <div class="card-body">
                            There are no Posts yet...
                        </div>
                    @endif    
                </div>

               @include('layouts.pagination')
            </div>
        </div>
    </div>
@endsection
