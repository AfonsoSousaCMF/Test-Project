@extends('layouts.app')

@section('content')
    {{-- Alert Handler --}}
    @include('layouts.alerts')

    {{-- Error Handler --}}
    @include('layouts.errors')

    <div class="container">
        <div class="row justify-content-center mx-auto">
            <div class="col-md-8 mx-auto">
                <div class="row">
                    <h1 class="col-md-6 mx-auto text-center">
                        Tags Management
                    </h1>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <!-- Pagination -->
                        <nav aria-label="Page navigation justify-content-center">
                            <ul class="pagination justify-content-center mx-auto">
                                <li class="page-item">
                                    {!! $tags->links("pagination::bootstrap-4") !!}
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

                {{-- Search Input --}}
                {{-- <div class="row">
                    <div class=" col-sm-4 col-md-3 col-lg-3 mx-auto">
                        <div class="input-group">
                            <form action="{{ route('tags-search') }}" method="GET">
                                <input type="text" class="form-control" name="search" placeholder="Search for..." required>
                            </form>
                        </div>
                    </div>
                </div> --}}
                
                <div class="col-md-12 mt-4 mb-3 mx-auto">
                    @if (isset($details))
                        <h2>{{ $tags->count() }} result(s) for <b> {{ $query }} </b>: </h2>
                        <a href="{{ route('tags') }}" class="btn btn-outline-info mt-2">Return to tags</a>
                        <br>
                        <br>
            
                        <table class="table table-bordered table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center table-dark" scope="col">#</th>
                                    <th class="text-center table-dark" scope="col">Tag Name</th>
                                    <th class="text-center table-dark" scope="col">Management</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td class="text-center table-secondary align-middle my-auto">
                                            {{ $tag->id }}
                                        </td>
                                        <td class="text-center table-secondary align-middle my-auto">
                                            {{ $tag->name }}
                                        </td>
                                        @auth
                                            @if (auth()->user()->isAdmin == 1)
                                                @if ($tag->deleted_at == null)
                                                    <td class="text-center table-secondary align-middle my-auto column-small">
                                                        <form method="POST" action="{{ route('tags-delete', $tag->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Tag ?');">
                                                                <img src="{{ asset('icons/trash_bin_icon.png') }}" alt="trash_bin_icon" width="20" height="20">
                                                            </button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td class="text-center table-secondary align-middle my-auto column-small">
                                                        <form method="POST" action="{{ route('tags-restore', $tag->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning button is-link" onclick="return confirm('Are you sure you want to restore the Tag ?');">Restore</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            @endif
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <table class="table table-bordered table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th class="text-center table-dark" scope="col">#</th>
                                    <th class="text-center table-dark" scope="col">Tag Name</th>
                                    <th class="text-center table-dark" scope="col">Management</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td class="text-center table-secondary align-middle my-auto">
                                            {{ $tag->id }}
                                        </td>
                                        <td class="text-center table-secondary align-middle my-auto">
                                            {{ $tag->name }}
                                        </td>
                                        @auth
                                            @if (auth()->user()->isAdmin == 1)
                                                @if ($tag->deleted_at == null)
                                                    <td class="text-center table-secondary align-middle my-auto column-small">
                                                        <form method="POST" action="{{ route('tags-delete', $tag->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger button is-link" onclick="return confirm('Are you sure you want to delete the Tag ?');">
                                                                <img src="{{ asset('icons/trash_bin_icon.png') }}" alt="trash_bin_icon" width="20" height="20">
                                                            </button>
                                                        </form>
                                                    </td>
                                                @else
                                                    <td class="text-center table-secondary align-middle my-auto column-small">
                                                        <form method="POST" action="{{ route('tags-restore', $tag->id) }}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-warning button is-link" onclick="return confirm('Are you sure you want to restore the Tag ?');">Restore</button>
                                                        </form>
                                                    </td>
                                                @endif
                                            @endif
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation justify-content-center">
                    <ul class="pagination justify-content-center mx-auto">
                        <li class="page-item">
                            {!! $tags->links("pagination::bootstrap-4") !!}
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
