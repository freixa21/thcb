<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://hockeycostabrava.com/wp-content/uploads/2023/05/Beach-Hockey-Logo-No-Borrar.png" class="logo" alt="Beach Hockey Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
