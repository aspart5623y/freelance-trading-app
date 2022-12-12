@component('mail::panel')
@component('mail::message')
<h1> Hello! {{ $data['name'] }}</h1>
<p>You have been invited for an interview on <strong>{{ formatDate($data['meeting_date']) }}</strong></p>
<h5>Meeting Details:</h5>

<p>
    <strong>Meeting Date:</strong> {{ formatDate($data['meeting_date']) }} <br />
    <strong>Meeting Time:</strong> {{ formatTime($data['meeting_time']) }} <br />
    <strong>Meeting Link:</strong> <a href="{{ $data['meeting_link'] }}">{{ $data['meeting_link'] }}</a> 
</p> 

@component('mail::button', ['url' => $data['meeting_link']]) 
Join Meeting 
@endcomponent

Thank you for choosing Tranzir

Regards, <br>
Tranzir
@endcomponent

@endcomponent






