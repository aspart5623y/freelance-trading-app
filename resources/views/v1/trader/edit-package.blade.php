@extends('layouts.trader')

@section('title', 'Edit Packages')

@section('content')
    <div class="row justify-content-center my-5">
        <div class="col-xxl-8 col-xl-9">
            <div class="card card-body border-0 py-4">
                <form action="{{ route('trader.package.update', $package->id) }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Package service</label>
                                <select name="service" id="serviceSelect" class="form-select min-height @error('service') is-invalid @enderror">
                                    <option value="">Select service</option>
                                    @foreach ($services as $item)
                                        <option value="{{ $item->id }}" {{ old('service') ? (old('service') == $item->id ? "selected" : "") : ($package->service_id == $item->id ? "selected" : "") }}>{{ $item->title }}</option>
                                    @endforeach
                                    <option value="other" {{ old('service') == "other" ? "selected" : "" }}>Other</option>
                                </select>
                                @error('service') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">If Other, please specify</label>
                                <input type="text" id="otherService" placeholder="Enter Other service Eg. Forex, Crypto" name="other" class="form-control min-height @error('other') is-invalid @enderror" value="{{ old('other') }}" disabled>
                                @error('other') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Package title</label>
                                <input type="text" placeholder="Enter package title" name="title" class="form-control min-height @error('title') is-invalid @enderror" value="{{ old('title') ? old('title') : $package->title }}">
                                @error('title') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Package ROI</label>
                                <div class="input-group">
                                    <input type="text" placeholder="Enter package ROI" name="roi" class="form-control min-height @error('roi') is-invalid @enderror" value="{{ old('roi') ? old('roi') : $package->roi }}">
                                    <span class="input-group-text px-4">%</span>
                                </div>
                                @error('roi') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Package duration</label>
                                <div class="input-group">
                                    <input type="text" placeholder="Enter package duration" name="duration" class="form-control min-height @error('duration') is-invalid @enderror" value="{{ old('duration') ? old('duration') : $package->duration }}">
                                    <span class="input-group-text px-4">Days</span>
                                </div>
                                <small class="text-muted">(Maximum of 30days)</small>
                                @error('duration') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Minimum Investment Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text px-4">$</span>
                                    <input type="text" placeholder="Enter Minimum Investment Amount" name="minimum_amount" class="form-control min-height @error('minimum_amount') is-invalid @enderror" value="{{ old('minimum_amount') ? old('minimum_amount') : $package->minimum_amount }}">
                                </div>
                                @error('minimum_amount') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group mb-4">
                                <label class="mb-1">Maximum Investment Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text px-4">$</span>
                                    <input type="text" placeholder="Enter Maximum Investment Amount" name="maximum_amount" class="form-control min-height @error('maximum_amount') is-invalid @enderror" value="{{ old('maximum_amount') ? old('maximum_amount') : $package->maximum_amount }}">
                                </div>
                                @error('maximum_amount') 
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group mb-4"> 
                                <label class="mb-1">Package Description (optional)</label> 
                                <textarea name="description" rows="3" placeholder="Brief description of package" class="form-control">{{ old('description') ? old('description') : $package->description }}</textarea> 
                                @error('description') 
                                    <span class="text-danger"> 
                                        <strong>{{ $message }}</strong> 
                                    </span> 
                                @enderror 
                            </div>
                        </div>

                        <div class="col-12 align-self-end">
                            <div class="text-end mb-4"> 
                                <button type="submit" class="btn btn-success px-4">Create</button>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>





    @push('js')
        <script>

            $("#serviceSelect").on('change', function() {
                if ($(this).val() == "other") {
                    $("#otherService").attr('disabled', false)
                } else {
                    $("#otherService").attr('disabled', true)
                }
            })

            $(window).on('load', function() {
                if ($("#serviceSelect").val() == "other") {
                    $("#otherService").attr('disabled', false)
                } else {
                    $("#otherService").attr('disabled', true)
                }
            })

        </script>
    @endpush
@endsection