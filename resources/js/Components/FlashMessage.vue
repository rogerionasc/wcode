<template>
    <div v-if="show" :class="'alert alert-important alert-dismissible alert-' + alertClass" role="alert">
        <div class="d-flex">
            <div>
                <!-- Success -->
                <svg v-if="flash && flash.success" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                <!-- Warning -->
                <svg v-if="flash && flash.warning" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                <!-- Error -->
                <svg v-if="flash && flash.error" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                <!-- Info -->
                <svg v-if="flash && flash.info"  xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
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

    data() {
        return {
            show: false,
            message: '',
            alertClass: '',
            flash: null
        }
    },

    watch: {
        '$page.props.flash': {
            immediate: true,
            handler() {
                if (this.$page.props.flash) {
                    const flash = this.$page.props.flash;
                    if (flash.success) {
                        this.show = true;
                        this.message = flash.success;
                        this.alertClass = 'success';
                    } else if (flash.error) {
                        this.show = true;
                        this.message = flash.error;
                        this.alertClass = 'danger';
                    } else if (flash.warning) {
                        this.show = true;
                        this.message = flash.warning;
                        this.alertClass = 'warning';
                    } else if (flash.info) {
                        this.show = true;
                        this.message = flash.info;
                        this.alertClass = 'info';
                    } else {
                        this.show = false;
                    }
                    this.flash = flash;
                }
            },
        },
    },
    methods: {
        closeMessage() {
            this.show = false;
        }
    },
}
</script>
