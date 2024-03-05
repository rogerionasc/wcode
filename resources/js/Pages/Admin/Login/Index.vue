<template>
    <div>
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="" class="navbar-brand navbar-brand-autodark"><img src="" height="36" alt=""></a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">Faça seu login</h2>
                        <form @submit.prevent="auth" autocomplete="off" novalidate>
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input v-model="form.email" type="email" class="form-control" autocomplete="on" placeholder="Seu email">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Senha</label>
                                <div class="input-group input-group-flat">
                                    <input v-model="form.password" type="password" autocomplete="on" class="form-control"
                                           placeholder="Sua senha">
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Mostrar sua senha"
                                           data-bs-toggle="tooltip">
                                        <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                                 viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                                 stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"/><path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6"/>
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            <span class="form-label-description my-2">
                                <a href="./forgot-password.html">Esqueceu sua senha?</a>
                            </span>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">Entrar</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center text-muted mt-3">
                    Não tem conta? <a href="./sign-up.html" tabindex="-1">Cadastrar</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    email: '',
    password: '',
});
const auth = () => {
    form.post('login');
}

</script>
