<template>
    <div>
        <gallery :images="images" :index="index" @close="index = null" :options="options"></gallery>
        <figure
                class="image is-square"
                v-for="(thumb, imageIndex) in thumbs"
                :key="imageIndex"
                @click="index = imageIndex"
        >
            <img :src="thumb">
        </figure>
    </div>
</template>

<script>
    import VueGallery from 'vue-gallery';

    export default {
        name: "Gallery",

        props: {
            images: {
                default: []
            },
            thumbs: {
                default: []
            },
            options: {
                default: {}
            }
        },

        data: function () {
            return {
                index: null
            };
        },

        components: {
            'gallery': VueGallery
        },
    }
</script>

<style scoped>
    .image img {
        object-fit: cover;
        cursor: pointer;
    }
</style>
