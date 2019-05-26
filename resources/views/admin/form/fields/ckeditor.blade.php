@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])
    <classic-ckeditor
            @if ($value)
            value="{{ $value }}"
            @endif
            name="{{ $name }}"
            locale="{{ locale() }}"
            upload-url="{{ route('admin.upload.image') }}">
    </classic-ckeditor>
@endcomponent

