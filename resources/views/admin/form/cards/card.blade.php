@if ($elements && $container->showTranslatable())
    @include('halfdream::admin.includes.translatablenav')
@endif

<div {!! $attributes !!}>
    @if ($label)
        <header class="card-header">
            <p class="card-header-title">
                {{ $label }}
            </p>
        </header>
    @endif

    @if ($elements)
        <div class="card-content">
            @if ($container->showTranslatable())
                @foreach(\Halfdream::locales() as $locale)
                    @php
                        $container->setTranslatableLocale($locale);
                    @endphp
                    <div v-show="locale == '{{ $locale }}'">
                        @foreach($elements as $element)
                            {!! $element->render() !!}
                        @endforeach
                    </div>
                @endforeach
            @else
                @foreach($elements as $element)
                    {!! $element->render() !!}
                @endforeach
            @endif
        </div>
    @endif
</div>