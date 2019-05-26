@foreach($links as $link)
    {{--Some magic because of bulma menu structure with ul and labels without ul--}}
    @if ($loop->first && $loop->last)
        @php
            $previousLink = $nextLink = null;
        @endphp
    @elseif ($loop->first)
        @php
            $previousLink = null;
            $nextLink = $links[$loop->index + 1];
        @endphp
    @elseif ($loop->last)
        @php
            $previousLink = $links[$loop->index - 1];
            $nextLink = null;
        @endphp
    @else
        @php
            $previousLink = $links[$loop->index - 1];
            $nextLink = $links[$loop->index + 1];
        @endphp
    @endif

    @include('halfdream::admin.includes.menulink', ['link' => $link, 'previousLink' => $previousLink, 'nextLink' => $nextLink, 'main' => $main])
@endforeach