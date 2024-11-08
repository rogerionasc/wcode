<template>
  <div>
    <Head :title="'Configurações'" />
    <Layout :titleLayout="'Configurações'">
      <div class="col-12">
        <div class="card">
          <div class="row g-0">
            <div class="col-3 d-none d-md-block border-end">
              <div class="card-body">
                <h4 class="subheader">Configuração Geral</h4>
                <div class="list-group list-group-transparent">
                  <a href="#"
                    class="list-group-item list-group-item-action d-flex align-items-center"
                    :class="{ 
                      'active color-custom': activeTab === 'MyAccount'
                    }" 
                    @click="changeTab('MyAccount')">
                    Minha conta
                  </a>

                  <a href="#"
                     class="list-group-item list-group-item-action d-flex align-items-center"
                     :class="{
                      'active': activeTab === 'Permissions',
                      'color-custom': activeTab === 'Permissions'
                     }"
                     v-if="hasRole(['Administrador', 'Gerente'])"
                     @click="changeTab('Permissions')">
                    Permissões
                  </a>
                </div>
              </div>
            </div>

            <div class="col d-flex flex-column">
              <div class="card-body pb-5">
                <component
                  :is="activeTabComponent"
                  :auth="auth"
                  ref="childComponent" 
                  @toggleLoading="toggleLoading"
                />
              </div>
              <div class="card-footer bg-transparent mt-auto">
                <div class="btn-list justify-content-end">
                  <a href="#" class="btn">Cancelar</a>
                  <button class="btn btn-primary" @click.prevent="updateActiveTab" :disabled="isLoading">
                    <span v-if="isLoading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span v-if="isLoading">Aguarde</span>
                    <span v-else>Salvar</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </Layout>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { Head } from "@inertiajs/vue3";
import Layout from "@/Layouts/Layout.vue";
import MyAccount from "@/Pages/Admin/Settings/Account.vue";
import Permissions from "@/Pages/Admin/Settings/Permissions.vue";

const activeTab = ref('MyAccount');
const childComponent = ref(null);
const isLoading = ref(false);

defineOptions({
  name: 'IndexSettings'
});

const props = defineProps({
  auth: Object
});

const hasRole = (roles) => {
  return props.auth && props.auth.user && roles.includes(props.auth.user.role);
};

// Recuperar a aba do localStorage ao montar o componente
onMounted(() => {
  const savedTab = localStorage.getItem('activeTab');
  if (savedTab) {
    activeTab.value = savedTab;
  }
});

const activeTabComponent = computed(() => {
  if (activeTab.value === 'Permissions') {
    return Permissions;
  } else if (activeTab.value === 'MyAccount') {
    return MyAccount;
  }
  return null;
});

const changeTab = (tab) => {
  activeTab.value = tab;
  // Guardar a aba atual no localStorage
  localStorage.setItem('activeTab', tab);
};

const updateActiveTab = () => {
  const child = childComponent.value;
  if (!child) {
    console.warn('Componente filho não encontrado.');
    return;
  }

  if (activeTab.value === 'Permissions' && typeof child.submitPermissions === 'function') {
    child.submitPermissions();
  } else if (activeTab.value === 'MyAccount' && typeof child.updateAccount === 'function') {
    child.updateAccount();
  } else {
    console.warn('Método não encontrado no componente filho.');
  }
};

const toggleLoading = (loading) => {
  isLoading.value = loading;
};
</script>

<style scoped>
.color-custom {
  background: #d7e8f7 !important;
}

/* Efeito de hover */
.list-group-item {
  transition: background-color 0.3s; /* Transição suave */
}

.list-group-item:hover {
  background-color: rgba(230, 241, 250, 0.4) !important; 
}

.list-group-item.active:hover {
  background-color: #d7e8f7 !important;
}
</style>
