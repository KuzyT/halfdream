/**
* Created by KuzyT\Halfdream.
* Date: {{ \Carbon\Carbon::now()->toDateString() }}
*/

import { library } from '@fortawesome/fontawesome-svg-core';

@foreach ($icons as $icon)
@if ($icon->faLibraryType)
import { {{ $icon->type == \KuzyT\Halfdream\Models\Icon::TYPE_FAS ? $icon->faCamelKey : $icon->faCamelKey }} as {{ $icon->faTypeCamelKey }} } from '{{ $icon->faLibraryType }}/{{ $icon->faCamelKey }}';
@endif
@endforeach
@php
    $iconsList = ''
@endphp
@foreach($icons as $icon)
    @if ($icon->faLibraryType)
        @php
            $iconsList .= ($iconsList ? ', ' : '') . $icon->faTypeCamelKey
        @endphp
    @endif
@endforeach

(function () {
    library.add(
        {{ $iconsList }}
    );
    return library;
})();