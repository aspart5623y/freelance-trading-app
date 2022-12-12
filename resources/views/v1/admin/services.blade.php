@extends('layouts.admin')

@section('title', 'Manage Services')

@section('content')
    <div class="container-fluid">
       

        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-md-6">
                <div class="card mb-4 card-body border-0 py-4 d-block">
                    <form action="{{ route('admin.service.store') }}" method="post">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label class="mb-1">Service Title</label>
                            <input type="text" placeholder="Enter service title" class="form-control min-height @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}">
                
                            @error('title')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Service Color</label>
                            <select name="color" id="" class="form-select min-height @error('color') is-invalid @enderror">
                                <option value="">Select a service colour</option>
                                <option value="primary">blue</option>
                                <option value="success">green</option>
                                <option value="warning">yellow</option>
                                <option value="secondary">gray</option>
                                <option value="danger">red</option>
                                <option value="light">light gray</option>
                                <option value="white">white</option>
                                <option value="info">farouz</option>
                                <option value="dark">black</option>
                            </select>
                            @error('color')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           
                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Create</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xxl-8 col-xl-7 col-md-6">
                <div class="card mb-4 card-body border-0 py-4 d-block">
                    <h5 class="fw-bold mb-4">Service List</h5>
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th class="text-muted fw-bold">Service Title</th>
                                    <th class="text-muted fw-bold">Service Color</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($services)
                                    @foreach ($services as $item)
                                        <tr class="border-bottom">
                                            <td>{{ $item->title }}</td>
                                            <td>
                                                <span class="py-1 px-5 {{ $item->color == "light" || $item->color == "white" ? "text-dark border" : "text-white" }} bg-{{ $item->color }}"></span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.service.edit', $item->id) }}" class="btn text-info"><i class="far fa-edit"></i></a>
                                                &nbsp;
                                                <button class="btn text-danger delete-btn" id="{{ $item->id }}"><i class="far fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr class="border-bottom">
                                        <td colspan="3">No service addedd</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>











    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <h5 class="fw-bold">Delete service</h5>
                        <button class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    
                    <p class="text-muted">
                        Are you sure you want to delete this service?
                    </p>
                    
                    <div class="text-end">
                        <button class="btn btn-light text-danger px-4 me-1" data-bs-dismiss="modal">Cancel</button>
                        <a class="btn btn-danger px-4" href="#"
                            onclick="event.preventDefault();
                                        document.getElementById('delete-form').submit();">
                            Confirm
                        </a>
                    
                        <form id="delete-form" action="{{ route('admin.service.delete') }}" method="POST" class="d-none">
                            @csrf
                            <input type="hidden" id="serviceId" name="id">
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
                    $('#serviceId').val($id);
                })
                $('#deleteModal').modal('show')
            })
        </script>
    @endpush
@endsection