@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <b-datepicker
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
    </b-datepicker>
@endcomponent