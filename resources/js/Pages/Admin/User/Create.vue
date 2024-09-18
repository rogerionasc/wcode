<template>
    <div v-if="!isVisibleModal" class="modal modal-blur fade" id="modalCreateUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Novo usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form @submit.prevent="store">
                    <div class="modal-body pb-0">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Nome</label>
                                    <input v-model="formCreate.first_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.first_name }"
                                           name="first_name" placeholder="Seu primeiro nome">
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.first_name"
                                    class="invalid-feedback">{{ formCreate.errors.created.first_name }}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Sobrenome</label>
                                    <input v-model="formCreate.last_name" type="text" class="form-control"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.last_name }"
                                           name="last_name" placeholder="Seu primeiro nome">
                                        <small v-if="formCreate.errors.created && formCreate.errors.created.last_name"
                                        class="invalid-feedback">{{ formCreate.errors.created.last_name }}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">CPF</label>
                                    <input v-model="formCreate.document" @input="formatCPF" type="text" class="form-control"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.document }"
                                           name="document" placeholder="00.000.000-00">
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.document"
                                    class="invalid-feedback">{{ formCreate.errors.created.document }}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Nascimento</label>
                                    <Datepicker :class="{'is-invalid': formCreate.errors.created && formCreate.errors.created.birth_date}" 
                                    class="custom-date" v-model="formCreate.birth_date"/>
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.birth_date"
                                    class="invalid-feedback">{{ formCreate.errors.created.birth_date }}</small>
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
                                    <input v-model="formCreate.email" @input="validateEmail" type="email"
                                           class="form-control"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.email }"
                                           autocomplete="on" name="email" placeholder="Seu email">
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.email"
                                    class="invalid-feedback">{{ formCreate.errors.created.email }}</small>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Situação</label>
                                    <select class="form-select" v-model="formCreate.status">
                                        <option value="active" selected>Ativo</option>
                                        <option value="inactive">Inativo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Senha</label>
                                    <input v-model="formCreate.password" type="password" class="form-control"
                                           autocomplete="on" name="password-input"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.password }"
                                           placeholder="Digite sua senha">
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.password"
                                    class="invalid-feedback">{{ formCreate.errors.created.password }}</small>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Confirme sua senha</label>
                                    <input v-model="formCreate.confirmPassword" type="password" class="form-control" 
                                           name="confirm-password"
                                           :class="{ 'is-invalid': formCreate.errors.created && formCreate.errors.created.confirmPassword }"
                                           placeholder="Confirme sua senha">
                                    <small v-if="formCreate.errors.created && formCreate.errors.created.confirmPassword"
                                    class="invalid-feedback">{{ formCreate.errors.created.confirmPassword }}</small>
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
import { onMounted, ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import Datepicker from '@/Components/Datepicker.vue';
import mix from "@/mix.js"; // Se precisar das validações de CPF/Email

const { validateCPF, validateEmailFormat } = mix.methods;

const emit = defineEmits(['updateTable']);

const isVisibleModal = ref(false);

const formCreate = useForm({
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
    formCreate.post('/admin/user/store', {
        onSuccess: () => {
            emit('updateTable');
        },
        onError: () => {
            $('#modalCreateUser').modal('show');
            console.log(formCreate.errors.created); // Loga o objeto inteiro de erros
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
        formCreate.document = formattedCPF;
        event.target.classList.remove('is-invalid');
    } else {
        formCreate.document = cpf;
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

});
</script>

<style>

</style>
