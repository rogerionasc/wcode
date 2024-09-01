<template>
  <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 9v2m0 4v.01" />
            <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75" />
          </svg>
          <h3>Tem certeza que deseja excluir?</h3>
          <div class="text-secondary">Você está prestes a excluir este usuário. Caso este usuário seja removido, ele perderá o acesso ao sistema.</div>
        </div>
        <div class="modal-footer">
          <div class="w-100">
            <div class="row">
              <div class="col">
                <a href="#" class="btn w-100" data-bs-dismiss="modal">Cancelar</a>
              </div>
              <div class="col">
                <a href="#" id="yesDeleteUser" class="btn btn-danger w-100" data-bs-dismiss="modal" @click="confirmDelete">Sim, desejo excluir</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Inertia } from '@inertiajs/inertia'; 
  
  const props = defineProps(['userId', 'updateTable']);
  
  const confirmDelete = () => {
      if (props.userId) {
          Inertia.delete(`user/delete/${props.userId}`, {
              onSuccess: () => {
                  props.updateTable(); // Atualiza a tabela após a exclusão
              },
              onError: (error) => {
                  console.error('Erro ao excluir o usuário:', error);
              }
          });
      }
  };
  </script>
  