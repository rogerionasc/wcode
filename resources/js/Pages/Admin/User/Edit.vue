<template>
  <div class="modal fade" id="editUser" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                  <input v-model="user.first_name" type="text" class="form-control" name="first-name" placeholder="Seu primeiro nome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Sobrenome</label>
                  <input v-model="user.last_name" type="text" class="form-control" name="last-name" placeholder="Seu sobrenome">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">CPF</label>
                  <input v-model="user.document" type="text" class="form-control" name="cpf" placeholder="xxx.xxx.xxx-xx">
                  <small class="invalid-feedback"></small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">Cargo/Função</label>
                  <!-- <input type="text" class="form-control" name="position"> -->
                  
                  <select v-model="user.title_role" class="form-select">
                      <option v-for="role in roles" :key="role.tag_permission" :value="role.title">
                        {{ role.title }}
                      </option>
                    </select>
                   
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
                    <input v-model="user.birth_date" type="text" class="form-control" placeholder="Selecione uma data" id="datepicker-edit-user">

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
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon me-2 icon-tabler icons-tabler-outline icon-tabler-user-cog"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" /><path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19.001 15.5v1.5" /><path d="M19.001 21v1.5" /><path d="M22.032 17.25l-1.299 .75" /><path d="M17.27 20l-1.3 .75" /><path d="M15.97 17.25l1.3 .75" /><path d="M20.733 20l1.3 .75" /></svg>
                    Conta
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="#tabs-permission-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon me-2 icon-tabler icons-tabler-outline icon-tabler-lock"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" /><path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" /><path d="M8 11v-4a4 4 0 1 1 8 0v4" /></svg>
                    Permissão
                  </a>
                </li>
              </ul>
            </div>
            <div class="card-body px-0">
              <div class="tab-content">
                <div class="tab-pane active show" id="tabs-address-1" role="tabpanel">
                  <div class="modal-header">
                    <h5 class="modal-title">Informação de endereço</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-lg-5">
                        <div class="mb-3">
                          <label class="form-label">CEP</label>
                          <input type="text" class="form-control" autocomplete="on" name="street_address" placeholder="CEP">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="mb-3">
                          <label class="form-label">Logradouro</label>
                          <input type="text" class="form-control" autocomplete="on" name="street_address" placeholder="Logadouro (Ex: Rua nove)">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="mb-3">
                          <label class="form-label">Numero</label>
                          <input type="text" class="form-control" autocomplete="on" name="number" placeholder="Numero">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Bairro</label>
                          <input type="text" class="form-control" name="neighborhood" placeholder="Bairo">
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Cidade</label>
                          <input type="text" class="form-control" autocomplete="on" name="city" placeholder="Cidade">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Estado</label>
                          <input type="text" class="form-control" autocomplete="on" name="state" placeholder="Estado">
                        </div>
                      </div> 
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Complemento</label>
                          <input type="text" class="form-control" autocomplete="on" name="complement" placeholder="Complemento">
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
                          <input v-model="user.email" type="email" class="form-control" name="account-name" placeholder="Seu email">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Status</label>
                          <select v-model="user.status" class="form-select">
                            <option value="active" selected>Ativo</option>
                            <option value="inactive">Inativo</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label class="form-label">Alterar senha</label>
                          <div class="input-group">
                            <input type="password" class="form-control">
                            <button type="button" class="btn">Mostrar</button>
                            
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane" id="tabs-permission-3" role="tabpanel">
                  <div class="modal-header">
                    <h5 class="modal-title">Permissões da conta</h5>
                  </div>
                  <div class="modal-body">
                    <div class="row form-fieldset">
                      <label class="col-3 col-form-label pt-0">Usuário</label>
                      <div class="col">
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Ler</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-label">Escrever</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Editar</span>
                        </label>
                      </div>
                    </div>
                    <div class="row form-fieldset">
                      <label class="col-3 col-form-label pt-0">Financeiro</label>
                      <div class="col">
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Ler</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-label">Escrever</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Editar</span>
                        </label>
                      </div>
                    </div>
                    <div class="row form-fieldset">
                      <label class="col-3 col-form-label pt-0">Configuração</label>
                      <div class="col">
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Ler</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-label">Escrever</span>
                        </label>
                        <label class="form-check">
                          <input class="form-check-input" type="checkbox" checked="">
                          <span class="form-check-label">Editar</span>
                        </label>
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
import { onMounted, ref } from 'vue';
import Litepicker from 'litepicker';
import 'litepicker/dist/css/litepicker.css';
import axios from 'axios';

const props = defineProps(['user', 'updateTable']);
const roles = ref([]);

onMounted(() => {
  fetchRoles();
  console.log(props.user);
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
              props.user.birth_date = date.format("DD/MM/YYYY");
            });
        }
    });
});

const fetchRoles = async () => {
  try {
    const response = await axios.get('/getAll/fetchRoles');
    roles.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar cargos:', error);
  }
};


</script>

<style scoped>
/* Adicione seus estilos aqui */
</style>
