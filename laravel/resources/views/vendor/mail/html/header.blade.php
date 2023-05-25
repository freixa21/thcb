<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('images/beach-hockey-logo-blau.png')}}" class="logo" alt="Beach Hockey">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
