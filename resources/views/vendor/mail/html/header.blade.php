<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Tranzir')
<img src="{{ asset('images/logo/logo.png') }}" class="logo" alt="Tranzir Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
