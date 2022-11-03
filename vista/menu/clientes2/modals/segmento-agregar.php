<div class="modal fade" id="ModalRegistrarSegmentos" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador"> Agregar Nuevo Segmento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarSegmento">
          <p class="text-center">Registre un nuevo <strong>Segmento</strong></p>
          <div class="row">
            <div class="col-6 col-md-6">
              <label for="nombre_segmento" class="form-label">Descripción</label>
              <input type="text" name="nombre_segmento" id="nombre_segmento" class="input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="descripcion" class="form-label">¿Subsecuente?</label>
              <input type="text" name="descripcion" id="descripcion" class="input-form" required>
            </div>
            <input type="checkbox" name="" value=""> Segmento no subsecuente.
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarSegmento" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
