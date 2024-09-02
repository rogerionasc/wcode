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
                  <input type="text" class="form-control" name="example-text-input" placeholder="Seu primeiro nome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Sobrenome</label>
                  <input type="text" class="form-control" name="example-text-input" placeholder="Seu sobrenome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">CPF</label>
                  <input type="text" class="form-control" name="example-text-input" placeholder="xxx.xxx.xxx-xx">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">Cargo/Função</label>
                  <input type="text" class="form-control" name="example-text-input">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-12">
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
                    <input class="form-control" placeholder="Selecione uma data" id="datepicker-edit-user" value="2020-06-20">
                  </div>
                </div>
              </div>
            </div>
          </div>




          <div class="card">
                  <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">

                      <li class="nav-item" role="presentation">
                        <a href="#tabs-address-1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                          Endereço</a>
                      </li>
                      
                      <li class="nav-item" role="presentation">
                        <a href="#tabs-account-2" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <!-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg> -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 21v-6a2 2 0 0 1 2 -2h1.6" /><path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4.159" /><path d="M18 18m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M18 14.5v1.5" /><path d="M18 20v1.5" /><path d="M21.032 16.25l-1.299 .75" /><path d="M16.27 19l-1.3 .75" /><path d="M14.97 16.25l1.3 .75" /><path d="M19.733 19l1.3 .75" /></svg>
                          Conta</a>
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
                                <input type="password" class="form-control" autocomplete="on" name="password-input" placeholder="Digite sua senha">
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <label class="form-label">Confirme sua senha</label>
                                <input type="text" class="form-control" name="example-text-input" placeholder="Confirme sua senha">
                              </div>
                            </div>
                            <div class="col-lg-4">
                              <div class="mb-3">
                                <label class="form-label">Confirme sua senha</label>
                                <input type="text" class="form-control" name="example-text-input" placeholder="Confirme sua senha">
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
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label class="form-label">Senha</label>
                                <input type="password" class="form-control" autocomplete="on" name="password-input" placeholder="Digite sua senha">
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="mb-3">
                                <label class="form-label">Confirme sua senha</label>
                                <input type="text" class="form-control" name="example-text-input" placeholder="Confirme sua senha">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-header">
                          <h5 class="modal-title">Tipo de conta</h5>
                        </div>
                        <div class="modal-body">
                          <div class="row">
                            <div class="col-lg-12">
                              <div class="form-selectgroup-boxes row row-deck">
                            <div class="col-lg-3">
                              <label class="form-selectgroup-item">
                                <input type="radio" name="report-type" value="1" class="form-selectgroup-input card" checked>
                                <span class="form-selectgroup-label d-flex align-items-center flex-grow-1 p-3">
                                  <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                  </span>
                                  <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">Padrão</span>
                                    <span class="d-block text-muted">Conta Padrão realiza tarefas básicas como ler, gravar e editar informações, de forma limitada.</span>
                                  </span>
                                </span>
                              </label>
                            </div>
                            <div class="col-lg-3">
                              <label class="form-selectgroup-item flex-grow-1">
                                <input type="radio" name="report-type" value="1" class="form-selectgroup-input">
                                <span class="form-selectgroup-label d-flex align-items-center p-3">
                                  <span class="me-3">
                                    <span class="form-selectgroup-check"></span>
                                  </span>
                                  <span class="form-selectgroup-label-content">
                                    <span class="form-selectgroup-title strong mb-1">Administrador</span>
                                    <span class="d-block text-muted">Conta Administrador possui privilégios especiais, responsável por gerenciar e configurar o sistema.</span>
                                  </span>
                                </span>
                              </label>
                            </div>
                          </div>

                            </div>
                          </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar mudanças</button>
          <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import Litepicker from 'litepicker';

onMounted(() => {
  new Litepicker({
    element: document.getElementById('datepicker-edit-user'),
    buttonText: {
      previousMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
      nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg>`,
    },
  });
});
</script>
