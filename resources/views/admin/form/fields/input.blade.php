@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <b-input
            @if ($type)
                type="{{ $type }}"
            @endif
            @if ($placeholder)
                placeholder="{{ $placeholder }}"
            @endif
            @if ($size)
                size="{{ $size }}"
            @endif
            @if ($maxSize)
                maxlength="{{ $maxSize }}"
            @endif
            @if ($minSize)
                minlength="{{ $minSize }}"
            @endif
            @if ($value)
                value="{{ $value }}"
            @endif
            name="{{ $name }}"
            @if ($icon)
                icon="{{ $icon }}"
            @endif

            {!! $options !!}>
    </b-input>
@endcomponent