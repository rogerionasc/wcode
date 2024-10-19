<template>
  <div class="modal fade" id="modal-team" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" :class="{ 'badge bg-orange-lt': roleName === 'Administrador' || roleName === 'Gerente' }">
            {{ roleName }}
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3">
            <div class="col-auto">
              <span class="form-label" v-if="Object.keys(availablePermissions).length > 0">Módulos de permissões</span>
              <div class="form-selectgroup">
                <label 
                  class="form-selectgroup-item" 
                  v-for="(permission, category) in availablePermissions" 
                  :key="category"
                >
                  <input
                    type="checkbox"
                    class="form-selectgroup-input"
                    :value="category"
                    :checked="isChecked(category)" 
                    @change="updateSelectedPermissions(category, $event.target.checked)"
                  />
                  <span class="form-selectgroup-label">{{ category }}</span>
                </label>
              </div>
              <p v-if="!availablePermissions || (Object.keys(availablePermissions).length === 0)">
                Nenhuma permissão disponível
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
          <button type="button" class="btn btn-primary"
                  :disabled="Object.keys(availablePermissions).length === 0"
                  @click="emitAddPermission">Adicionar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, onMounted, defineEmits, onBeforeUnmount, computed } from 'vue';

const emit = defineEmits();
const props = defineProps({
  userPermissions: Object,
  allPermissions: Object,
  roleName: String,
});

const availablePermissions = ref({});
const selectedPermissions = ref({});

// Função para criar objeto com permissões faltantes
const getAvailablePermissions = () => {
  const missingPermissions = {};

  // Itera sobre todas as permissões de allPermissions
  for (const category in props.allPermissions) {
    // Se a permissão não estiver em userPermissions, adiciona ao missingPermissions
    if (!props.userPermissions.hasOwnProperty(category)) {
      missingPermissions[category] = props.allPermissions[category];
    }
  }

  // Atualiza o valor de availablePermissions com as permissões faltantes
  availablePermissions.value = missingPermissions;
};

// Computed property para verificar se a permissão está selecionada
const isChecked = computed(() => {
  return (category) => {
    return selectedPermissions.value[category] !== undefined;
  };
});

// Atualiza as permissões selecionadas
const updateSelectedPermissions = (category, isChecked) => {
  if (isChecked) {
    // Adiciona a permissão ao selectedPermissions
    selectedPermissions.value[category] = availablePermissions.value[category];
  } else {
    // Remove a permissão do selectedPermissions
    delete selectedPermissions.value[category];
    // Força a reatividade
    selectedPermissions.value = { ...selectedPermissions.value };
  }
};

// Usa `watch` para garantir que `availablePermissions` seja atualizado
// sempre que `allPermissions` ou `userPermissions` mudar
watch([() => props.allPermissions, () => props.userPermissions], () => {
  getAvailablePermissions();
}, { immediate: true });

const resetSelection = () => {
  selectedPermissions.value = {};
};

const handleModalClose = () => {
  resetSelection();
};

onMounted(() => {
  const modalElement = document.getElementById('modal-team');
  modalElement.addEventListener('hidden.bs.modal', handleModalClose);

  $('.form-selectgroup-input').on('change', function() {
  const label = $(this).next('.form-selectgroup-label');
  if ($(this).is(':checked')) {
    label.addClass('selected');
  } else {
    label.removeClass('selected');
  }
  $(this).blur(); // Força a perda de foco no checkbox
});

});

onBeforeUnmount(() => {
  const modalElement = document.getElementById('modal-team');
  modalElement.removeEventListener('hidden.bs.modal', handleModalClose);
});

const emitAddPermission = () => {
  emit('add-permission', { ...selectedPermissions.value });
  selectedPermissions.value = {};
  getAvailablePermissions();
};

</script>

<style scoped>
.form-selectgroup-input:checked + .form-selectgroup-label {
    z-index: 1;
    color: var(--tblr-primary);
    background: rgba(var(--tblr-primary-rgb), .04);
    border-color: var(--tblr-primary);

    
}

.form-selectgroup-input:not(:checked) + .form-selectgroup-label {
    color: inherit;
    background: none;
    border-color: #ddd; /* ou o valor que você deseja quando desmarcado */
    box-shadow: none;
}

/* .form-selectgroup-input:focus + .form-selectgroup-label {
  z-index: 2;
  color: var(--tblr-primary);
  border-color: var(--tblr-primary);
  box-shadow: 0 0 0 .25rem rgba(32, 107, 196, .25);
} */



</style>
