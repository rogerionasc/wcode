<template>
  <h2>Permissões</h2>
  <div class="row">
    <div class="col">
      <div class="mb-3">
        <div class="form-label">Cargo/Função</div>
        <select class="form-select" v-model="selectedRoleId" @change="updatePermissions">
          <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}</option>
        </select>
      </div>
      <div v-if="selectedRoleId !== null" class="row form-fieldset">
        <div class="col d-flex justify-content-center align-items-center">
          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-ghost-success btn-circle" style="width: 19px; height: 19px; border-radius: 50%; padding: 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin: 0; padding: 0;" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus m-0">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
          </a>
        </div>
      </div>
      <div v-if="Object.keys(userPermissions).length > 0">
        <form @submit.prevent="submitPermissions">
          <div v-for="(permissions, category) in userPermissions" :key="category" class="row form-fieldset align-items-center">
            <label class="col-2 col-form-label pb-0 pt-0">{{ category }}</label>
            <div class="col d-flex justify-content-between align-items-center">
              <div class="form-check mb-0" style="flex: 1;">
                <input class="form-check-input" type="checkbox" v-model="permissions.read">
                <span class="form-check-label">Ler</span>
              </div>
              <div class="form-check mb-0" style="flex: 1;">
                <input class="form-check-input" type="checkbox" v-model="permissions.write">
                <span class="form-check-label">Escrever</span>
              </div>
              <div class="form-check mb-0" style="flex: 1;">
                <input class="form-check-input" type="checkbox" v-model="permissions.edit">
                <span class="form-check-label">Editar</span>
              </div>
              <div class="form-check mb-0" style="flex: 1;">
                <input class="form-check-input" type="checkbox" v-model="permissions.delete">
                <span class="form-check-label">Excluir</span>
              </div>
            </div>
            <div class="col-auto">
              <a @click.prevent="removePermission(category)" class="btn btn-ghost-danger btn-circle" style="width: 19px; height: 19px; border-radius: 50%; padding: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin: 0; padding: 0;" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                  <path d="M9 12l6 0" />
                </svg>
              </a>
            </div>
          </div>
        </form>
      </div>
      <p v-else>
          Nenhuma permissão atribuída.
        </p>
    </div>
  </div>
  <ModalAddPermissions
    :userPermissions="userPermissions"
    :allPermissions="allPermissions"
    :roleName="selectedRoleName"
    @add-permission="addPermissions"

  />
  <ModalDeletePermissions />
</template>

<script setup>
import { ref, onMounted} from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import ModalAddPermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalAddPermission.vue';
import ModalDeletePermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalDeletePermission.vue';

const roles = ref([]);
const selectedRoleId = ref(null);
const userPermissions = ref({});
const allPermissions = ref({}); // Estrutura para armazenar permissões agrupadas
const selectedRoleName = ref('');

const emit = defineEmits(['toggleLoading']);

const props = defineProps({
  auth: Object
});

// Inicializando o formulário com useForm
const form = useForm({
  role_id: null,
  permissions: {}
});

