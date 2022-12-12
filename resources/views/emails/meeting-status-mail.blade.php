@component('mail::panel')
@component('mail::message')
<h1 class="">Hello! {{ $data['name'] }}</h1>
<p>Your meeting with our admin was {{ $data['action'] }}</p>

<p>Regards, <br/> Tranzir</p>
@endcomponent
@endcomponent