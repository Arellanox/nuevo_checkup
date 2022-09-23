<div class="modal fade" id="ModalEditarEquipo" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Agregar Nuevo Equipo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formEditarEquipo">
          <p class="text-center">Actualizar informacion del<strong>Equipo</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="cve_inventario">Clave de Inventario</label>
              <input type="text" name="cve_inventario" id="edit-claveInv-equipo" class="form-control input-form">
            </div>
            <div class="col-6">
              <label for="uso">Uso</label>
              <textarea name="uso" id="edit-uso-equipo" class="md-textarea input-form" cols="45" rows="1"></textarea>
            </div>
            <div class="col-3">
              <label for="numero_serie">Numero de Serie</label>
              <input type="text" id="edit-serie-equipo" name="numero_serie" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="frecuenta_mto">Frecuencia de Mantenimiento</label>
              <select name="frecuencia_mto" id="edit-freMante-equipo" class="form-control input-form">
                <option value="0">Mensual</option>
                <option value="2">Bimestral</option>
                <option value="3">Trimestral</option>
                <option value="4">Por Numero de Pruebas</option>
              </select>
            </div>
            <div class="col-3">
              <label for="n_pruebas">Numero de Pruebas</label>
              <input type="number" name="n_pruebas" id="edit-npruebasMante-equipo" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="calibracion">Calibracion</label>
              <input type="number" name="calibracion" id="edit-cali-equipo" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="n_pruebas_cal">Numero de Pruebas Calibracion</label>
              <input type="number" name="n_pruebas_cal" id="edit-npruebasCali-equipo" class="form-control input-form">
            </div>

            <div class="col-3">
              <label for="fecha_ingreso">Fecha de Ingreso del Equipo</label>
              <input type="date" name="fecha_ingreso" id="edit-fechaIngreso-equipo" min="2000-01-01" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="fecha_inicio_funcion">Fecha de Inicio de Operacion</label>
              <input type="date" name="fecha_inicio_funcion" id="edit-fechaInicio-equipo" min="2000-01-01" class="form-control input-form">
            </div>
            <div class="col-3">
              <label for="valor_equipo">Valor del Equipo</label>
              <input type="text" name="valor_equipo" id="edit-valorEquipo-equipo" class="form-control input-form" value="$">
            </div>
            <div class="col-6">
              <label for="Descripcion">Descripcion</label>
              <textarea name="descripcion" class="md-textarea input-form" cols="45" rows="1" id="edit-descripcion-equipo"></textarea>
            </div>
            <div class="col-6">
              <label for="Marca">Marca</label>
              <input type="text" class="form-control input-form" name="marca" id="edit-marca-equipo">
            </div>
            <div class="col-6">
              <label for="modelo">modelo</label>
              <input type="text" name="modelo" class="form-control input-form" id="edit-modelo-equipo">
            </div>
            <div class="col-6">
              <label for="foto" id="aviso-foto-equipo">Subir foto</label>
              <input type="file" name="foto" id="edit-foto-equipo" class="form-control input-form">
            </div>
            <div class="col-6">
              <label for="status">Estado del Equipo</label>
              <select name="status" id="edit-estatus-equipo" class="form-control input-form">
                <option value="0">Fuera de Servicio</option>
                <option value="1" selected>En Operacion</option>
                <option value="2">Manteminiento</option>
              </select>
            </div>
          </div>
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEditarEquipo" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Actualizar
        </button>
      </div>
    </div>
  </div>
</div>
