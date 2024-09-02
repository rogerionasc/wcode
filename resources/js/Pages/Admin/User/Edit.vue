<template>
  <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Editar Usuário</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Nome</label>
                  <input type="text" class="form-control" name="first-name" placeholder="Seu primeiro nome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Sobrenome</label>
                  <input type="text" class="form-control" name="last-name" placeholder="Seu sobrenome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">CPF</label>
                  <input type="text" class="form-control" name="cpf" placeholder="xxx.xxx.xxx-xx">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">Cargo/Função</label>
                  <input type="text" class="form-control" name="position">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
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
                    <input type="text" class="form-control" placeholder="Selecione uma data" id="datepicker-edit-user">

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="#tabs-address-1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                      <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                      <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                    </svg>
                    Endereço
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="#tabs-account-2" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                      <path d="M9 21v-6a2 2 0 0 1 2 -2h1.6"></path>
                      <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4.159"></path>
                      <path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"></path>
                      <path d="M18 14.5v1.5"></path>
                      <path d="M18 20v1.5"></path>
                      <path d="M21.032 16.25l-1.299 .75"></path>
                      <path d="M16.27 19l-1.3 .75"></path>
                      <path d="M14.97 16.25l1.3 .75"></path>
                      <path d="M19.733 19l1.3 .75"></path>
                    </svg>
                    Conta
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div class="tab-pane active show" id="tabs-address-1" role="tabpanel">
                  <div class="modal-header">
                    <h5 class="modal-title">Informação de endereço</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="mb-3">
                          <label class="form-label">Email</label>
                          <input type="email" class="form-control" autocomplete="on" name="email" placeholder="Seu email">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Situação</label>
                          <select class="form-select">
                            <option value="active" selected>Ativo</option>
                            <option value="inactive">Inativo</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Senha</label>
                          <input type="password" class="form-control" autocomplete="on" name="password" placeholder="Digite sua senha">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Confirme sua senha</label>
                          <input type="password" class="form-control" name="confirm-password" placeholder="Confirme sua senha">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-account-2" role="tabpanel">
                  <div class="modal-header">
                    <h5 class="modal-title">Informação de conta</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-8">
                        <div class="mb-3">
                          <label class="form-label">Nome</label>
                          <input type="text" class="form-control" name="account-name" placeholder="Seu nome completo">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Tipo de conta</label>
                          <select class="form-select">
                            <option value="admin" selected>Admin</option>
                            <option value="user">Usuário</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Descrição</label>
                          <textarea class="form-control" name="account-description" rows="4" placeholder="Descreva a conta"></textarea>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Observações</label>
                          <textarea class="form-control" name="account-notes" rows="4" placeholder="Adicione observações adicionais"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Salvar alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import Litepicker from 'litepicker';
import 'litepicker/dist/css/litepicker.css';

onMounted(() => {
    const datePicker = new Litepicker({
        element: document.getElementById('datepicker-edit-user'),
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

<style scoped>
/* Adicione seus estilos aqui */
</style>
