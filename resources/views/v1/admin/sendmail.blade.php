@extends('layouts.admin')

@section('title', 'Send Mail')

@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-5">
                <div class="card card-body border-0 py-4 my-5">

                    <h4 class="fw-bold mb-4">Send mail</h4>
                    <form action="{{ route('admin.postmail') }}" method="post">
                        @csrf 

                        <div class="form-group mb-3">
                            <label class="mb-1">Subject</label>
                            <input type="text" placeholder="Enter the subject of your mail" class="form-control min-height @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" autocomplete="subject" autofocus>

                            @error('subject')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label for="email" class="mb-1">Reciepient Email address</label>
                            <input id="email" type="email" placeholder="Enter the recipient email address" class="form-control min-height @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                
                            @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>


                        <div class="form-group mb-3">
                            <label class="mb-1">Message</label>
                            <textarea name="message" rows="10" placeholder="Enter your message" class="form-control @error('message') is-invalid @enderror"></textarea>
                
                            @error('message')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="mb-1">Link <small class="text-muted">(optional)</small></label>
                            <input type="text" placeholder="Enter any important link that you would like your reciepient to click" class="form-control min-height @error('link') is-invalid @enderror" name="link" value="{{ old('link') }}" autocomplete="link" autofocus>

                            @error('link')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button class="btn btn-success px-4">Send mail</button>
                        </div>
                
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
