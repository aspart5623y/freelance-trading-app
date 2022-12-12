@component('mail::panel')
    @component('mail::message')
        <h1 class="">
            Hello! {{ $name }}
        </h1>
        <p>
            We have recieved your withdrawal request and our admin would review it as soon as possible.
        </p>
        <p>Regards, <br/> Tranzir</p>
    @endcomponent
@endcomponent