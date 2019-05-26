@if (\Halfdream::multiLocale())
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
            <span class="icon is-small flag-icon flag-icon-{{ \Halfdream::countryByLocale() }}"></span>
            <span>{{ __('halfdream::general.language') }}</span>
        </a>

        <div class="navbar-dropdown is-right">

            @foreach(\Halfdream::locales() as $locale)
                <a class="navbar-item {{ $locale == locale() ? 'is-active' : '' }}" @if($locale !== locale())href="{{ route('language', ['locale' => $locale]) }}"@endif>
                    <span class="icon is-small flag-icon flag-icon-{{ \Halfdream::countryByLocale($locale) }}"></span>
                    <span>{!! \Halfdream::localeDisplay($locale) !!}</span>
                </a>
            @endforeach

        </div>
    </div>
@endif