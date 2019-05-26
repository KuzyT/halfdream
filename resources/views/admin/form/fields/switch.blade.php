@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <b-switch
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
        {!! $placeholder !!} {{$value}}
    </b-switch>
@endcomponent