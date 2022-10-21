<div class="modal fade" id="modalSolicitudIngresoParticulares" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Solicitud de ingreso a particulares</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formEnviarCorreoIngreso">
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
              <label for="segmentosFiltro" class="form-label">Ingrese el correo</label>
              <input type="text" name="correo" value="" class="form-control input-form" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEnviarCorreoIngreso" class="btn btn-confirmar" id="btn-rechazar-paciente">
          <i class="bi bi-person-x"></i> Enviar solicitud
        </button>
      </div>
    </div>
  </div>
</div>
