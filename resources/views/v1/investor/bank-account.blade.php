@extends('layouts.investor')

@section('title', 'My Bank Accounts')

@section('content')

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-5">
            <div class="card card-body border-0 mb-4">
                <h5 class="fw-bold mb-4">Add Bank Account</h5>
                <form action="{{ route('investor.bank.add') }}" method="post">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="mb-1">Bank Name</label>
                        <input type="text" placeholder="Enter bank name" name="bank_name" class="form-control min-height @error('bank_name') is-invalid @enderror">
                        @error('bank_name') 
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-1">Account Name</label>
                        <input type="text" placeholder="Enter account name" name="account_name" class="form-control min-height @error('account_name') is-invalid @enderror">
                        @error('account_name') 
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-1">Account Number</label>
                        <input type="text" placeholder="Enter account number" name="account_number" class="form-control min-height @error('account_number') is-invalid @enderror">
                        @error('account_number') 
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                    <div class="form-group mb-4">
                        <label class="mb-1">Routing/Swift/Iban Code</label>
                        <input type="text" placeholder="Enter Routing/Swift/Iban Code" name="code" class="form-control min-height @error('code') is-invalid @enderror">
                        @error('code') 
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-success">Create</button>
                </form>
            </div>
        </div>
        <div class="col-xl-8 col-lg-12 col-md-7">
            <div class="card card-body border-0 mb-4">
                <h5 class="fw-bold"><i class="fa fa-landmark" aria-hidden="true"></i> &nbsp; My Bank Accounts</h5>

                @if ($accounts->where('account_type', 'bank')->count() > 0)
                    @foreach ($accounts as $item)
                        @if ($item->bank)
                            <hr>
                            <div>
                                <button class="btn float-end text-danger delete-btn" id="{{ $item->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <div class="row align-items-center">
                                    <div class="col-sm-6">
                                        <small class="text-muted fw-bold">Account Name</small>
                                        <h6>{{ $item->bank->account_name }}</h6>
                                    </div>
                                
                                    <div class="col-sm-3">
                                        <small class="text-muted fw-bold">Bank Name</small>
                                        <h6>{{ $item->bank->bank_name }}</h6>
                                    </div>
                                
                                    <div class="col-sm-3">
                                        <small class="text-muted fw-bold">Account Number</small>
                                        <p>{{ $item->bank->account_number }}</p>
                                    </div>
                                </div>

                                @if ($item->bank->code)
                                    <span>Routing/Swift/Iban Code: {{ $item->bank->code }}</span>
                                @endif

                            </div>
                        @endif
                    @endforeach
                @else
                    <hr>
                    <p class="text-muted text-center fw-bold">You have not added a bank accounts</p>
                @endif

            </div>
        </div>
    </div>









    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Delete Account</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to delete this account?
                    </p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="delete-form" action="{{ route('investor.account.delete') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="accountId" name="id">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @push('js')
        <script>
            $('.delete-btn').on('click', function() {
                $id = $(this).attr('id');
                $('#deleteModal').on('show.bs.modal', function() {
                    $('#accountId').val($id);
                })
                $('#deleteModal').modal('show')
            })
        </script>
    @endpush
@endsection