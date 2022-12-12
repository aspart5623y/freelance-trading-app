@extends('layouts.admin')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-7">
        
                <div class="card card-body border-0">
                    <form action="{{ route('admin.update.company') }}" method="POST">
                        @csrf

                        <div class="d-flex flex-wrap justify-content-between align-items-end">
                            <h2 class="fw-bold mb-0">Company's Profile</h2>
                        </div>
                        <hr>

                       
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Company name</label>
                                    <input type="text" placeholder="Enter your company's name" name="name" value="{{ old('name') ? old('name') : ($company ? $company->name : "") }}" class="form-control min-height @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Company phone</label>
                                    <input type="text" placeholder="Enter your company's phone" name="phone" value="{{ old('phone') ? old('phone') : ($company ? $company->phone : "") }}" class="form-control min-height @error('phone') is-invalid @enderror">

                                    @error('phone')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Company email</label>
                                    <input type="email" placeholder="Enter your company's email" name="email" value="{{ old('email') ? old('email') : ($company ? $company->email : "") }}" class="form-control min-height @error('email') is-invalid @enderror">

                                    @error('email')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Company address</label>
                                    <textarea name="address" rows="3" placeholder="Enter company's address" class="form-control">{{ old('address') ? old('address') : ($company ? $company->address : "") }}</textarea>

                                    @error('address')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-12">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Map address</label>
                                    <textarea name="map" rows="3" placeholder="Enter company's map" class="form-control">{{ old('map') ? old('map') : ($company ? $company->map : "") }}</textarea>

                                    @error('map')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Company wallet balance</label>
                                    <input type="text" placeholder="Enter your company's wallet balance" name="wallet_balance" value="{{ old('wallet_balance') ? old('wallet_balance') : ($company ? $company->wallet_balance : "") }}" class="form-control min-height @error('wallet_balance') is-invalid @enderror">

                                    @error('wallet_balance')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Facebook</label>
                                    <input type="text" placeholder="Enter company's facebook url" name="facebook" value="{{ old('facebook') ? old('facebook') : ($company ? $company->facebook : "") }}" class="form-control min-height @error('facebook') is-invalid @enderror">

                                    @error('facebook')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Twitter</label>
                                    <input type="text" placeholder="Enter company's twitter url" name="twitter" value="{{ old('twitter') ? old('twitter') : ($company ? $company->twitter : "") }}" class="form-control min-height @error('twitter') is-invalid @enderror">

                                    @error('twitter')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Instagram</label>
                                    <input type="text" placeholder="Enter company's instagram url" name="instagram" value="{{ old('instagram') ? old('instagram') : ($company ? $company->instagram : "") }}" class="form-control min-height @error('instagram') is-invalid @enderror">

                                    @error('instagram')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            

                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Linkedin</label>
                                    <input type="text" placeholder="Enter company's linkedin url" name="linkedin" value="{{ old('linkedin') ? old('linkedin') : ($company ? $company->linkedin : "") }}" class="form-control min-height @error('linkedin') is-invalid @enderror">

                                    @error('linkedin')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label class="mb-1">Youtube</label>
                                    <input type="text" placeholder="Enter company's youtube url" name="youtube" value="{{ old('youtube') ? old('youtube') : ($company ? $company->youtube : "") }}" class="form-control min-height @error('youtube') is-invalid @enderror">

                                    @error('youtube')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="text-end">
                            <button class="btn btn-success px-4" type="submit">Update</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
    