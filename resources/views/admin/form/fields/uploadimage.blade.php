@component('halfdream::admin.components.field', ['label' => $label, 'attributes' => $attributes, 'errorName' => $nameDot])

        <upload-image
                :lang="{{ json_encode($lang) }}"
                name="{{ $name }}"
                from-field="{{ $fromField }}"
                url="{{ route('admin.upload.image') }}"
                image="{{ $image }}"
                thumbnail="{{ $thumbnail }}"
                :thumbnail-sizes="{{ json_encode($thumbnailSizes) }}"
                value="{{ $value }}"
                :readonly="{{ $readonly ? 'true' : 'false' }}"
        >
        </upload-image>

@endcomponent