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
        <div v-if="selectedPermissions">
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
              <a href="#" data-bs-toggle="modal" data-bs-target="#modal-danger" class="btn btn-ghost-danger btn-circle" style="width: 19px; height: 19px; border-radius: 50%; padding: 0;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="margin: 0; padding: 0;" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-circle-minus">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                  <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                  <path d="M9 12l6 0" />
                </svg>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <ModalAddPermissions/>
    <ModalDeletePermissions/>
  </template>
<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import ModalAddPermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalAddPermission.vue';
import ModalDeletePermissions from '@/Pages/Admin/Settings/Permissions/Components/ModalDeletePermission.vue';

const roles = ref([]);
const selectedRoleId = ref(null);
const selectedPermissions = ref([]);
const groupedPermissions = ref({});

const props = defineProps({
  auth: Object
});

defineOptions({
  name: 'IndexPermissions'
});

onMounted(() => {
  fetchRoles();
});

// Buscar os cargos (roles) do backend
const fetchRoles = async () => {
  try {
    const response = await axios.get('/admin/roles/fetchRoles');
    console.log('Cargos recebidos:', response.data); // Verifica os dados recebidos
    roles.value = response.data;
  } catch (error) {
    console.error('Erro ao buscar cargos:', error);
  }
};

const updatePermissions = () => {
  const selectedRole = roles.value.find(role => role.id === selectedRoleId.value);
  console.log('Role selecionado:', selectedRole); // Verifica o cargo selecionado
  if (selectedRole) {
    selectedPermissions.value = selectedRole.permissions;
    console.log('Permissões selecionadas:', selectedPermissions.value); // Verifica as permissões
    groupedPermissions.value = groupPermissionsByCategory(selectedPermissions.value);
  } else {
    selectedPermissions.value = [];
    groupedPermissions.value = {};
  }
};

// Função para agrupar permissões por categoria
const groupPermissionsByCategory = (permissions) => {
  if (!Array.isArray(permissions)) {
    console.error('Permissions não é um array:', permissions);
    return {};
  }

  return permissions.reduce((grouped, permission) => {
    const [action] = permission.name.split(' ');
    const category = permission.category || 'Sem categoria'; // Evitar undefined

    if (!grouped[category]) {
      grouped[category] = {
        read: false,
        write: false,
        edit: false,
        delete: false
      };
    }

    if (action === 'read') {
      grouped[category].read = true;
    } else if (action === 'write') {
      grouped[category].write = true;
    } else if (action === 'update') {
      grouped[category].edit = true;
    } else if (action === 'delete') {
      grouped[category].delete = true;
    }

    return grouped;
  }, {});
};


</script>
