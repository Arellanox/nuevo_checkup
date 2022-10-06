<div class="modal fade" id="ModalRegistrarPaquete" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Crear Nuevo Paquete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarPaquete">
          <p class="text-center">Registre un nuevo <strong>Paquete</strong> </p>
          <br>
          <div class="row">
            <div class="col-4">
              <label for="nombre_paquete" class="form-label">Nombre</label>
              <input type="text" name="nombre_paquete" id="nombre_paquete" class="form-control input-form" required>
            </div>
            <div class="col-4">
              <label for="tipo_paquete" class="form-label">Tipo de Paquete</label>
              <input type="text" name="tipo_paquete" id="tipo_paquete" class="form-control input-form" required>
            </div>
            <div class="col-4 col-md-4">
              <label for="facturacion_paquete" class="form-label">Concepto de Facturacion</label>
              <select name="paquete" id="facturacion-paquete" class="input-form" required>

              </select>
            </div>



          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarPaquete" class="btn btn-confirmar" id="submit-registrarEstudio">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>