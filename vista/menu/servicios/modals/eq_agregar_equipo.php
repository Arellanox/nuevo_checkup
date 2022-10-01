<div class="modal fade" id="ModalRegistrarEquipo" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Agregar Nuevo Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formAgregarEquipo">
          <p class="text-center">Registrar un nuevo <strong>Equipo</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="cve_inventario">Clave de Inventario</label>
              <input type="text" name="cve_inventario" id="cve_inventario" class="form-control input-form">
            </div>
            <div class="col-6">
              <label for="uso">Uso</label>
              <textarea name="uso" id="uso" class="md-textarea input-form" cols="45" rows="1"></textarea>
            </div>
            <div class="col-3">
              <label for="numero_serie">Numero de Serie</label>
              <input type="text" id="numero_serie" name="numero_serie" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="frecuenta_mto">Frecuencia de Mantenimiento</label>
              <select name="frecuencia_mto" id="frecuencia_mto" class="form-control input-form">
                <option value="0">Mensual</-option>
                <option value="1">Bimestral</option>
                <option value="2">Trimestral</option>
                <option value="3">Por Numero de Pruebas</option>
                </input>
            </div>
            <div class="col-3">
              <label for="n_pruebas">Numero de Pruebas</label>
              <input type="number" name="n_pruebas" id="n_pruebas" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="calibracion">Calibracion</label>
              <select name="calibracion" id="calibracion" class="form-control input-form" required>
                <option value="1">Bimestral</option>
                <option value="2">Trimestral</option>
                <option value="3">Por Numero de Pruebas</option>
              </select>
            </div>
            <div class="col-3">
              <label for="n_pruebas">Numero de Pruebas Calibracion</label>
              <input type="number" name="n_pruebas_cal" id="n_pruebas_cal" class="form-control input-form">
            </div>

            <div class="col-3">
              <label for="fecha_ingreso">Fecha de Ingreso del Equipo</label>
              <input type="date" name="fecha_ingreso" id="fecha_ingreso" min="2000-01-01" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="fecha_inicio_funcion">Fecha de Inicio de Operacion</label>
              <input type="date" name="fecha_inicio_funcion" id="fecha_inicio_funcion" min="2000-01-01" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="valor_equipo">Valor del Equipo</label>
              <input type="text" name="valor_equipo" id="valor_equipo" class="form-control input-form" value="$">
            </div>
            <div class="col-6">
              <label for="Descripcion">Descripcion</label>
              <textarea name="descripcion" class="md-textarea input-form" cols="45" rows="1" id="descripcion"></textarea>
            </div>
            <div class="col-6">
              <label for="Marca">Marca</label>
              <input type="text" class="form-control input-form" name="marca">
            </div>
            <div class="col-6">
              <label for="modelo">modelo</label>
              <input type="text" name="modelo" class="form-control input-form">
            </div>
            <div class="col-6">
              <label for="foto">Subir foto</label>
              <input type="file" name="foto" id="foto" class="form-control input-form">
            </div>

          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formAgregarEquipo" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>