{{-- Error Handler --}}
@include('layouts.errors')

<!-- Modal -->
<div class="modal fade" role="dialog" id="myModal">
    <!-- Modal Dialog-->
    <div class="modal-dialog">
        <!-- Modal Content-->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h1 class="modal-title">
                    Create Post
                </h1>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="row justify-content-center">
                    <!-- Posts Form -->
                    <div class="col-md-12">
                        <form action="{{ route('posts-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputTitle">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputContent">Content</label>
                                <textarea name="content" class="form-control" cols="5" rows="10" id="textarea" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="inputImage">Image</label>
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="reset" class="btn btn-danger" onclick="return confirm('Are you sure you want to erase everything?');">Clear</button>
                                <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to submit the Post?');">Submit Post</button>
                            </div> <!-- Modal Footer -->
                        </form>
                    </div> <!-- End Posts Form -->
                </div> <!-- /.row -->
            </div>

            

        </div> <!-- End Modal Content-->
    </div> <!-- End Modal Dialog-->
</div> <!-- End Modal -->

