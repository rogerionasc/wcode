<template>
  <div class="modal fade" id="deleteUser" tabindex="-1" aria-labelledby="deleteUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="modal-status bg-danger"></div>
        <div class="modal-body text-center py-4">
          <!-- Adicione verificação condicional -->
          <template v-if="user && user.first_name">
            <h3>Tem certeza que deseja excluir <br><span class="text-info">{{ user.first_name }} {{ user.last_name }}</span>?</h3>
            <div class="text-secondary">Você está prestes a excluir este usuário. Caso este usuário seja removido, ele perderá o acesso ao sistema.</div>
          </template>
          <template v-else>
            <h3>Carregando informações do usuário...</h3>
          </template>
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
// import { emit } from 'vue';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['user']);
const emit = defineEmits(['updateTable']);

const confirmDelete = () => {
  if (props.user && props.user.id) {
    Inertia.delete(`user/delete/${props.user.id}`, {
      onSuccess: () => {
        emit('updateTable');
      },
      onError: (error) => {
        console.error('Erro ao excluir o usuário:', error);
      }
    });
  }
};
</script>
