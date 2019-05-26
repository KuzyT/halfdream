@foreach($items as $item)
    @if ($item->children->isNotEmpty())
        <div class="navbar-item has-dropdown is-hoverable">
            <a href="{{ $item->link }}" class="navbar-link {{ $item->class ?: '' }}">
                @if ($item->icon)
                    <span class="icon" @if($item->color)style="color: {{ $item->color }}"@endif >{!! $item->icon->render(['size' => '']) !!}</span>
                @endif
                <span>{{ $item->title }}</span>
            </a>

            <div class="navbar-dropdown">
                @include('modules.menu.includes.navmenu', ['items' => $item->children])
            </div>
        </div>
    @else
        <a href="{{ $item->link }}" class="navbar-item {{ $item->class ?: '' }}">
            @if ($item->icon)
                <span class="icon" @if($item->color)style="color: {{ $item->color }}"@endif >{!! $item->icon->render(['size' => '']) !!}</span>
            @endif
            <span>{{ $item->title }}</span>
        </a>
    @endif
@endforeach


