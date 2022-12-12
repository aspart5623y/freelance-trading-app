@extends('layouts.admin')

@section('title', 'Edit Services')

@section('content')
    <div class="container-fluid">
       
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-xl-5 col-md-6">
                <div class="card mb-4 card-body border-0 py-4 d-block">
                    <form action="{{ route('admin.service.update', $service->id) }}" method="post">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label class="mb-1">Service Title</label>
                            <input type="text" placeholder="Enter service title" class="form-control min-height @error('title') is-invalid @enderror" name="title" value="{{ old('title') ? old('title') : $service->title }}">
                
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
                                <option value="primary" {{ old('color') ? (old('color') == "primary" ? "selected" : "") : ($service->color == "primary" ? "selected" : "") }}>blue</option>
                                <option value="success" {{ old('color') ? (old('color') == "success" ? "selected" : "") : ($service->color == "success" ? "selected" : "") }}>green</option>
                                <option value="warning" {{ old('color') ? (old('color') == "warning" ? "selected" : "") : ($service->color == "warning" ? "selected" : "") }}>yellow</option>
                                <option value="light" {{ old('color') ? (old('color') == "light" ? "selected" : "") : ($service->color == "light" ? "selected" : "") }}>light grey</option>
                                <option value="secondary" {{ old('color') ? (old('color') == "secondary" ? "selected" : "") : ($service->color == "secondary" ? "selected" : "") }}>grey</option>
                                <option value="danger" {{ old('color') ? (old('color') == "danger" ? "selected" : "") : ($service->color == "danger" ? "selected" : "") }}>red</option>
                                <option value="white" {{ old('color') ? (old('color') == "white" ? "selected" : "") : ($service->color == "white" ? "selected" : "") }}>white</option>
                                <option value="info" {{ old('color') ? (old('color') == "info" ? "selected" : "") : ($service->color == "info" ? "selected" : "") }}>farouz</option>
                                <option value="dark" {{ old('color') ? (old('color') == "dark" ? "selected" : "") : ($service->color == "dark" ? "selected" : "") }}>black</option>
                            </select>
                            @error('color')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           
                        </div>


                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection