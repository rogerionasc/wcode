<template>
  <div class="page-loader-container">
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
</script>

<style scoped>
.page-loader-container {
  /* Flexbox para centralização */
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh; /* Altura mínima para ocupar a tela inteira */
  background-color: #f8f9fa; /* Cor de fundo opcional */
}
</style>
