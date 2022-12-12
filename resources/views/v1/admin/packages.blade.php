@extends('layouts.admin')

@section('title', 'Trader\'s Packages')

@section('content')
    <div class="container-fluid">

        <div>
            <h4 class="fw-bold">{{ $profile->profileable->firstname }} Package</h4>
            <p class="text-muted">
                Here is all {{ $profile->profileable->firstname }} package. 
                {{-- You can also delete packages. --}}
            </p>
        </div>


        <div class="row">
            @if ($packages && $packages->count() > 0)
                @foreach ($packages as $item)
                    <div class="col-xl-3 col-lg-4 col-md-6 my-3">
                        <div class="card card-body h-100 border-0 py-5 d-block">
                            {{-- <button class="btn text-danger delete-btn position-absolute end-0 top-0 m-2" id="{{ $item->id }}"><i class="far fa-trash-alt"></i></button> --}}
                            <div class="text-center">
                                <h6 class="text-uppercase fw-bold text-success">{{ $item->title }}</h6>
                                <h2 class="fw-bold text-capitalize text-success">{{ $item->roi }}% ROI</h2>
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
                                    <span class="text-success">${{ number_format($item->minimum_amount * ($item->roi/100), 2) }} &dash; ${{ number_format($item->maximum_amount * ($item->roi/100), 2) }}</span>
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
                        <p class="text-muted">{{ $profile->profileable->firstname }} have not created a service package yet</p>
                    </div>
                </div>
            @endif
        </div>
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