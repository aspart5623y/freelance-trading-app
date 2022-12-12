@component('mail::panel')
@component('mail::message')
    <h1 class="">Hello! {{ $data['name'] }}</h1>
    <p>Your <strong>${{ $data['amount'] }}</strong> withdrawal has been {{ $data['action'] }}. Your wallet balance would be updated immediately.</p>
@endcomponent
@endcomponent