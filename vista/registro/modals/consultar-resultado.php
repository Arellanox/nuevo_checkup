<div class="modal fade" id="ModalConsultarResultado" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center" >Utilice su <strong>PREFOLIO</strong>, <strong>CURP</strong> y seleccione la prueba a consultar.</p>
        <form id="formObtenerResultado">
            <div class="row">
                <div class="col-12">
                    <label for="procedencia" class="form-label">PREFOLIO</label>
                    <input type="text" name="prefolio" value="" class="form-control input-form" id="prefolio-consulta" required>
                </div>
                <div class="col-12">
                    <label for="procedencia" class="form-label">CURP</label>
                    <input type="text" name="curp" value="" class="form-control input-form" id="curp-consulta" required>
                </div>
                <div class="col-12">
                  <label for="segmento" class="form-label">Estudio</label>
                  <select name="segmento" id="estudio-consulta" class="input-form" required>
                    <option>Seleccione...</option>
                    <option value="">PSA</option>
                  </select>
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formObtenerResultado" class="btn btn-confirmar">
          <i class="bi bi-binoculars"></i> Consultar
        </button>
      </div>
    </div>
  </div>
</div>
