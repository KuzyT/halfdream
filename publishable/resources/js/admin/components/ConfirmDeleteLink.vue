<template>
    <a @click="confirmDelete(href)">
        <slot></slot>
    </a>
</template>

<script>
    export default {
        name: 'ConfirmDeleteLink',
        props: {
            href: {
                required: true,
                default: ''
            },
            lang: {
                default: {}
            },
        },
        methods: {
            confirmDelete(url) {
                this.$dialog.confirm({
                    title: this.lang.title,
                    message: this.lang.message,
                    confirmText: this.lang.confirm,
                    cancelText: this.lang.cancel,
                    type: 'is-danger',
                    hasIcon: true,
                    onConfirm: () => axios.post(url, { _method: 'delete', _token: window.Laravel.csrfToken })
                        .then(function (response) {
                            location.reload();
                        })
                        .catch(function (error) {
                            location.reload();
                        })
                })
            }
        }
    }
</script>
