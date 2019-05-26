@foreach($items as $item)
    <a href="{{ $item->link }}" class="navbar-item {{ $item->class ?: '' }}">
        @if ($item->icon)
            <span class="icon" @if($item->color)style="color: {{ $item->color }}"@endif >{!! $item->icon->render(['size' => 'lg']) !!}</span>
        @endif
        <span>{{ $item->title }}</span>
    </a>
@endforeach


