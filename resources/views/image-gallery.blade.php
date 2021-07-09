@extends('layouts.app')

@section('content')
    {{-- Alert Handler --}}
    @include('layouts.alerts')

    {{-- Error Handler --}}
    @include('layouts.errors')

    <div class="container my-3">

        <h3 class="mb-3">Laravel - Image Gallery CRUD Example</h3>
        <form action="{{ route('gallery-upload') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-5">
                    <strong>Title:</strong>
                    <input type="text" name="title" class="form-control" placeholder="Title">
                </div>
                <div class="col-md-5">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-2">
                    <br/>
                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to upload the Image?');">Upload</button>
                </div>
            </div>
        </form> 
    
        <div class="row">
            <!-- Carousel wrapper -->
            <div id="carouselExampleControls" class="carousel slide carousel-fade mt-3 col-md-12" data-keyboard="true" data-ride="carousel">
                <!-- Inner -->
                <div class="carousel-inner">
                    @if($images->count())
                        <!-- Single item -->
                        <div class="carousel-item active">
                            <img
                                src="/images/{{ $firstImage->image }}"
                                class="d-block w-100"
                                alt="..."
                            />
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $firstImage->title }}</h5>
                            </div>
                            {{-- <form action="{{ route('gallery-delete',$firstImage->id) }}" method="POST">
                                <input type="hidden" name="_method" value="delete">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="close-icon btn btn-danger mx-auto" onclick="return confirm('Are you sure you want to delete the Image?');">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </form> --}}
                        </div>
                        
                        @foreach($images as $image)
                            <!-- Single item -->
                            <div class="carousel-item">
                                <img
                                    src="/images/{{ $image->image }}"
                                    class="d-block w-100"
                                    alt="..."
                                />
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>{{ $image->title }}</h5>
                                    <form action="{{ route('gallery-delete',$image->id) }}" method="POST">
                                        <input type="hidden" name="_method" value="delete">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="close-icon btn btn-danger mx-auto" onclick="return confirm('Are you sure you want to delete the Image?');">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </form>
                                </div>
                               
                            </div>
                        @endforeach
                        <!-- Controls -->
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    @endif    
                </div> <!-- Inner -->
            </div> <!-- Carousel wrapper -->
        </div> <!-- row / end -->
    </div> <!-- container / end -->
@endsection