onMounted(async () => {
  await fetchRoles();  // Certifique-se de esperar a função fetchRoles ser concluída
  fetchAllPermissions();
  
  // Se houver cargos disponíveis, selecione o primeiro
  if (roles.value.length > 0) {
    selectedRoleId.value = roles.value[0].id; // Definindo o ID do primeiro cargo como selecionado
    updatePermissions(); // Chame a função para atualizar as permissões com o novo cargo selecionado
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

const groupPermissionsByCategory = (permissions) => {
  if (!Array.isArray(permissions)) {
    if (permissions && typeof permissions === 'object') {
      permissions = Object.values(permissions);
    } else {
      console.error('As permissões devem ser um array ou objeto.', permissions);
      return {}; // Retorna um objeto vazio se não for um array ou objeto
    }
  }

  return permissions.reduce((grouped, permission) => {
    const [action, subject] = permission.name.split(' ');

    // Verifica se a categoria já existe ou cria uma nova
    const category = permission.category || subject.charAt(0).toUpperCase() + subject.slice(1);

    if (!grouped[category]) {
      grouped[category] = {
        read: false,
        write: false,
        edit: false,
        delete: false,
        subject: subject // Aqui deve ser uma propriedade do objeto da categoria
      };
    }

    // Atualiza as permissões de acordo com a ação
    if (action === 'read') grouped[category].read = true;
    if (action === 'write') grouped[category].write = true;
    if (action === 'update') grouped[category].edit = true;
    if (action === 'delete') grouped[category].delete = true;

    return grouped;
  }, {});
};

const fetchAllPermissions = async () => {
  try {
    const response = await axios.get('/admin/permission/fetchAllPermissions');
    const permissionsData = response.data[0]; // Acessa o primeiro objeto dentro do array

    if (!permissionsData || typeof permissionsData !== 'object') {
      console.error('A resposta da API não contém o formato esperado');
      return;
    }

    // Limpa o objeto allPermissions antes de iniciar a atribuição
    allPermissions.value = {};

    // Agrupa permissões por categoria
    for (const category in permissionsData) {
      if (permissionsData.hasOwnProperty(category)) {
        const categoryPermissions = permissionsData[category];
        // Agrupa permissões
        Object.assign(allPermissions.value, groupPermissionsByCategory(categoryPermissions));
      }
    }
  } catch (error) {
    console.error('Erro ao buscar permissões:', error);
  }
};

// Função para atualizar permissões ao selecionar um cargo
const updatePermissions = () => {
  const selectedRole = roles.value.find(role => role.id === selectedRoleId.value);

  if (selectedRole) {
    selectedRoleName.value = selectedRole.name;
    userPermissions.value = groupPermissionsByCategory(selectedRole.permissions);
    form.role_id = selectedRoleId.value;
    form.permissions = allPermissions.value; // Mantenha os dados atualizados no form
  } else {
    userPermissions.value = {};
  }
};

// Função para desagrupar permissões e remover falsos
const ungroupPermissions = (allPermissions) => {
  const ungroupedPermissions = [];

  Object.keys(allPermissions).forEach(category => {
    const permissions = allPermissions[category];
    if (permissions.read) ungroupedPermissions.push({ name: 'read ' + permissions.subject, category });
    if (permissions.write) ungroupedPermissions.push({ name: 'write ' + permissions.subject, category });
    if (permissions.edit) ungroupedPermissions.push({ name: 'update ' + permissions.subject, category });
    if (permissions.delete) ungroupedPermissions.push({ name: 'delete ' + permissions.subject, category });
  });

  return ungroupedPermissions;
};

// Função para enviar as permissões atualizadas para o backend usando useForm
const submitPermissions = () => {
  if (!selectedRoleId.value) return;

  const preparedPermissions = ungroupPermissions(userPermissions.value);
  form.permissions = preparedPermissions;

  // Emitindo o evento para iniciar o carregamento
  emit('toggleLoading', true);

  form.put(`./permission/update/${selectedRoleId.value}`, {
    onSuccess: () => {
      console.log('Permissões atualizadas com sucesso!');
      // Emitindo o evento para finalizar o carregamento
      emit('toggleLoading', false);
    },
    onError: (errors) => {
      console.error('Erro ao atualizar permissões:', errors);
      // Emitindo o evento para finalizar o carregamento mesmo em caso de erro
      emit('toggleLoading', false);
    }
  });
};

const removePermission = (category) => {
  // Cria um novo objeto sem a categoria que você quer remover
  const newPermissions = { ...userPermissions.value };
  delete newPermissions[category];

  userPermissions.value = newPermissions;
};

const addPermissions = (newPermissions) => {
  // Para cada nova permissão, adiciona ao objeto de permissões do usuário
  for (const category in newPermissions) {
    if (newPermissions.hasOwnProperty(category)) {
      if (!userPermissions.value[category]) {
        // Se a categoria não existir, cria uma nova
        userPermissions.value[category] = newPermissions[category];
      } else {
        // Se a categoria já existir, atualiza as permissões
        userPermissions.value[category].read = userPermissions.value[category].read || newPermissions[category].read;
        userPermissions.value[category].write = userPermissions.value[category].write || newPermissions[category].write;
        userPermissions.value[category].edit = userPermissions.value[category].edit || newPermissions[category].edit;
        userPermissions.value[category].delete = userPermissions.value[category].delete || newPermissions[category].delete;
      }
    }
  }
};

defineExpose({ submitPermissions });
</script>

<style scoped>
.form-fieldset {
  margin-bottom: 1rem;
  padding: 1rem;
  border: 1px solid #ddd;
  border-radius: 0.25rem;
}
</style>
