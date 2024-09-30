<template>
    <div>
      <Head :title="'Configurações'" />
      <Layout :titleLayout="'Configurações'">
        <!-- Conteúdo da página usuário -->
        <div class="col-12">
          <div class="card">
            <!-- Menu lateral -->
            <div class="row g-0">
              <div class="col-3 d-none d-md-block border-end">
                <div class="card-body">
                  <h4 class="subheader">Configuração Geral</h4>
                  <div class="list-group list-group-transparent">
                    <a href="#"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       :class="{ 'active': activeTab === 'MyAccount' }" 
                       @click="changeTab('MyAccount')">
                      Minha conta
                    </a>
                    <a href="#"
                       class="list-group-item list-group-item-action d-flex align-items-center"
                       :class="{ 'active': activeTab === 'Permissions' }" 
                       @click="changeTab('Permissions')">
                      Permissões
                    </a>
                  </div>
                </div>
              </div>
  
              <!-- Corpo do card -->
              <div class="col d-flex flex-column">
                <div class="card-body pb-5">
                  <component
                    :is="activeTabComponent"
                    :auth="auth"
                    ref="childComponent" 
                  />
                </div>
                <div class="card-footer bg-transparent mt-auto">
                  <div class="btn-list justify-content-end">
                    <a href="#" class="btn">Cancelar</a>
                    <a href="#" class="btn btn-primary" @click="updateActiveTab">Atualizar</a>
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
  import Permissions from "@/Pages/Admin/Settings/Permissions/Index.vue";
  
  const activeTab = ref('MyAccount');
  const childComponent = ref(null);
  
  defineOptions({
    name: 'IndexSettings'
  });
  
  const props = defineProps({
    auth: {
      type: Object,
    }
  });
  
  const activeTabComponent = computed(() => {
    switch (activeTab.value) {
      case 'Permissions':
        return Permissions;
      default:
        return MyAccount;
    }
  });
  
  // Função para mudar a aba
  const changeTab = (tab) => {
    activeTab.value = tab;
  };
  
  // Função para chamar métodos do componente filho usando switch-case
  const updateActiveTab = () => {
    switch (activeTab.value) {
      case 'Permissions':
        if (childComponent.value && typeof childComponent.value.updatePermissions === 'function') {
          childComponent.value.updatePermissions();
        } else {
          console.error('Método updatePermissions não encontrado no componente Permissions.');
        }
        break;
      case 'MyAccount':
        if (childComponent.value && typeof childComponent.value.updateAccount === 'function') {
          childComponent.value.updateAccount();
        } else {
          console.error('Método updateAccount não encontrado no componente MyAccount.');
        }
        break;
      default:
        console.warn('Aba desconhecida.');
        break;
    }
  };
  
  </script>
  
  <style scoped>
  /* Adicione o estilo necessário aqui */
  </style>
  