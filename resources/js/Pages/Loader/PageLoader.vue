<template>
  <div v-if="showLoader" :class="['page-loader-container', { 'fade-out': isFading }]">
    <div class="container container-slim py-4">
      <div class="text-center">
        <div class="mb-3">
          <!-- 
          Removi o link e imagem comentados por serem desnecessários para a centralização 
          Se precisar adicionar, apenas descomente e certifique-se de ajustar o estilo conforme necessário.
          -->
          <!-- <a href="." class="navbar-brand navbar-brand-autodark"><img src="../../img/Logo250x250.svg" height="36" alt=""></a> -->
        </div>
        <div class="text-secondary mb-3">Estamos preparando</div>
        <div class="progress progress-sm">
          <div class="progress-bar progress-bar-indeterminate"></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// Script setup Vue 3
import { ref, onMounted } from 'vue';

const showLoader = ref(true); // Controle de visibilidade do loader
const isFading = ref(false); // Controle de estado para fade out

onMounted(() => {
  // Temporizador para iniciar o fade out após 5 segundos
  setTimeout(() => {
    isFading.value = true; // Inicia o fade out
    setTimeout(() => {
      showLoader.value = false; // Esconde o loader após o fade out
    }, 1000); // Espera a duração da transição CSS antes de ocultar
  }, 5000); // Exibe o loader por 5 segundos antes de iniciar o fade
});
</script>

<style scoped>
.page-loader-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* Altura mínima para ocupar a tela inteira */
  background-color: #f8f9fa; /* Cor de fundo opcional */
  opacity: 1; /* Define opacidade inicial */
  transition: opacity 1s ease-out; /* Transição suave de opacidade */
}

.fade-out {
  opacity: 0; /* Define opacidade final para o fade out */
}
</style>
