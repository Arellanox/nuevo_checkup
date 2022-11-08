<div class="modal fade" id="ModalAgregarContacto" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Añadir nuevo Contacto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formAgregarContacto">
          <p class="text-center">Agregar Nuevo <strong>Contacto</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_contacto" class="form-label">Nombre</label>
              <input type="text" name="nombre_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="apellidos_contacto" class="form-label">Apellidos</label>
              <input type="text" name="apellidos_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="telefono1_contacto" class="form-label">Telefono 1</label>
              <input type="text" name="telefono1_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="telefono2_contacto" class="form-label">Telefono 2</label>
              <input type="text" name="telefono2_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="tipo_contacto" class="form-label">Tipo de contacto</label>
              <select class="form-control input-form" name="tipo_contacto">
                <option value="1">Finanzas</option>
                <option value="2">Operativo</option>
                <option value="3">Envio de resultado</option>
                <option value="4">Adicional</option>
              </select>
            </div>
            <div class="col-6">
              <label for="email_contacto" class="form-label">Correo Electronico</label>
              <input type="email" name="email_contacto" class="form-control input-form" required>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formAgregarContacto" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Agregar
        </button>
      </div>
    </div>
  </div>
</div>
