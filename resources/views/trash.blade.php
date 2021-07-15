@extends('layouts.app')

@section('content')
    {{-- Alert Handler --}}
    @include('layouts.alerts')

    {{-- Error Handler --}}
    @include('layouts.errors')

    <div class="container">
        <div class="row justify-content-center mx-auto">
            <div class="col-md-12 mx-auto">
                <div class="row">
                    <h1 class="col-md-6 mx-auto text-center">
                        {{ __('Trash Bin') }}
                    </h1>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        {{-- Pagination Layout --}}
                        @include('layouts.pagination')
                    </div>
                </div>

                <div class="col-md-12 justify-content-center mx-auto">
                    @if ($posts->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center table-dark" scope="col">#</th>
                                    <th class="text-center table-dark" scope="col">Title</th>
                                    <th class="text-center table-dark" scope="col">Author</th>
                                    <th class="text-center table-dark" scope="col">Deletion Date</th>
                                    <th class="text-center table-dark" scope="col">Management</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="text-center table-secondary align-middle">
                                            {{ $post->id }}
                                        </td>
                                        <td class="text-center table-secondary align-middle">
                                            {{ $post->title }}
                                        </td>
                                        <td class="text-center table-secondary align-middle">
                                            {{ $post->author->name }}
                                        </td>
                                        <td class="text-center table-secondary align-middle">
                                            {{ $post->deleted_at->format('d/m/Y') }}
                                        </td>
                                        @auth
                                            @can('update', $post)
                                                <td class="text-center table-secondary align-middle">
                                                    <form method="POST" action="{{ route('posts-restore', $post->id) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning button is-link" onclick="return confirm('Are you sure you want to Restore the Post ?');">Restore</button>
                                                    </form>
                                                </td>
                                            @endcan
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center table-dark" scope="col">#</th>
                                    <th class="text-center table-dark" scope="col">Title</th>
                                    <th class="text-center table-dark" scope="col">Author</th>
                                    <th class="text-center table-dark" scope="col">Deletion Date</th>
                                    <th class="text-center table-dark" scope="col">Management</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5" class="text-center table-secondary align-middle">
                                        <h3>
                                            You currently have no trashed Posts, Poggers!!!
                                        </h3>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @endif
            
                    {{-- Pagination Layout --}}
                    @include('layouts.pagination')
                </div> <!-- /.col -->
            </div> <!-- /.col -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
@endsection
