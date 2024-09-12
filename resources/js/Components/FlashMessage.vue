<template>
    <div
        v-if="show"
        :class="['alert alert-dismissible alert-' + alertClass, { 'fade-out': isFading }]"
        role="alert"
    >
        <div class="d-flex">
            <div>
                <!-- Success Icon -->
                <svg v-if="flash.success" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                <!-- Warning Icon -->
                <svg v-if="flash.warning" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4" /><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z" /><path d="M12 16h.01" /></svg>
                <!-- Error Icon -->
                <svg v-if="flash.error" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg>
                <!-- Info Icon -->
                <svg v-if="flash.info" xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
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
            flash: this.$page.props.flash || {},
            timeout: null, // Referência para o temporizador
            isFading: false, // Novo estado para controle do fade-out
        }
    },

    watch: {
        '$page.props.flash': {
            immediate: true,
            handler(newFlash) {
                if (newFlash) {
                    if (newFlash.success) {
                        this.show = true;
                        this.message = newFlash.success;
                        this.alertClass = 'success';
                    } else if (newFlash.error) {
                        this.show = true;
                        this.message = newFlash.error;
                        this.alertClass = 'danger';
                    } else if (newFlash.warning) {
                        this.show = true;
                        this.message = newFlash.warning;
                        this.alertClass = 'warning';
                    } else if (newFlash.info) {
                        this.show = true;
                        this.message = newFlash.info;
                        this.alertClass = 'info';
                    } else {
                        this.show = false;
                    }
                    this.flash = newFlash;
                    this.startFadeOut();
                }
            },
        },
    },

    mounted() {
        // Adiciona o console log após o DOM ser montado
        console.log(this.$page.props.flash);
    },

    methods: {
        closeMessage() {
            this.show = false;
            clearTimeout(this.timeout); // Limpa o temporizador quando o usuário fecha manualmente
        },
        startFadeOut() {
            // Inicia o temporizador para aplicar o fade-out antes de esconder a mensagem
            clearTimeout(this.timeout); // Limpa qualquer temporizador anterior
            this.isFading = false; // Reseta o estado de fade
            this.timeout = setTimeout(() => {
                this.isFading = true; // Adiciona a classe de fade-out
                setTimeout(() => {
                    this.show = false; // Esconde a mensagem após o fade-out
                }, 1000); // Espera o tempo da transição CSS
            }, 10000); // Mostra a mensagem por 6 segundos antes de iniciar o fade
        }
    },
}
</script>

<style scoped>
.fade-out {
    opacity: 0;
    transition: opacity 1s ease-out; /* Transição suave de 1 segundo */
}
</style>
