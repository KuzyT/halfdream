@if ($elements && $container->showTranslatable())
    @include('halfdream::admin.includes.translatablenav')
@endif

<nav {!! $attributes !!}>
    @if ($label)
        <p class="panel-heading">
            {{ $label }}
        </p>
    @endif

    @if ($elements)
        @if ($container->showTranslatable())
            @foreach(\Halfdream::locales() as $locale)
                <div v-show="locale == '{{ $locale }}'">
                    @php
                        $container->setTranslatableLocale($locale);
                    @endphp
                    @foreach($elements as $element)
                        <a class="panel-block">
                            {!! $element->render() !!}
                        </a>
                    @endforeach
                </div>
            @endforeach
        @else
            @foreach($elements as $element)
                <a class="panel-block">
                    {!! $element->render() !!}
                </a>
            @endforeach
        @endif
    @endif
</nav>