<template>
  <div class="modal modal-blur fade" id="editUser" tabindex="-2" aria-labelledby="editUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
              <h5 class="modal-title me-2">Editar Usuário</h5>
              <span class="me-2">&gt;</span>
              <span class="badge mb-0 "> {{ user.first_name }} {{ user.last_name }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form @submit.prevent="updateUser">
          <div class="modal-body pb-0">
            <div class="row">
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Nome</label>
                  <input v-model="formUpdate.first_name" type="text" class="form-control" name="first-name"
                  :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.first_name }"
                  placeholder="Seu primeiro nome">
                  <small v-if="formUpdate.errors.update && formUpdate.errors.update.first_name"
                  class="invalid-feedback">{{ formUpdate.errors.update.first_name }}</small>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label class="form-label">Sobrenome</label>
                  <input v-model="formUpdate.last_name" type="text" class="form-control" name="last-name"
                  :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.last_name }"
                  placeholder="Seu sobrenome">
                  <small v-if="formUpdate.errors.update && formUpdate.errors.update.last_name"
                  class="invalid-feedback">{{ formUpdate.errors.update.last_name }}</small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">CPF</label>
                  <input v-model="formUpdate.document" type="text" class="form-control" name="cpf"
                  :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.document }"
                  placeholder="xxx.xxx.xxx-xx">
                  <small v-if="formUpdate.errors.update && formUpdate.errors.update.document"
                  class="invalid-feedback">{{ formUpdate.errors.update.document }}</small>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">Cargo/Função</label>
                  <select v-model="formUpdate.title_role" class="form-select">
                    <option v-for="role in roles" :key="role.tag_permission" :value="role.title">
                      {{ role.title }}
                    </option>
                  </select>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="mb-4">
                  <label class="form-label">Nascimento</label>
                  <Datepicker :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.birth_date }"
                  class="custom-date" v-model="formUpdate.birth_date" />
                  <small v-if="formUpdate.errors.update && formUpdate.errors.update.birth_date"
                  class="invalid-feedback">{{ formUpdate.errors.update.birth_date }}</small>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <div class="card-header">
              <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
                <li class="nav-item" role="presentation">
                  <a href="#tabs-address-1" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
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
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-tabler icons-tabler-outline icon-tabler-user-cog">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"/>
                      <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5"/>
                      <path d="M19.001 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
                      <path d="M19.001 15.5v1.5"/>
                      <path d="M19.001 21v1.5"/>
                      <path d="M22.032 17.25l-1.299 .75"/>
                      <path d="M17.27 20l-1.3 .75"/>
                      <path d="M15.97 17.25l1.3 .75"/>
                      <path d="M20.733 20l1.3 .75"/>
                    </svg>
                    Conta
                  </a>
                </li>
                <li class="nav-item" role="presentation">
                  <a href="#tabs-permission-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2 icon-tabler icons-tabler-outline icon-tabler-lock">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"/>
                      <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"/>
                      <path d="M8 11v-4a4 4 0 1 1 8 0v4"/>
                    </svg>
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
                          <input v-if="user.address" v-model="user.address.post_code" :class="{ 'is-invalid': cepError }"
                          type="text" class="form-control" autocomplete="on" id="post_code" name="post_code" placeholder="CEP" @blur="searchCEP">
                          <small v-if="cepError" class="invalid-feedback">{{ cepError }}</small>
                        </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="mb-3">
                          <label class="form-label">Logradouro</label>
                          <input v-if="user.address" v-model="user.address.street" type="text" class="form-control"
                          autocomplete="on" id="street" name="street" placeholder="Logradouro (Ex: Rua nove)">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-2">
                        <div class="mb-3">
                          <label class="form-label">Número</label>
                          <input v-if="user.address" v-model="user.address.number" type="text" class="form-control"
                          autocomplete="on" id="number" name="number" placeholder="Número">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Bairro</label>
                          <input v-if="user.address" v-model="user.address.neighborhood" type="text" class="form-control"
                          id="neighborhood" name="neighborhood" placeholder="Bairro">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Cidade</label>
                          <input disabled v-if="user.address" v-model="user.address.city" type="text" class="form-control"
                          autocomplete="on" id="city" name="city" placeholder="Cidade">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Estado</label>
                          <input disabled v-if="user.address" v-model="user.address.state" type="text" class="form-control"
                          autocomplete="on" id="state" name="state" placeholder="Estado">
                          <small class="invalid-feedback"></small>
                        </div>
                      </div>
                      <div class="col-lg-12">
                        <div class="mb-3">
                          <label class="form-label">Complemento</label>
                          <input v-if="user.address" v-model="user.address.complement" type="text" class="form-control"
                          autocomplete="on" id="complement" name="complement" placeholder="Complemento">
                          <small class="invalid-feedback"></small>
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
                          <input :class="{ 'is-invalid': formUpdate.errors.update && formUpdate.errors.update.email }"
                          v-model="formUpdate.email" type="email" class="form-control" name="account-name" placeholder="Seu email">
                          <small v-if="formUpdate.errors.update && formUpdate.errors.update.email"
                          class="invalid-feedback">{{formUpdate.errors.update.email}}</small>
                        </div>
                      </div>
                      <div class="col-lg-4">
                        <div class="mb-3">
                          <label class="form-label">Status</label>
                          <select v-model="formUpdate.status" class="form-select">
                            <option value="active" selected>Ativo</option>
                            <option value="inactive">Inativo</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="mb-3">
                          <label class="form-label">Alterar senha</label>
                          <div class="input-group">
                            <input
                            v-model="formUpdate.password"
                            :type="showPassword ? 'text' : 'password'" type="password" class="form-control">
                            <button @click="togglePassword" type="button" class="btn">{{ showPassword ? 'Ocultar' : 'Mostrar' }}</button>
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
            <button type="button" class="btn" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" data-bs-dismiss="modal" class="btn btn-primary">Salvar alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import axios from 'axios';
