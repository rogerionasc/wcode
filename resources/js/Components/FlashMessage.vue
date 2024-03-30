<template>
    <div v-if="show" :class="'alert alert-important alert-dismissible alert-' + alertClass" role="alert">
        <div class="d-flex">
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M5 12l5 5l10 -10" />
                </svg>
            </div>
            <div>
                {{ message }}
            </div>
        </div>
        <a class="btn-close" aria-label="close" @click="closeMessage"></a>
    </div>
</template>

<script>
export default {
    name: "FlashMessage",
    props: ['class'],
    data() {
        return {
            show: false,
            message: '',
            alertClass: '',
        }
    },

    watch: {
        '$page.props.flash': {
            handler() {
                if (this.$page.props.flash.success) {
                    this.show = true;
                    this.message = this.$page.props.flash.success;
                    this.alertClass = 'success';
                } else if (this.$page.props.flash.error) {
                    this.show = true;
                    this.message = this.$page.props.flash.error;
                    this.alertClass = 'danger';
                } else if (this.$page.props.flash.warning) {
                    this.show = true;
                    this.message = this.$page.props.flash.warning;
                    this.alertClass = 'warning';
                } else if (this.$page.props.flash.info) {
                    this.show = true;
                    this.message = this.$page.props.flash.info;
                    this.alertClass = 'info';
                } else {
                    this.show = false;
                }
            },
            deep: true,
        },
    },
    methods: {
        closeMessage() {
            this.show = false;
        }
    }
}
</script>
