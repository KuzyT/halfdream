<div class="tabs is-centered is-boxed is-marginless is-translatable">
    <ul>
        @foreach(\Halfdream::locales() as $locale)
            <li :class="{'is-active': locale == '{{ $locale }}'}">
                <a @click="locale = '{{ $locale }}'">
                    <span class="icon is-small flag-icon flag-icon-{{ \Halfdream::countryByLocale($locale) }}"></span>
                    {!! \Halfdream::localeDisplay($locale) !!}
                </a>
            </li>
        @endforeach
    </ul>
</div>