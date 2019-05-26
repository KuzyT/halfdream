<template>
    <div>
        <ckeditor :editor="editor" v-model="editorData" :config="editorConfig" :disabled="disabled"></ckeditor>
        <textarea style="display: none;" :name="name">{{ nativeValue }}</textarea>
    </div>
</template>

<script>
    // As docs said, here are localizations import. All that we need for site.
    import '@ckeditor/ckeditor5-build-classic/build/translations/ru';
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    const HalfdreamUploadAdapter = require('../ckeditor-plugins/HalfdreamUploadAdapter').default;

    export default {
        name: 'ClassicCKEditor',
        props: {
            value: {
                default: ''
            },
            uploadUrl: {
                required: true,
                default: ''
            },
            name: {
                type: String,
                required: true
            },
            disabled: {
                type: Boolean,
                default: false
            },
            locale: {
                type: String,
                default: 'en'
            }
        },
        data() {
            // Add url as value to the function (as js class)
            let HalfdreamUploadAdapterPlugin = function (editor) {
                editor.plugins.get( 'FileRepository' ).createUploadAdapter = ( loader ) => {
                    return new HalfdreamUploadAdapter( loader, HalfdreamUploadAdapterPlugin.url );
                };
            };
            HalfdreamUploadAdapterPlugin.url = this.uploadUrl;

            return {
                editor: ClassicEditor,
                editorData: this.value,
                editorConfig: {
                    extraPlugins: [ HalfdreamUploadAdapterPlugin ],
                    language: this.locale,
                    image: {
                        // We need to configure the image toolbar, too, so it uses the new style buttons.
                        toolbar: [ 'imageStyle:full', 'imageStyle:side', 'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight', '|', 'imageTextAlternative' ],

                        styles: [
                            'full',
                            'side',
                            'alignLeft',
                            'alignCenter',
                            'alignRight'
                        ]
                    }
                }
            };
        },
        computed: {
            // For the 'empty' ckeditor display
            nativeValue () {
                if (this.editorData === '<p>&nbsp;</p>') return null;
                return this.editorData;
            }
        }
    }
</script>