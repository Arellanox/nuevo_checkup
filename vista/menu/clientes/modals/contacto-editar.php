<div class="modal fade" id="ModalActualizarContacto" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Editar Datos de Contacto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formActualizarContacto">
          <p class="text-center">Actualizar datos de <strong>Contacto</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_contacto" class="form-label">Nombre</label>
              <input type="text" id="nombre_contacto" name="nombre_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="apellidos_contacto" class="form-label">Apellidos</label>
              <input type="text" id="apellidos_contacto" name="apellidos_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="telefono1_contacto" class="form-label">Telefono 1</label>
              <input type="text" id="telefono1_contacto" name="telefono1_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="telefono2_contacto" class="form-label">Telefono 2</label>
              <input type="text" id="telefono2_contacto" name="telefono2_contacto" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="tipo_contacto" class="form-label">Tipo de contacto</label>
              <select class="form-control input-form" required name="tipo_contacto" id="select_tipo_contacto">
                <option value="">Seleccione una opcion</option>
                <option value="1">Finanzas</option>
                <option value="2">Envio de correo</option>
                <option value="3">Operativo</option>
                <option value="4">Adicional</option>
              </select>
            </div>
            <div class="col-6">
              <label for="email_contacto" class="form-label">Correo Electronico</label>
              <input type="email" id="email_contacto" name="email_contacto" class="form-control input-form" required>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-borrar" id="btn-eliminar-contacto">
          <i class="bi bi-person-x"></i> Eliminar
        </button>
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formActualizarContacto" class="btn btn-confirmar" id="submit-actualizarcontacto">
          <i class="bi bi-person-plus"></i> Actualizar
        </button>
      </div>
    </div>
  </div>
</div>
