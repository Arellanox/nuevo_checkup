<div class="modal fade" id="ModalSubirCapturas" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Subir Interpretacion Area: <strong id="Area-estudio" style="color:white !important"></strong> </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formSubirCapturas">
          <p class="text-center">Agregue los archivos de resultados </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_contacto" class="form-label">Nombre del Cliente</label>
              <input type="text" class="form-control input-form" value="Nombre del paciente" readonly id="nombre-paciente-capturas">
            </div>
            <div class="col-6">
              <label for="reportes" class="form-label">Suba las capturas</label>
              <input type="file" name="reportes[]" class="form-control input-form" accept=".png, .jpg, .jpeg, .pdf" multiple required id="inputFilesCapturasArea">
            </div>
            <div class="col-12">
              <label for="comentario" class="form-label">Observaciones</label>
              <textarea name="comentario" class="md-textarea input-form" rows="4" cols="80"></textarea>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
      <button type="submit" form="formSubirCapturas" class="btn btn-confirmar-subir">
        <i class="bi bi-person-plus"></i> Agregar
      </button>
    </div>
  </div>
</div>
</div>