import Datepicker from '@/Components/Datepicker.vue';

const emit = defineEmits(['updateTable']);
const showPassword = ref(false);
const props = defineProps(['user']);
const roles = ref([]);
const cepError = ref('');

function togglePassword() {
  showPassword.value = !showPassword.value;
}

onMounted(() => {
  fetchRoles();
});

const formUpdate = useForm({
  first_name: '',
  last_name: '',
  document: '',
  birth_date: '',
  role: '',
  title_role: '',
  email: '',
  password: '',
  status: '',
  address: {}, // Inclua o endereço, se necessário
});

watch(() => props.user, (newUser) => {
  formUpdate.errors.update = {};
  formUpdate.first_name = newUser.first_name;
  formUpdate.last_name = newUser.last_name;
  formUpdate.document = newUser.document;
  formUpdate.birth_date = newUser.birth_date;
  formUpdate.role = newUser.role;
  formUpdate.title_role = newUser.title_role;
  formUpdate.email = newUser.email;
  formUpdate.password = newUser.password;
  formUpdate.status = newUser.status;
}, { immediate: true });

watch(() => formUpdate.title_role, (newTitleRole) => {
  const selectedRole = roles.value.find(role => role.title === newTitleRole);
  if (selectedRole) {
    formUpdate.role = selectedRole.tag_permission;
  }
});

const fetchRoles = async () => {
  try {
    const response = await axios.get('/admin/roles/fetchRoles');
    roles.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar cargos:', error);
  }
};

async function searchCEP(event) {
  const cepInput = props.user.address.post_code;
  const cep_cidade = cepInput.replace('-', '');

  if (!cep_cidade) {
    cepError.value = 'Por favor, insira um CEP.';
    event.target.classList.add('is-invalid');
    return;
  }

  try {
    const response = await fetch(`https://brasilapi.com.br/api/cep/v1/${cep_cidade}`);
    if (!response.ok) {
      cepError.value = 'CEP não encontrado.';
      event.target.classList.add('is-invalid');
      return;
    }

    const data = await response.json();
    props.user.address.street = data.street || props.user.address.street;
    props.user.address.neighborhood = data.neighborhood || props.user.address.neighborhood;
    props.user.address.city = data.city || props.user.address.city;
    props.user.address.state = data.state || props.user.address.state;
    props.user.address.complement = data.complement || props.user.address.complement;
    
    cepError.value = '';
    event.target.classList.remove('is-invalid');
    
  } catch (error) {
    console.error(error);
    cepError.value = 'Não foi possível obter os dados do CEP.';
    event.target.classList.add('is-invalid');
  }
}

async function updateUser() {
  try {
    formUpdate.put(`/admin/user/update/${props.user.id}`, {
      onSuccess: () => {
        emit('updateTable');
      },
      onError: () => {
        console.log(formUpdate.errors.update);
        $('#editUser').modal('show');
      }
    });
  } catch (error) {
    console.error(error);
  }
}
</script>

<style scoped>
</style>
