@extends('layouts.investor')

@section('title', 'Settings')

@section('content')


    <div class="row justify-content-center my-5">
        <div class="col-xl-5 col-lg-6 col-md-8">
            <div class="card card-body border-0 d-block">
                <a href="{{ route('investor.password') }}" class="text-dark btn w-100 text-start border-0 py-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold d-block mb-1">Change Password</h6>
                            <p class="text-muted mb-0">
                                Update your account's password
                            </p>
                        </div>
                    </div>
                </a>
                <hr>
                <a href="{{ route('investor.check') }}" class="text-dark btn w-100 text-start border-0 py-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-key"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold d-block mb-1">Change Transaction pin</h6>
                            <p class="text-muted mb-0">
                                Update your account's transaction pin
                            </p>
                        </div>
                    </div>
                </a>
                <hr>
                {{-- <a href="#" class="text-dark btn w-100 text-start border-0 py-0 disabled">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold d-block mb-1">Enable 2 Factor Authentication</h6>
                            <p class="text-muted mb-0">
                                secure your account by enabling two factor authentication
                            </p>
                        </div>
                    </div>
                </a>
                <hr> --}}
                <a href="#deleteModal" data-bs-toggle="modal"  class="text-danger btn w-100 text-start border-0 py-0">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <i class="far fa-trash-alt"></i>
                        </div>
                        <div class="flex-grow-1 ms-4">
                            <h6 class="fw-bold d-block mb-1">Delete Account</h6>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Delete Account Prompt</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">Are you sure you want to delete your account? <br> <strong>Note: This action cannot be revered after it is done.</strong></p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="delete-form" action="{{ route('investor.delete.profile') }}" method="POST" class="d-none">
                            @csrf
                            <input type="text" name="user_id" id="userId" value="{{ auth()->user()->id }}">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
