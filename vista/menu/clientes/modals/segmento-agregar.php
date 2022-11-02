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
              <label for="descripcion" class="form-label">Descripción</label>
              <input type="text" name="descripcion" class="input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="padre" class="form-label">¿Subsecuente?</label>
              <select class="form-control input-form" name="padre" id="selectSegmentos">
              </select>
              <div class="form-check">
               <input class="form-check-input" type="checkbox" value="" id="checkSegmentoPadre">
               <label class="form-check-label" for="checkSegmentoPadre">
                 Segmento "padre".
               </label>
              </div>
            </div>
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
