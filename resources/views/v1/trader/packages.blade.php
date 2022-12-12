@extends('layouts.trader')

@section('title', 'My Packages')

@section('content')
    <div class="d-flex justify-content-between flex-wrap mb-5 align-items-center">
        <div>
            <h4 class="fw-bold">Packages</h4>
            <p class="text-muted">
                Create and manage packages of services you want to be rendering to clients. <br> Make sure you complete your profile so your packages can be visible to investors on this platform.
            </p>
        </div>
        <div class="text-end">
            <a href="{{ route('trader.package.create') }}" class="btn btn-success">Create Package</a>
        </div>
    </div>


    <div class="row">
        @if ($packages && $packages->count() > 0)
            @foreach ($packages as $item)
                <div class="col-xl-3 col-lg-4 col-md-6 my-3">
                    <div class="card h-100 card-body border-0 py-5 d-block">
                        <div class="position-absolute end-0 top-0 m-2">
                            <a href="{{ route('trader.package.edit', $item->id) }}" class="btn px-1 text-success"><i class="far fa-edit"></i></a>
                            <button class="btn px-1 text-danger delete-btn" id="{{ $item->id }}"><i class="far fa-trash-alt"></i></button>
                        </div>
                        
                        <div class="text-center">
                            <h6 class="text-uppercase fw-bold text-dark">{{ $item->title }}</h6>
                            <h2 class="fw-bold text-capitalize text-dark">{{ $item->roi }}% ROI</h2>
                            <span class="badge package-banner bg-{{ $item->service->color }}">{{ $item->service->title }}</span>
                        </div>


                        <ul class="list-unstyled my-4">
                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Investment Duration</span>
                                <span class="text-success">{{ $item->duration }} days</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Min Investment</span>
                                <span class="text-success">${{ number_format($item->minimum_amount, 2) }}</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Max Investment</span>
                                <span class="text-success">${{ number_format($item->maximum_amount, 2) }}</span>
                            </li>

                            <li class="d-flex justify-content-between border-bottom py-2 mb-1">
                                <span>Total Profit</span>
                                <span class="text-success">${{ number_format($item->minimum_amount * ($item->roi/100), 2) }} &dash; ${{ number_format($item->maximum_amount * ($item->roi/100), 2)  }}</span>
                            </li>
                        </ul>

                        <div class="text-center">
                            @if ($item->description)
                                <p class="text-muted mb-4">
                                    {{ $item->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-12">
                <div class="text-center">
                    <h6 class="fw-bold">No Item found</h6>
                    <p class="text-muted">You have not created a service package yet</p>
                </div>
            </div>
        @endif
    </div>







    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Delete Package</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to delete this package?
                    </p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="delete-form" action="{{ route('trader.package.delete') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="packageId" name="id">
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
                    $('#packageId').val($id);
                })
                $('#deleteModal').modal('show')
            })
        </script>
    @endpush
@endsection