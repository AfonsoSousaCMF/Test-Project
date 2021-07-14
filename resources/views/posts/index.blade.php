@extends('layouts.app')

@section('content')
    {{-- Alert Handler --}}
    @include('layouts.alerts')

    {{-- Error Handler --}}
    @include('layouts.errors')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <h1 class="col-md-7 ml-auto">
                        Posts
                    </h1>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        {{-- Pagination Layout --}}
                        @include('layouts.pagination')
                    </div>
                </div>

                {{-- Search Input --}}
                <div class="row">
                    <div class=" col-sm-4 col-md-3 col-lg-3 mx-auto">
                        <div class="input-group">
                            <form action="{{ route('posts-search') }}" method="GET">
                                <input type="text" class="form-control" name="search" placeholder="Search for..." required>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-10 mt-4 mb-3 mx-auto">
                    @if (isset($details))
                        <h2>{{ $posts->count() }} result(s) for <b> {{ $query }} </b>: </h2>
                        <a href="{{ route('posts') }}" class="btn btn-outline-info mt-2">Return to Posts</a>
                        <br>
                        <br>
            
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

                                    <div class="post-tags mt-3">
                                        <strong class="mr-2">Tags : </strong>
                                        @foreach($post->tags as $tag)
                                          <a href="#" class="badge badge-pill badge-info mr-1">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                    
                                    @auth
                                        @if (auth()->user()->isAdmin == 1)
                                            @can('update', $post)
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-success">Edit</a>
                                                    </div>
                            
                                                    <div class="col-lg-8">
                                                        <form method="POST" action="{{ route('posts-delete', $post->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Post ?');">
                                                                <img src="{{ asset('icons/trash_bin_icon.png') }}" alt="trash_bin_icon" width="20" height="20">
                                                            </button>
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
                    @else
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

                                    <div class="post-tags mt-3">
                                        <strong class="mr-2">Tags : </strong>
                                        @foreach($post->tags as $tag)
                                            <a href="#" class="badge badge-pill badge-info mr-1">{{$tag->name}}</a>
                                        @endforeach
                                    </div>
                    
                                    @auth
                                        @if (auth()->user()->isAdmin == 1)
                                            @can('update', $post)
                                                <br><br>
                                                <div class="row">
                                                    <div class="col-lg-2">
                                                        <a href="{{ route('posts-edit', $post->id) }}" class="btn btn-success">Edit</a>
                                                    </div>
                            
                                                    <div class="col-lg-8">
                                                        <form method="POST" action="{{ route('posts-delete', $post->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Post ?');">
                                                                <img src="{{ asset('icons/trash_bin_icon.png') }}" alt="trash_bin_icon" width="20" height="20">
                                                            </button>
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
                    @endif
                </div>
                
                {{-- Pagination Layout --}}
                @include('layouts.pagination')
            </div>
        </div>
    </div>
@endsection
