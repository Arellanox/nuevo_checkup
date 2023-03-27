<div class="modal fade" id="ModalRegistrarCliente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Añadir Nuevo Cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarCliente">
          <p class="text-center">Agrege un nuevo <strong>Cliente</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_comercial" class="form-label">Nombre</label>
              <input type="text" name="nombre_comercial" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="cve_estudio" class="form-label">Razon Social</label>
              <input type="text" name="razon_social" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6" style="display: none;">
              <label for="grupo" class="form-label">Nombre del Sistema</label>
              <input name="nombre_sistema" value="none" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="rfc" class="form-label">RFC</label>
              <input type="text" name="rfc" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="curp" class="form-label">CURP</label>
              <input type="text" name="curp" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="abreviatura" class="form-label">Abreviatura</label>
              <input type="text" name="abreviatura" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="limite" class="form-label">Limite de Credito</label>
              <input name="limite" type="number" class="form-control input-form" required>

            </div>
            <div class="col-3 col-md-3">
              <label for="tiempo_credito" class="form-label">Temporalidad de Credito</label>
              <input type="number" name="tiempo_credito" class="form-control input-form" required>
            </div>
            <div class="col-3 col-md-3">
              <label for="cuenta_contable" class="form-label">Cuenta Contable</label>
              <input type="text" name="cuenta_contable" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="regimen" class="form-label">Régimen fiscal</label>
              <select class="form-control input-form" name="regimen" id="selectRegimenFiscal-agregar" required>
              </select>
            </div>
            <div class="col-6">
              <label for="cfdi" class="form-label">Uso de CFDI</label>
              <select class="form-control input-form" name="cfdi" id="select-cfdi-agregar" required>

              </select>
            </div>
            <div class="col-6">
              <label for="convenio" class="form-label">Convenio</label>
              <select class="form-control input-form" name="convenio" id="selectConvenio-agregar" required>
                <option value="1">ASEGURADORAS </option>
                <option value="2">INSTITUCIONES PUBLICAS </option>
                <option value="3">INSTITUCIONES PRIVADAS </option>
                <option value="4">CORTESIAS </option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="confac" class="form-label">Pagina Web</label>
              <input name="confac" placeholder="www.ejemplo.com" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="Facebook" class="form-label">Facebook</label>
              <input class="md-textarea input-form" name="Facebook" cols="45" rows="2" placeholder="" required></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="Twitter" class="form-label">Twitter</label>
              <input class="md-textarea input-form" name="Twitter" cols="45" rows="2" placeholder="" required></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="Instagram" class="form-label">Instagram</label>
              <input class="md-textarea input-form" name="Instagram" cols="45" rows="2" placeholder="" required></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="Codigo" class="form-label">Codigo</label>
              <input class="md-textarea input-form" name="Codigo" cols="45" rows="2" placeholder="" required></input>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarCliente" class="btn btn-confirmar" id="submit-registrarEstudio">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>