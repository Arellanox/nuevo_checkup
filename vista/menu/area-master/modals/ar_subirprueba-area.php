<div class="modal fade" id="ModalSubirInterpretacion" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Subir Interpretacion Area: {AREA EN EL QUE SE SUBIRA}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formSubirInterpretacion">
          <p class="text-center">Agregar Archivos de <strong>Resultado</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_contacto" class="form-label">Nombre del Cliente</label>
              <input type="text" name="nombre_contacto" class="form-control input-form" value="Kevin Gabriel Rodriguez Mayo" readonly>
            </div>
            <div class="col-6">
              <label for="apellidos_contacto" class="form-label">Seleccione Documento PDF</label>
              <input type="file" name="pdf_estudio" id="documento_pdf" class="form-control input-form" accept=".pdf" required>
            </div>
            <div class="col-6">
              <label for="telefono1_contacto" class="form-label">Seleccione Imagenes</label>
              <input type="file" name="imagenes_estudio" class="form-control input-form" id="imagenes_estudio" accept="image/*" required>
            </div>
        </form>
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
      <button type="submit" form="formSubirInterpretacion" class="btn btn-confirmar-subir">
        <i class="bi bi-person-plus"></i> Agregar
      </button>
    </div>
  </div>
</div>
</div>