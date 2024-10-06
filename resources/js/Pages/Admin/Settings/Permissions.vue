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
      <div class="row form-fieldset">
        <div class="col d-flex justify-content-center align-items-center">
          <a href="#" data-bs-toggle="modal" data-bs-target="#modal-team" class="btn btn-ghost-success btn-circle" style="width: 19px; height: 19px; border-radius: 50%; padding: 0;">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin: 0; padding: 0;" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus m-0">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
          </a>
        </div>
      </div>
      <div v-if="Object.keys(groupedPermissions).length > 0">
        <form @submit.prevent="submitPermissions">
          <div v-for="(permissions, category) in groupedPermissions" :key="category" class="row form-fieldset align-items-center">
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
    </div>
  </div>
  <ModalAddPermissions
  :groupedPermissions="groupedPermissions" 
  @add-permission="handlePermissionsUpdate"
  :roleName="selectedRoleName"
  />
  <ModalDeletePermissions />
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import ModalAddPermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalAddPermission.vue';
import ModalDeletePermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalDeletePermission.vue';

const roles = ref([]);
const selectedRoleId = ref(null);
const selectedPermissions = ref([]);
const groupedPermissions = ref({});
const selectedRoleName = ref('');

// Inicializando o formulário com useForm
const form = useForm({
  role_id: null,
  permissions: {}
});


// Props
const props = defineProps({
  auth: Object
});

// Hook onMounted
onMounted(() => {
  fetchRoles();
});

// Função para buscar os cargos (roles) do backend
const fetchRoles = async () => {
  try {
    const response = await axios.get('/admin/roles/fetchRoles');
    roles.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar cargos:', error);
  }
};

// Função para atualizar permissões ao selecionar um cargo
const updatePermissions = () => {
  const selectedRole = roles.value.find(role => role.id === selectedRoleId.value);
  
  if (selectedRole) {
    selectedRoleName.value = selectedRole.name;
    selectedPermissions.value = selectedRole.permissions;
    console.log(selectedPermissions.value);
    groupedPermissions.value = groupPermissionsByCategory(selectedPermissions.value);
    form.role_id = selectedRoleId.value;
    form.permissions = groupedPermissions.value; // Mantenha os dados atualizados no form
  } else {
    selectedPermissions.value = [];
    groupedPermissions.value = {};
  }
};

// Função para agrupar permissões por categoria
const groupPermissionsByCategory = (permissions) => {
  return permissions.reduce((grouped, permission) => {
    const [action, subject] = permission.name.split(' ');
    const category = permission.category || 'Sem categoria';

    if (!grouped[category]) {
      grouped[category] = {
        read: false,
        write: false,
        edit: false,
        delete: false,
        subject
      };
    }

    // Atualizamos as permissões com base na ação
    if (action === 'read') grouped[category].read = true;
    if (action === 'write') grouped[category].write = true;
    if (action === 'update') grouped[category].edit = true;
    if (action === 'delete') grouped[category].delete = true;

    return grouped;
  }, {});
};

// Função para desagrupar permissões e remover falsos
const ungroupPermissions = (groupedPermissions) => {
  const ungroupedPermissions = [];

  Object.keys(groupedPermissions).forEach(category => {
    const permissions = groupedPermissions[category];
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

  const preparedPermissions = ungroupPermissions(groupedPermissions.value);
  form.permissions = preparedPermissions;

  form.put(`./permission/update/${selectedRoleId.value}`, {
    onSuccess: () => {
      alert('Permissões atualizadas com sucesso!');
    },
    onError: (errors) => {
      console.error('Erro ao atualizar permissões:', errors);
    }
  });
};

// Função para remover permissão
const removePermission = (category) => {
  // Cria uma nova cópia do objeto de permissões
  const updatedPermissions = { ...groupedPermissions.value };
  // Remove a categoria da cópia
  delete updatedPermissions[category];
  // Atualiza a referência do objeto para que o Vue possa detectar a mudança
  groupedPermissions.value = updatedPermissions;
  
};

const addPermission = (category, newPermissions) => {
  // Cria uma nova cópia do objeto de permissões
  const updatedPermissions = { ...groupedPermissions.value };

  // Adiciona a nova categoria com suas permissões
  if (!updatedPermissions[category]) {
    // Aqui estamos criando um novo objeto para forçar a reatividade
    updatedPermissions[category] = {
      read: false,
      write: false,
      edit: false,
      delete: false,
      subject: newPermissions.subject || 'Novo Módulo'
    };
  }

  // Atualiza as permissões conforme os valores passados
  updatedPermissions[category].read = newPermissions.read || false;
  updatedPermissions[category].write = newPermissions.write || false;
  updatedPermissions[category].edit = newPermissions.edit || false;
  updatedPermissions[category].delete = newPermissions.delete || false;

  // Atualiza o objeto de permissões agrupadas
  groupedPermissions.value = { ...updatedPermissions };
  emit('permissionsUpdated', updatedPermissions);  // Emite o evento de atualização
};


// Função para lidar com a atualização de permissões recebidas do filho
const handlePermissionsUpdate = (updatedPermissions) => {
  groupedPermissions.value = updatedPermissions;
};

defineExpose({ submitPermissions });

watch(selectedRoleId, updatePermissions);
</script>

<style scoped>
/* Adicione seus estilos aqui */

</style>
