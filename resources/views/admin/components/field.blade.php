<b-field
        @if (!empty($label))
            label="{{ $label }}"
        @endif
        @if (!empty($attributes))
            {!! $attributes !!}
        @endif
        @if ($errors->has($errorName))
            type="{{ 'is-danger' }}"
            :message="{{ json_encode($errors->first($errorName)) }}"
        @endif
>
    {{ $slot }}
</b-field>
