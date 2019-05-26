@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <b-checkbox
            @if ($value)
                :value="true"
            @endif
            @if ($size)
                size="{{ $size }}"
            @endif
            name="{{ $name }}"
            @if ($type)
                type="{{ $type }}"
            @endif
            {!! $options !!}>
        {!! $placeholder !!}
    </b-checkbox>
@endcomponent