@component('mail::panel')
    @component('mail::message')
        <p>
            {{ $data['message'] }}
        </p>
        @if ($data['link'])
            @component('mail::button', ['url' => $data['link']])
                Click
            @endcomponent
        @endif
    @endcomponent
@endcomponent