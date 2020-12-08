<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9b/Logo-upe-site.png" class="logo" alt="Laravel Logo" width="200" height="150">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>
