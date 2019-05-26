<template>
    <div class="file file-admin">
        <div v-if="errors.length" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="closeAlert()">
                <span aria-hidden="true">&times;</span>
            </button>

            <p v-for="error in errors"><font-awesome-icon icon="hand-point-right"></font-awesome-icon> @{{ error }}</p>
        </div>
        <div class="form-element-files clearfix" v-if="has_value">
            <div class="form-element-files__item">

                <figure class="form-element-files__image image is-square">
                    <img :src="newThumbnail">
                </figure>

                <div class="form-element-files__info">
                    <a :href="newImage" class="button float-right">
                        <span class="icon">
                            <font-awesome-icon icon="cloud-download-alt"></font-awesome-icon>
                        </span>
                    </a>

                    <button v-if="has_value && !readonly" class="button is-danger" @click.prevent="remove()">
                        <span class="icon">
                            <font-awesome-icon icon="times"></font-awesome-icon>
                        </span>
                        <span>{{ lang.remove }}</span>
                    </button>
                </div>
            </div>
        </div>

        <div v-if="!readonly">

            <vue-dropzone
                    :id="name"
                    :options="dropzoneOptions"
                    :useCustomSlot="true"
                    @vdropzone-sending="sendingDropzone"
                    @vdropzone-addedfile="addedfileDropzone"
                    @vdropzone-success="successDropzone"
                    @vdropzone-error="errorDropzone"
                    @vdropzone-complete="completeDropzone"
                    :include-styling="false"
                    class="button is-primary upload-button">
                <font-awesome-icon v-if="uploading" icon="spinner" spin></font-awesome-icon><font-awesome-icon v-else icon="upload"></font-awesome-icon> {{ lang.browse }}
            </vue-dropzone>




            <button v-if="value && newValue != value" class="button is-info" @click.prevent="setOld()">
                <span class="icon">
                    <font-awesome-icon icon="undo"></font-awesome-icon>
                </span>
                <span>{{ lang.return }}</span>
            </button>
        </div>

        <input :name="name" type="hidden" :value="newValue">
    </div>
</template>

<script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        components: {
            FontAwesomeIcon,
            vueDropzone: vue2Dropzone
        },

        props: {
            lang: {
                default: {}
            },
            url: {
                required: true
            },
            value: {
                default: ''
            },
            image: {
                default: ''
            },
            thumbnail: {
                default: ''
            },
            thumbnailSizes: {
                default: []
            },
            readonly: {
                type: Boolean,
                default: false
            },
            name: {
                type: String,
                required: true
            },
            fromField: {
                default: null
            }
        },
        data () {
            return {
                errors: [],
                uploading: false,
                newValue: this.value,
                newImage: this.image,
                newThumbnail: this.thumbnail,
                dropzoneOptions: {
                    url: this.url,
                    method: 'POST',
                    uploadMultiple: false,
                    previewsContainer: false,
                    acceptedFiles: 'image/*',
                    dictDefaultMessage: '',
                    headers: { 'X-CSRF-TOKEN': window.Laravel.csrfToken },
                }
            }
        },

        methods: {
            sendingDropzone (file, xhr, formData) {
                this.uploading = true;
                if (this.fromField && this.getImageTitle()) {
                    formData.append('title', this.getImageTitle());
                }
                if (this.thumbnailSizes) {
                    formData.append('sizes', JSON.stringify(this.thumbnailSizes));
                }
                this.closeAlert()
            },

            addedfileDropzone (file) {
                if (this.fromField && !this.getImageTitle()) {
                    this.removeFile(file);
                    this.$dialog.alert({
                        title: this.lang.error,
                        message: this.lang.notitle
                    })
                }
            },

            successDropzone (file, response) {
                this.setData(response);
            },

            errorDropzone (file, response) {
                if(Array.isArray(response.errors)) {
                    this.errors = response.errors;
                }

                this.$dialog.alert({
                    title: this.lang.error,
                    message: response
                })
            },

            completeDropzone () {
                this.uploading = false;
            },

            remove () {
                this.$dialog.confirm({
                    title: this.lang.delete.title,
                    message: this.lang.delete.message,
                    confirmText: this.lang.delete.confirm,
                    cancelText: this.lang.delete.cancel,
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.setData(null)
                });
            },

            setOld () {
                this.setData(this);
            },

            setData (data) {
                this.newValue = data ? data.value : '';
                this.newImage = data ? data.image : '';
                this.newThumbnail = data ? data.thumbnail : '';
            },

            closeAlert () {
                this.errors = [];
            },

            getImageTitle () {
                if (!this.fromField) { return null; }

                var doc = null;
                // If it is translatable field, trying to search from translatable field...
                let fromNameArr = this.name.split('[');
                if (fromNameArr.length > 1) {
                    fromNameArr.splice(0, 1, this.fromField);
                    doc = document.querySelector("input[name='"+fromNameArr.join('[')+"']");

                    if (doc) {
                        return doc.value;
                    }
                }

                doc = document.querySelector("input[name='"+this.fromField+"']");

                if (doc) {
                    return doc.value;
                } else {
                    return null;
                }
            },
        },
        computed: {
            has_value () {
                return this.newValue.length > 0
            }
        }
    }
</script>
