<template>
    <div class="modal modal-blur fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="store">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Nome</label>
                                    <input v-model="form.first_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.first_name }"
                                           name="example-text-input"
                                           placeholder="Seu primeiro nome">
                                    <small class="invalid-feedback" >{{$page.props.errors.first_name}}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Sobrenome</label>
                                    <input v-model="form.last_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.last_name }"
                                           name="example-text-input"
                                           placeholder="Seu sobrenome">
                                    <small class="invalid-feedback" >{{$page.props.errors.last_name}}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">CPF</label>
                                    <input v-model="form.document" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.document }"
                                           name="example-text-input"
                                           placeholder="00.000.000-00">
                                    <small class="invalid-feedback" >{{$page.props.errors.document}}</small>
<!--                                    <input v-model="form.document" @input="formatCPF" type="text" class="form-control" name="example-text-input"-->
<!--                                           placeholder="00.000.000-00">-->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-header">
                        <h5 class="modal-title">Informação da conta</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input v-model="form.email" @input="validateEmail" type="email"
                                           class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.email }"
                                           autocomplete="on" name="email" placeholder="Seu email">
                                    <small class="invalid-feedback" >{{$page.props.errors.email}}</small>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Situação</label>
                                    <select class="form-select" v-model="form.status">
                                        <option value="active" selected>Ativo</option>
                                        <option value="inactive">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 ">
                                <div class="mb-3">
                                    <label class="form-label">Senha</label>
                                    <input v-model="form.password" type="password" class="form-control"
                                           autocomplete="on"
                                           name="password-input"
                                           placeholder="Digite sua senha">
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Confirme sua senha</label>
                                    <input type="text" class="form-control" name="example-text-input"
                                           placeholder="Confirme sua senha">
                                </div>
                            </div>

                        </div>
                        <label class="form-label">Tipo de conta</label>
                        <div class="form-selectgroup-boxes row row-deck">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="report-type" value="1"
                                           class="form-selectgroup-input card" checked>
                                    <span class="form-selectgroup-label d-flex align-items-center flex-grow-1 p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check">
                                                </span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Padrão</span>
                                                <span class="d-block text-muted">
                                                    Conta Padrão realiza tarefas básicas como ler, gravar e editar
                                                    informações, de forma limitada.

                                                </span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item flex-grow-1">
                                    <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                            <span class="me-3">
                                                <span class="form-selectgroup-check"></span>
                                            </span>
                                            <span class="form-selectgroup-label-content">
                                                <span class="form-selectgroup-title strong mb-1">Administrador</span>
                                                <span class="d-block text-muted">
                                                    Conta administradora possui privilégios especiais, responsável por
                                                    gerenciar e configurar o sistema.
                                                </span>
                                            </span>
                                        </span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { Head, Inertia, useForm } from "@inertiajs/inertia-vue3";
import jquery from "jquery";
import 'datatables.net-bs5';
import ButtonCreate from "@/Components/ButtonCreate.vue";
import Layout from "@/Layouts/Layout.vue";
import mix from "@/mix.js"; // Se precisar das validações de CPF/Email

// Funções e variáveis relacionadas às validações
const { validateCPF, validateEmailFormat } = mix.methods;

const emit = defineEmits(['updateTable']);

// Função para formatar CPF
const formatCPF = (event) => {
    let cpf = event.target.value.replace(/\D/g, '');

    if (cpf.length !== 11) {
        cpf = cpf.slice(0, 11);
    }

    if (validateCPF(cpf)) {
        const formattedCPF = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        form.document = formattedCPF;
        event.target.classList.remove('is-invalid');
    } else {
        form.document = cpf;
        event.target.classList.add('is-invalid');
    }
}

// Função para validar Email
const validateEmail = (event) => {
    const email = event.target.value;

    if (validateEmailFormat(email)) {
        event.target.classList.remove('is-invalid');
    } else {
        event.target.classList.add('is-invalid');
    }
}

// Formulário de criação de usuário
const form = useForm({
    first_name: '',
    last_name: '',
    document: '',
    email: '',
    password: '',
    status: 'active',
});

// Função para criar um novo usuário


const store = () => {
    form.post('/admin/user', {
        onSuccess: () => {
            emit('updateTable');
        }
    });
};
</script>
