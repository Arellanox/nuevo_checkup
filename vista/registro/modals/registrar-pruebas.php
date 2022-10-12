<div class="modal fade" id="ModalRegistrarPrueba" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">Utilice su <strong>CURP</strong> para crear su registro de laboratorio</p>

          <div class="row">
            <div class="col-12 col-lg-4">
                <label for="curp" class="form-label">CURP</label>
                <input type="text" name="curp" value="" class="form-control input-form" id="curp-paciente" required>
            </div>
            <div class="col-12 col-lg-4" style="margin-bottom: 10px;">
                <label for="selectpaciente" class="form-label">Buscar paciente</label>
                <div class="row">
                  <div class="col-auto">
                    <button class="btn btn-sm btn-confirmar" type="button" id="actualizarForm"><i class="bi bi-binoculars"></i> Consultar</button>
                  </div>
                  <div class="col-auto">
                    <button class="btn btn-sm btn-borrar" type="button" id="eliminarForm" ><i class="bi bi-eraser"></i> Limpiar</button>
                  </div>
                </div>
              </div>
          </div>
          <div id="formDIV">
            <p id="mensaje" class="text-center"></p>
            <div class="row">
              <div class="col-6">
                <p>Paciente:</p>
                <p id="paciente-registro">Luis Gerardo Cuevas González</p>
              </div>
              <div class="col-6">
                  <label for="curp" class="form-label">Fecha de agenda</label>
                  <input type="date" name="agenda" value="" class="form-control input-form" required>
              </div>
              <div class="col-6">
                <p>CURP:</p>
                <p id="cupr-registro">GLSUB2928NA28AN</p>
              </div>
              <div class="col-6">
                <p>Sexo</p>
                <p id="sexo-registro">MASCULINO</p>
              </div>
            </div>
            <br>
            <h3>Cuestionario</h3>
            <div class="mt-3" id="antecedentes-registro">

            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="button" class="btn btn-confirmar" id="btnFormRegistrarPruba">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
