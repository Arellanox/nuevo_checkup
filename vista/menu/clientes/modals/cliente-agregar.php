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
              <label for="nombre_estudio" class="form-label">Nombre</label>
              <input type="text" name="nombre_comercial" class="form-control input-form" required>
            </div>
            <div class="col-6">
              <label for="cve_estudio" class="form-label">Razon Social</label>
              <input type="text" name="razon_social" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="grupo" class="form-label">Nombre del Sistema</label>
              <input name="nombre_sistema" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="rfc" class="form-label">RFC</label>
              <input type="text" name="rfc" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="curp" class="form-label">CURP</label>
              <input type="text" name="curp" id="curp" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="abreviatura" class="form-label">Abreviatura</label>
              <input type="text" name="abreviatura" id="abreviatura" class="form-control input-form" required>
              </inp>
            </div>
            <div class="col-6 col-md-6">
              <label for="limite" class="form-label">Limite de Credito</label>
              <input name="limite" type="number" id="limite_credito" class="form-control input-form" required>

            </div>
            <div class="col-3 col-md-3">
              <label for="tiempo_credito" class="form-label">Temporalidad de Credito</label>
              <input type="number" name="tiempo_credito" class="form-control input-form" id="tiempo_credito" required>

            </div>
            <div class="col-3 col-md-3">
              <label for="cuenta_contable" class="form-label">Cuenta Contable</label>
              <input type="number" name="cuenta_contable" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="confac" class="form-label">Pagina Web</label>
              <input name="confac" id="registrar-concepto-facturacion" placeholder="www.ejemplo.com" class="form-control input-form" required>

            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Facebook</label>
              <input class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Twitter</label>
              <input class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Instagram</label>
              <input class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></input>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Codigo</label>
              <input class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></input>
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
