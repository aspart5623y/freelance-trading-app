@component('mail::panel')
    @component('mail::message')
        <h1 class="">
            Hello! {{ $data['name'] }}
        </h1>
        <p>
            Your KYC has been {{ $data['action'] }}. 
        </p>
        @if($data['reason'])
            <p><strong>Reason:</strong> {{$data['reason']}}</p>
        @endif
        <p>Thank you for choosing Tranzir</p>
        <p>Regards, <br/> Tranzir</p>
    @endcomponent
@endcomponent