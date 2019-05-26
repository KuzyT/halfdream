@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <date-time
            @if ($value)
            :value="new Date(Date.parse('{{ $value }}'))"
            @endif
            @if ($size)
            size="{{ $size }}"
            @endif
            @if ($placeholder)
            placeholder="{{ $placeholder }}"
            @endif
            name="{{ $name }}"
            @if ($icon)
            icon="{{ $icon }}"
            @endif
            {!! $options !!}>
    </date-time>
@endcomponent