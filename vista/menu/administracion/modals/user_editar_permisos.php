<div class="modal fade" id="modalEditarPermisosUsuario" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Editar información</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="row bg-acordion" id="formEditarUsuario">
          <p class="text-center">Actualice la información del usuario</p>
            <div class="col-auto">
              <div class="input-group mb-3">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="1" aria-label="Checkbox for following text input" id="checkClinica">
                  <label class="d-flex justify-content-center" for="checkClinica">Historia Clinica Laboral</label>
                </div>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEditarUsuario" class="btn btn-confirmar">
          <i class="bi bi-person-check"></i> Actualizar
        </button>
      </div>
    </div>
  </div>
</div>
