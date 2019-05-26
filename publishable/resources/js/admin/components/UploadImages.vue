<template>
    <div class="file file-admin-vertical">
        <div v-if="errors.length" class="alert alert-warning">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="closeAlert()">
                <span aria-hidden="true">&times;</span>
            </button>

            <p v-for="error in errors"><font-awesome-icon icon="hand-point-right"></font-awesome-icon> @{{ error }}</p>
        </div>


        <vue-dropzone
                :id="name"
                :options="dropzoneOptions"
                :useCustomSlot="true"
                @vdropzone-sending="sendingDropzone"
                @vdropzone-addedfile="addedfileDropzone"
                @vdropzone-success="successDropzone"
                @vdropzone-error="errorDropzone"
                @vdropzone-complete="completeDropzone"
                class="form-element-files dropzone clearfix">
                <div class="dz-message" v-show="!has_values">
                <span class="icon has-text-primary is-large">
                    <font-awesome-icon icon="upload" size="3x"></font-awesome-icon>
                </span>
                </div>

                <draggable v-model="newValues">
                    <div class="form-element-files__item" v-for="(filename, index) in newValues">
                        <figure class="form-element-files__image image is-square" data-toggle="images">
                            <img :src="thumbnail(filename)">
                        </figure>

                        <div class="form-element-files__info">
                            <a :href="image(filename)" class="button float-right">
                    <span class="icon">
                        <font-awesome-icon icon="cloud-download-alt"></font-awesome-icon>
                    </span>
                            </a>

                            <button v-if="!readonly" class="button is-danger" @click.prevent="remove(index)">
                    <span class="icon">
                        <font-awesome-icon icon="times"></font-awesome-icon>
                    </span>
                                <span>{{ lang.remove }}</span>
                            </button>
                        </div>
                    </div>
                </draggable>
        </vue-dropzone>

        <div v-if="!readonly">
            <br/>
            <div class="button is-primary upload-button" :id="uploadButton">
                <font-awesome-icon v-if="uploading" icon="spinner" spin></font-awesome-icon><font-awesome-icon v-else icon="upload"></font-awesome-icon> {{ lang.browse }}
            </div>

            <button v-if="activate_revert" class="button is-info" @click.prevent="setOld()">
                <span class="icon">
                    <font-awesome-icon icon="undo"></font-awesome-icon>
                </span>
                <span>{{ lang.return }}</span>
            </button>
        </div>

        <input :name="name" type="hidden" :value="serializedValues">
    </div>
</template>

<script>
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import draggable from 'vuedraggable';
    import vue2Dropzone from 'vue2-dropzone'
    import 'vue2-dropzone/dist/vue2Dropzone.min.css'

    export default {
        components: {
            FontAwesomeIcon,
            draggable,
            vueDropzone: vue2Dropzone
        },

        props: {
            lang: {
                default: {}
            },
            url: {
                required: true
            },
            values: {
                type: Array,
                default: () => []
            },
            images: {
                default: {}
            },
            thumbnails: {
                default: {}
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
                newValues: this.values.slice(0),
                newImages: Object.assign({}, this.images),
                newThumbnails: Object.assign({}, this.thumbnails),
                dropzoneOptions: {
                    url: this.url,
                    method: 'POST',
                    previewsContainer: false,
                    acceptedFiles: 'image/*',
                    clickable: this.uploadButtonID(true),
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
                this.closeAlert();
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
                this.addData(response);
            },

            errorDropzone (file, response) {
                if (Array.isArray(response.errors)) {
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

            remove (image) {
                this.$dialog.confirm({
                    title: this.lang.delete.title,
                    message: this.lang.delete.message,
                    confirmText: this.lang.delete.confirm,
                    cancelText: this.lang.delete.cancel,
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => this.removeData(image)
                });

            },
            setOld () {
                this.newValues = this.values.slice(0);
                this.newImages = Object.assign({}, this.images);
                this.newThumbnails = Object.assign({}, this.thumbnails);
            },
            addData (data) {
                this.newValues.push(data.value);
                this.newImages[data.value] = data.image;
                this.newThumbnails[data.value] = data.thumbnail;
            },
            removeData (image) {
                let self = this;

                this.newValues = Array.filter(this.newValues, function (img, key) {
                    if (image === key) {
                        delete self.newImages[img];
                        delete self.newThumbnails[img];
                    }

                    return image !== key
                });
            },
            closeAlert () {
                this.errors = [];
            },
            image(value) {
                return this.newImages[value];
            },
            thumbnail(value) {
                return this.newThumbnails[value];
            },
            uploadButtonID(withHash = false) {
                return (withHash ? '#' : '') + this.name.replace(/\[/g, '-').replace(/\]/g, '') + '-upload-button';
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
            has_values () {
                return this.newValues.length > 0
            },

            serializedValues () {
                return this.newValues.join(',')
            },

            activate_revert () {
                // If old values is [], no revert available
                if (!this.values.length) {
                    return false;
                }
                if (this.values.length !== this.newValues.length) {
                    return true;
                }
                for (var i = 0, l = this.values.length; i < l; i++) {
                    if (this.values[i] instanceof Array && this.newValues[i] instanceof Array) {
                        if (!this.values[i].compare(this.newValues[i])) {
                            return true;
                        }
                    }
                    else if (this.values[i] !== this.newValues[i]) {
                        return true;
                    }
                }
                return false;
            },

            uploadButton () {
                return this.uploadButtonID();
            }
        }
    }
</script>
