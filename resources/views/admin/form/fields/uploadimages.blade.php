@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])

    <upload-images
            :lang="{{ json_encode($lang) }}"
            name="{{ $name }}"
            from-field="{{ $fromField }}"
            url="{{ route('admin.upload.image') }}"
            :images="{{ json_encode($images) }}"
            :thumbnails="{{ json_encode($thumbnails) }}"
            :thumbnail-sizes="{{ json_encode($thumbnailSizes) }}"
            :values="{{ json_encode($value) }}"
            :readonly="{{ $readonly ? 'true' : 'false' }}"
    >
    </upload-images>

@endcomponent