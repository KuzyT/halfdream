@if ($link->isLabel())
    <p class="menu-label">
        {{ $link->getLabel() }}
    </p>
@else
    @if (!$previousLink || $previousLink->isLabel())
        <ul @if ($main) class="menu-list" @endif>
    @endif
        <li>
            @if ($link->isContainer())
                <b-collapse aria-id="navigationLinkContainer{{ $link->getContainerID() }}" :open="{{ $link->isActive() ? 'true' : 'false' }}">
                    <div
                        slot="trigger"
                        slot-scope="props"
                        role="button"
                        aria-controls="navigationLinkContainer{{ $link->getContainerID() }}">
                        <a :class="props.open ? 'is-active' : ''">@if ($link->getIcon())<span class="icon is-small"><font-awesome-icon :icon="{{ $link->getDisplayedIcon() }}"></font-awesome-icon></span>@endif<span>{{ $link->getLabel() }}</span></a>
                    </div>
                    @include('halfdream::admin.includes.menulinks', ['links' => $link->comprised(), 'main' => false])
                </b-collapse>
            @else
                <a class="{{ $link->isActive() ? 'is-active' : '' }}" href="{{ $link->getUrl() }}">@if ($link->getIcon())<span class="icon is-small"><font-awesome-icon :icon="{{ $link->getDisplayedIcon() }}"></font-awesome-icon></span>@endif<span>{{ $link->getLabel() }}</span></a>
            @endif
        </li>
    @if (!$nextLink || $nextLink->isLabel())
        </ul>
    @endif
@endif
