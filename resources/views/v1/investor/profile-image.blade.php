@extends('layouts.investor')

@section('title', 'Update Profile Image')

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-6 col-md-7 col-sm-9">
            <div class="card card-body border-0 text-center">
                <img src="{{ auth()->user()->profileable->profile_img ? asset('profile-image/' . auth()->user()->profileable_type . '/' . auth()->user()->profileable->profile_img) : asset('/images/avatar/avatar.jpeg') }}" id="previewImg" alt="{{ auth()->user()->profileable->firstrname }} profile image" class="d-block mx-auto mb-4" width="300">
                <h5 class="fw-bold">Select an image to update</h5>
                
                <form action="{{ route('investor.update.image') }}" enctype="multipart/form-data" method="post">
                    @csrf

                    <label for="" class="mb-1">Update profile picture</label>
                    <div class="form-group mb-4">
                        <input type="file" name="image" id="profile_image" class="form-control @error('image') is-invalid @enderror" onchange="previewFile(this, 'previewImg')">
                        @error('image')
                            <p class="text-danger">{{ $message }}</p>   
                        @enderror
                    </div>
                    <button class="btn btn-success"><i class="fa fa-upload" aria-hidden="true"></i> &nbsp; Upload </button>
                </form>
            </div>
        </div>
    </div>


    @push('js')
        <script src="{{ asset('js/file-preview.js') }}"></script>
    @endpush

@endsection
