<template>
    <div class="modal modal-blur fade" id="modal-team" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title badge bg-orange-lt">Administrador</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row mb-3">
              <div class="col-auto">
                <div class="mb-3">
                  <span class="form-label">Modulos de permissões</span>
                  <div class="form-selectgroup">
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="HTML" class="form-selectgroup-input" checked>
                      <span class="form-selectgroup-label">Usuário</span>
                    </label>
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="CSS" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">Financeiro</span>
                    </label>
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="PHP" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">Estoque</span>
                    </label>
                    <label class="form-selectgroup-item">
                      <input type="checkbox" name="name" value="JavaScript" class="form-selectgroup-input">
                      <span class="form-selectgroup-label">Caixa</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Adicionar</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  