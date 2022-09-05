<div class="modal fade" id="modalRegistrarCargo" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Registrar nuevo cargo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarCargo">
          <p class="text-center">Cree un nuevo cargo para los usuarios del sistema</p>
          <div class="row">
          <div class="col-12">
            <label for="nombre" class="form-label">Nombre del cargo</label>
            <input type="text" name="nombre" id="edit-usuario-nombre" class="form-control input-form" required>
          </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarCargo" class="btn btn-confirmar">
          <i class="bi bi-briefcase-fill"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>
