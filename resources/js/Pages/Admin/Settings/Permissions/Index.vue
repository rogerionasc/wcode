<template>
    <h2>Permissões</h2>
    <div class="row">
        
        <div class="col">
            <div class="mb-3">
                <div class="form-label">Cargo/Função</div>
                <select class="form-select">
                <option value="1">Administrador</option>
                <option value="2">Gerente</option>
                <option value="3">Membro</option>
                </select>
            </div>
            <div class="row form-fieldset">
                <div class="col d-flex justify-content-center align-items-center">
                    <a href="#" class="btn btn-ghost-success btn-circle" style="width: 19px; height: 19px; border-radius: 50%; padding: 0;">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-plus m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14zm8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" /></svg>
                    </a>
                </div>
            </div>

            <div class="row form-fieldset">
                <label class="col-3 col-form-label pt-0">Usuário</label>
                <div class="col">
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Ler</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Escrever</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Editar</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Excluir</span>
                    </label>
                </div>
            </div>
            <div class="row form-fieldset">
                <label class="col-3 col-form-label pt-0">Financeiro</label>
                <div class="col">
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Ler</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Escrever</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Editar</span>
                    </label>
                    <label class="form-check">
                    <input class="form-check-input" type="checkbox" checked>
                    <span class="form-check-label">Excluir</span>
                    </label>
                </div>
            </div> 

        </div>
             
    </div>
</template>

<style scoped>
</style>