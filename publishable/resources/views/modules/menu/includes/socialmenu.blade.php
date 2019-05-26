@foreach($items as $item)
    <a href="{{ $item->link }}" class="{{ $item->class ?: '' }}" title="{{ $item->title }}">
        @if ($item->icon)
            <span class="icon is-large" @if($item->color)style="color: {{ $item->color }}"@endif >{!! $item->icon->render(['size' => '2x']) !!}</span>
        @endif
    </a>
@endforeach
