<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tranzir</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/owl.theme.default.min.css') }}">
        <style>
            body {
                background: var(--dashboard-bg);
            }
        </style>
    </head>
    <body>

        <main class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card card-body py-5">
                            <div class="text-center">
                                <img src="{{ asset('images/auth/404.svg') }}" alt="" class="" width="300">
                                <h4 class="fw-bold mt-4">Page Not Found</h4>
                                <p class="text-muted">Click the button below to go back to the home page</p>
                                <a href="{{ route('index') }}" class="btn btn-success px-4">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        




        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/font-awesome.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    </body>
</html>