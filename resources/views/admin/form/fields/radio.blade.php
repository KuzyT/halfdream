@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    @if ($collection instanceof \Illuminate\Support\Collection)
        <div class="field">
        @foreach($collection as $nativeValue => $nativeLabel)
            @if (!$horizontal)
                <div class="field">
            @endif
            <b-radio
                    @if ($size)
                        size="{{ $size }}"
                    @endif
                    {{-- Bulma says mabe some problems with int value. If does, need to :value for them --}}
                    @if ($value)
                        value="{{ $value }}"
                    @endif
                        name="{{ $name }}"
                    @if ($type)
                        type="{{ $type }}"
                    @endif
                    {!! $options !!}
                    native-value="{{ $nativeValue }}">
                {{ $nativeLabel }}
            </b-radio>
            @if (!$horizontal)
                </div>
            @endif
        @endforeach
        </div>
    @endif
@endcomponent