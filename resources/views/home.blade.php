@extends('layouts.app')

@section('content')
    {{-- Modal Create Post --}}
    @include('posts.create')

    {{-- Alert Handler --}}
    @include('layouts.alerts')

    {{-- Error Handler --}}
    @include('layouts.errors')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ __('Dashboard') }}</h3>
                            </div>
                            
                            <div class="col-md-4 mr-0">
                                <a href="" class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#CreateModal">
                                    Create Post
                                </a>    
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                {{-- Pagination Layout --}}
                                @include('layouts.pagination')
                            </div>
                        </div>

                        <div class="row">
                            <!-- Blog Entries Column -->
                            <div class="col-md-10 justify-content-center mx-auto">
                                @if ($posts != null)
                                    @foreach ($posts as $post)
                                        <div class="card mb-5">
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

                                                <div class="post-tags my-3">
                                                    <strong class="mr-2">Tags : </strong>
                                                    @foreach($post->tags as $tag)
                                                        <a href="#" class="badge badge-pill badge-info mr-1">{{$tag->name}}</a>
                                                    @endforeach
                                                </div>
                                                                
                                                @auth
                                                    @can('update', $post)
                                                        <div class="row">
                                                            <div class="col-lg-2 mr-1">
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
                                                @endauth
                                            </div>
                        
                                            <div class="card-footer text-muted">
                                                Posted on {{ $post->created_at->format('D d/M/Y') }} by
                                                <strong>{{ $post->author->name }}</strong> 
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-8">
                                        <h2> You currently have no Posts! </h2>
                                    </div>
                                @endif
                        
                                {{-- Pagination Layout --}}
                                @include('layouts.pagination')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
