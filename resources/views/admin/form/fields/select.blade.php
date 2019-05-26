@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <b-select
            @if ($placeholder)
            placeholder="{{ $placeholder }}"
            @endif
            @if ($size)
            size="{{ $size }}"
            @endif
            @if ($value)
            value="{{ $value }}"
            @endif
            name="{{ $name }}"
            @if ($icon)
            icon="{{ $icon }}"
            @endif
            {!! $options !!}>
            @if ($collection instanceof \Illuminate\Support\Collection)
                @foreach($collection as $nativeValue => $nativeLabel)
                    <option value="{{ $nativeValue }}">{{ $nativeLabel }}</option>
                @endforeach
            @endif
    </b-select>
@endcomponent