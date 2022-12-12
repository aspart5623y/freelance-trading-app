@component('mail::panel')
@component('mail::message')
    <h1 class="">Hello! {{ $data['name'] }}</h1>
    <p>Your account has been {{ $data['action'] }}. Contact our admin for help.</p>
@endcomponent
@endcomponent