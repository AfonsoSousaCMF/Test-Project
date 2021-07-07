{{-- Message Section --}}
@if (session('status'))
    <div class="alert alert-success alert-dismissible alert.close" role="alert">
        {{ session('status') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
@endif