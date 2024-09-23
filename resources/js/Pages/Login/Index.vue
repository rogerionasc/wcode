<template>
    <div>
        <!-- Exibe o PageLoader se 'isLoading' for verdadeiro -->
        <PageLoader v-if="isLoading" />
        <!-- Exibe o formulário de login se 'isLoading' for falso -->
        <div v-else class="page page-center d-flex align-items-center justify-content-center min-vh-100">
            <div class="container container-normal py-6">
                <div class="row align-items-center g-4">
                    <div class="col-lg">
                        <div class="container-tight">
                            <FlashMessage class="mb-2"/>
                            <div class="card card-md">
                                <div class="card-body">
                                    <div class="text-center mb-4">
                                        <a href="." class="navbar-brand navbar-brand-autodark">
                                            <img src="../../../img/Logo250x250.svg" height="56" alt="Logo">
                                            <img src="../../../img/LogoName210x500.svg" height="56" alt="Logo Name">
                                        </a>
                                    </div>

                                    <form @submit.prevent="auth" autocomplete="off" novalidate>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" v-model="form.email" type="email" class="form-control" autocomplete="email" placeholder="Seu email.">
                                        </div>
                                        <div class="mb-2">
                                            <label for="password" class="form-label">
                                                Senha
                                                <span class="form-label-description"><a href="#">Esqueceu sua senha?</a></span>
                                            </label>
                                            <div class="input-group input-group-flat">
                                                <input :type="showPassword ? 'text' : 'password'" v-model="form.password" id="password" class="form-control" autocomplete="current-password" placeholder="Sua senha.">
                                                <span class="input-group-text">
                                                    <a href="#" class="link-secondary" title="Mostar senha" @click.prevent="togglePasswordVisibility">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/>
                                                            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                                                        </svg>
                                                    </a>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-footer mt-6">
                                            <button type="submit" class="btn btn-primary w-100">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg d-none d-lg-block">
                        <img src="../../../img/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto" alt="Secure Login">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import FlashMessage from "@/Components/FlashMessage.vue";
import PageLoader from "@/Pages/Loader/PageLoader.vue"; // Certifique-se de que o caminho está correto

const form = useForm({
    email: '',
    password: '',
});

const isLoading = ref(false); // Estado para controlar a exibição do PageLoader
const showPassword = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const auth = () => {
    isLoading.value = true; // Inicia o PageLoader

    // Faz o post do formulário para a rota de login
    form.post('login', {
        onFinish: () => {
            setTimeout(() => {
                isLoading.value = false; // Para de exibir o PageLoader
            }, 0); // Tempo de exibição do PageLoader antes do redirecionamento
        },
    });
};
</script>

<style scoped>
/* Assegura que o container pai ocupa toda a altura da tela */
.page-center {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}
</style>
