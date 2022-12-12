@component('mail::panel')
@component('mail::message')
    <h1 class="">Hello! {{ $data['reciever'] }}</h1>
    <p>Your wallet has been credited with <strong>${{ $data['amount'] }}</strong> from {{ $data['name'] }}. Your wallet balance is <strong>${{ $data['new_wallet_balance'] }}</strong>.</p>
@endcomponent
@endcomponent