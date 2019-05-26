<div {!! $attributes !!}>

    @if ($display)
        <header class="card-header">
            @if ($label)
                <p class="card-header-title">
                    {{ $label }}
                </p>
            @endif
            <a href="{{ route('admin.module.create', array_merge(['module' => $display->getKey()], $options && key_exists('parameters', $options) ? $options['parameters'] : []) ) }}" class="card-header-icon">
                <span class="icon">
                    <font-awesome-icon icon="plus"></font-awesome-icon>
                </span>
                <span>{{ __('halfdream::admin.create.button') }}</span>
            </a>
        </header>

        <div class="card-content">
            {!! $display->render() !!}
        </div>
    @endif
</div>


