<template>
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <input v-model="form.first_name" type="text" class="form-control" name="example-text-input"
                                           placeholder="Seu primeiro nome">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">Sobrenome</label>
                                    <input v-model="form.last_name" type="text" class="form-control" name="example-text-input"
                                           placeholder="Seu sobrenome">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label">CPF</label>
                                    <input type="text" class="form-control" name="example-text-input"
                                           placeholder="00.000.000-00">
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
                                    <input v-model="form.email" type="email" class="form-control"
                                           autocomplete="on"
                                           name="email-input"
                                           placeholder="Seu email">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="mb-3">
                                    <label class="form-label">Situação</label>
                                    <select class="form-select">
                                        <option value="ativo" selected>Ativo</option>
                                        <option value="inativo">Inativo</option>
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
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item h-100">
                                    <input type="radio" name="report-type" value="1" class="form-selectgroup-input"
                                           checked>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
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
                                <label class="form-selectgroup-item h-100">
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
import { useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from 'vue';

const name = "ModalCreateUser";
const form = useForm({
    first_name: '',
    last_name: '',
    email: '',
    password: '',
});

const store = () => {
    form.post('/register/user');
}
</script>

