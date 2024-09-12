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
                                    <label class="form-label required">Nome</label>
                                    <input v-model="form.first_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.first_name }"
                                           name="first_name"
                                           placeholder="Seu primeiro nome">
                                    <small class="invalid-feedback" >{{$page.props.errors.first_name}}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Sobrenome</label>
                                    <input v-model="form.last_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.last_name }"
                                           name="last_name"
                                           placeholder="Seu sobrenome">
                                    <small class="invalid-feedback" >{{$page.props.errors.last_name}}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">CPF</label>
                                    <input v-model="form.document" @input="formatCPF" type="text" class="form-control"
                                           :class="{ 'is-invalid': $page.props.errors.document }"
                                           name="document"
                                           placeholder="00.000.000-00">
                                    <small class="invalid-feedback" >{{$page.props.errors.document}}</small>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nascimento</label>
                                    <div class="input-icon">
                                        <span class="input-icon-addon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"></path>
                                                <path d="M16 3v4"></path>
                                                <path d="M8 3v4"></path>
                                                <path d="M4 11h16"></path>
                                                <path d="M11 15h1"></path>
                                                <path d="M12 15v3"></path>
                                            </svg>
                                        </span>
                                        <input v-model="form.birth_date" type="text" class="form-control" placeholder="Selecione uma data" id="datepicker-create-user" autocomplete="off" data-date-format="mm/dd/yyyy">
                                    
                                    </div>
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
                                    <label class="form-label required">Email</label>
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
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Senha</label>
                                    <input v-model="form.password" type="password" class="form-control"
                                           autocomplete="on"
                                           name="password-input"
                                           :class="{ 'is-invalid': $page.props.errors.password }"
                                           placeholder="Digite sua senha">
                                    <small class="invalid-feedback">{{$page.props.errors.password}}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Confirme sua senha</label>
                                    <input v-model="form.confirmPassword" type="password" class="form-control" name="confirm-password"
                                           :class="{ 'is-invalid': $page.props.errors.confirmPassword }"
                                           placeholder="Confirme sua senha">
                                    <small class="invalid-feedback">{{$page.props.errors.confirmPassword}}</small>
                                </div>
                            </div>
                        </div>
                        <label class="form-label">Tipo de conta</label>
                        <div class="form-selectgroup-boxes row row-deck">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="account-type" value="standard"
                                           class="form-selectgroup-input card" checked>
                                    <span class="form-selectgroup-label d-flex align-items-center flex-grow-1 p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Padrão</span>
                                            <span class="d-block text-muted">
                                                Conta Padrão realiza tarefas básicas como ler, gravar e editar informações, de forma limitada.
                                            </span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item flex-grow-1">
                                    <input type="radio" name="account-type" value="admin" class="form-selectgroup-input">
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Administrador</span>
                                            <span class="d-block text-muted">
                                                Conta Administrador possui privilégios especiais, responsável por gerenciar e configurar o sistema.
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
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import Litepicker from 'litepicker';
import mix from "@/mix.js"; // Se precisar das validações de CPF/Email

const { validateCPF, validateEmailFormat } = mix.methods;

const emit = defineEmits(['updateTable']);


const form = useForm({
    first_name: '',
    last_name: '',
    document: '',
    email: '',
    password: '',
    confirmPassword: '',
    birth_date: '',
    status: 'active',
});

// Função para criar um novo usuário
const store = () => {
    form.post('/admin/user/store', {
        onSuccess: () => {
            emit('updateTable');
        }
    });
};

// Função para formatar CPF
const formatCPF = (event) => {
    let cpf = event.target.value.replace(/\D/g, '');

    if (cpf.length > 11) {
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

onMounted(() => {
    // console.log(props.errors);
   
    const datePicker = new Litepicker({
        element: document.getElementById('datepicker-create-user'),
        format: "DD/MM/YYYY",
        lang: "pt-BR",
        singleMode: true,
        buttonText: {
            previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
            nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
        },
        setup: (picker) => {
            picker.on('selected', (date) => {
                form.birth_date = date.format("DD/MM/YYYY");
            });
        }
    });
});

</script>
