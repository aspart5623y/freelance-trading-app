@extends('layouts.trader')

@section('title', 'My Bank Accounts')

@section('content')

    <div class="row">
        <div class="col-xl-4 col-lg-12 col-md-5">
            <div class="card card-body border-0 mb-4">
                <h5 class="fw-bold mb-4">Add Crypto Wallet</h5>
                <form action="{{ route('trader.crypto.add') }}" method="post">
                    @csrf

                    <div class="form-group mb-4">
                        <label class="mb-1">Coin Name</label>
                        <input type="text" placeholder="Enter coin name" name="coin" class="form-control min-height @error('coin') is-invalid @enderror">
                        @error('coin') 
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label class="mb-1">Wallet Address</label>
                        <input type="text" placeholder="Enter wallet address" name="wallet_address" class="form-control min-height @error('wallet_address') is-invalid @enderror">
                        @error('wallet_address') 
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
                <h5 class="fw-bold"><i class="fa fa-coins" aria-hidden="true"></i> &nbsp; My Wallet Address</h5>

                @if ($accounts->where('account_type', 'crypto')->count() > 0)
                    @foreach ($accounts as $item)
                        @if ($item->crypto)
                        <hr>
                            <div>
                                <button class="btn float-end text-danger delete-btn" id="{{ $item->id }}">
                                    <i class="far fa-trash-alt"></i>
                                </button>
                                <div class="row align-items-center">
                                    <div class="col-sm-3">
                                        <small class="text-muted fw-bold">Coin name</small>
                                        <h6>{{ $item->crypto->coin }}</h6>
                                    </div>
                                
                                    <div class="col-sm-9">
                                        <small class="text-muted fw-bold">Wallet Address</small>
                                        <h6>{{ $item->crypto->wallet_address }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <hr>
                    <p class="text-muted text-center fw-bold">You have not added a crypto wallet</p>
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
                    
                        <form id="delete-form" action="{{ route('trader.account.delete') }}" method="POST" class="d-none">
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