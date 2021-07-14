@extends('layouts.app')

@section('content')
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
                                {{ __('Trash Bin') }} 
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
                                            <div class="card-body">
                                                @auth
                                                    @can('update', $post)
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <h2 class="card-title">
                                                                    {{ $post->title }}
                                                                </h2>
                                                            </div>

                                                            <div class="col-md-4 mx-auto">
                                                                <form method="POST" action="{{ route('posts-restore', $post->id) }}">
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-warning button is-link" onclick="return confirm('Are you sure you want to Restore the Post ?');">Restore</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endcan
                                                @endauth
                                            </div>
                        
                                            <div class="card-footer text-muted">
                                                Posted on {{ $post->created_at->format('d/m/Y') }} by
                                                <strong>{{ $post->author->name }}</strong> 
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-lg-8">
                                        <h2> You currently have no trashed Posts! </h2>
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
