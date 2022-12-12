@component('mail::panel')
@component('mail::message')
    <h1 class="">Hello! {{ $data['name'] }}</h1>
    <p>You have successfully transferred <strong>${{ $data['amount'] }}</strong> to {{ $data['reciever'] }}. Your wallet balance is <strong>${{ $data['wallet_balance'] }}</strong>.</p>
@endcomponent
@endcomponent