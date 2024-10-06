<template>
  <div class="modal fade" id="modal-team" tabindex="-1" aria-hidden="true" @hidden.bs.modal="resetSelection">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title badge bg-orange-lt">{{ roleName }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-auto">
              <div class="mb-3">
                <span class="form-label">Módulos de permissões</span>
                <div v-for="(permissions, category) in filteredGroupPermissions" :key="category" class="form-selectgroup">
                  <label class="form-selectgroup-item">
                    <input
                      type="checkbox"
                      class="form-selectgroup-input"
                      @change="(event) => { toggleCategory(category, permissions, event); event.target.blur(); }"
                      :checked="category in selectedCategories"
                    />
                    <span class="form-selectgroup-label">{{ category }}</span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary" :disabled="Object.keys(selectedCategories).length === 0" @click="emitAddPermission">Adicionar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, defineEmits, computed } from 'vue';

const emit = defineEmits();
const roles = ref([]);
const selectedCategories = ref({});
const groupPermissionsModal = ref({});
const props = defineProps({
  groupedPermissions: Object,
  roleName: String,
  resetCategories: Function, // Certifique-se de que esta prop é uma função, se for usada
});

const filteredGroupPermissions = computed(() => {
  const groupedKeys = Object.keys(props.groupedPermissions); // Obtenha as permissões já selecionadas
  return Object.fromEntries(
    Object.entries(groupPermissionsModal.value).filter(
      ([category]) => !groupedKeys.includes(category) // Inclua categorias que não estão em groupedPermissions
    )
  );
});


const toggleCategory = (category, permissions, event) => {
  const isChecked = event.target.checked; // Captura o estado do checkbox

  if (isChecked) {
    // Adiciona a categoria ao objeto de categorias selecionadas
    selectedCategories.value = { ...selectedCategories.value, [category]: permissions };
  } else {
    // Remove a categoria
    removeCategory(category);
  }

  // Recalcular filteredGroupPermissions após qualquer mudança
  recalculateFilteredPermissions();
};

const removeCategory = (category) => {
  const { [category]: _, ...rest } = selectedCategories.value; // Remove a categoria usando destructuring
  selectedCategories.value = rest; // Atualiza o objeto

  // Recalcular filteredGroupPermissions após remoção
  recalculateFilteredPermissions();
};

// Recalcula as permissões filtradas com base no estado atual de selectedCategories
const recalculateFilteredPermissions = () => {
  const groupedKeys = Object.keys(selectedCategories.value); // Captura as categorias já selecionadas
  filteredGroupPermissions.value = Object.fromEntries(
    Object.entries(groupPermissionsModal.value).filter(
      ([category]) => !groupedKeys.includes(category) // Exclui as categorias já selecionadas
    )
  );
};


const fetchRolesModal = async () => {
  try {
    const response = await fetch('http://localhost:8000/admin/roles/fetchRoles');
    if (!response.ok) {
      throw new Error(`Erro ao buscar os papéis: ${response.statusText}`);
    }
    const data = await response.json();
    roles.value = data;
    groupPermissionsModal.value = groupAllPermissions(roles.value);
  } catch (error) {
    console.error('Erro ao buscar papéis:', error);
    // Adicionar feedback visual para o usuário se necessário
  }
};

const groupAllPermissions = (roles) => {
  const allGroupedPermissions = {};
  roles.forEach((role) => {
    const grouped = groupPermissionsByCategoryModal(role.permissions);
    for (const category in grouped) {
      if (!allGroupedPermissions[category]) {
        allGroupedPermissions[category] = grouped[category];
      } else {
        allGroupedPermissions[category].read = allGroupedPermissions[category].read || grouped[category].read;
        allGroupedPermissions[category].write = allGroupedPermissions[category].write || grouped[category].write;
        allGroupedPermissions[category].edit = allGroupedPermissions[category].edit || grouped[category].edit;
        allGroupedPermissions[category].delete = allGroupedPermissions[category].delete || grouped[category].delete;
      }
    }
  });
  return allGroupedPermissions;
};

const groupPermissionsByCategoryModal = (permissions) => {
  return permissions.reduce((grouped, permission) => {
    const [action, subject] = permission.name.split(' ');
    const category = permission.category || 'Sem categoria';
    if (!grouped[category]) {
      grouped[category] = {
        read: false,
        write: false,
        edit: false,
        delete: false,
        subject: subject
      };
    }
    if (action === 'read') grouped[category].read = true;
    if (action === 'write') grouped[category].write = true;
    if (action === 'update') grouped[category].edit = true;
    if (action === 'delete') grouped[category].delete = true;
    return grouped;
  }, {});
};

const emitAddPermission = () => {
  const newPermissions = { ...selectedCategories.value };
  console.log("New Permissions to Emit:", newPermissions);
  emit('add-permission', newPermissions);
};

const resetSelection = () => {
  selectedCategories.value = {};
  console.log("Selected Categories reset:", selectedCategories.value);
};

// Registrar e remover o evento hidden.bs.modal
onMounted(() => {
  fetchRolesModal();
  const modalElement = document.getElementById('modal-team');
  modalElement.addEventListener('show.bs.modal', resetSelection);
  modalElement.addEventListener('hidden.bs.modal', resetSelection);
});

onBeforeUnmount(() => {
  const modalElement = document.getElementById('modal-team');
  modalElement.removeEventListener('show.bs.modal', resetSelection);
  modalElement.removeEventListener('hidden.bs.modal', resetSelection);
});

defineExpose({ resetSelection });
</script>

<style scoped>
</style>
