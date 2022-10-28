<div class="modal fade" id="ModalRegistrarEstudio" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Agregar Nuevo Estudio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formRegistrarEstudio">
          <p class="text-center">Agrege un nuevo <strong>Estudio</strong> </p>
          <div class="row">
            <div class="col-8">
              <label for="nombre_estudio" class="form-label">Nombre del Estudio</label>
              <input type="text" name="nombre_estudio" class="form-control input-form" required>
            </div>
            <div class="col-4">
              <label for="cve_estudio" class="form-label">CVE</label>
              <input type="text" name="cve_estudio" class="form-control input-form" required>
            </div>
            <div class="col-12 col-md-12">
              <label for="grupo" class="form-label">Grupo de exámen</label>
              <select name="grupo[]" multiple="multiple" id="registrar-grupo-estudio" required>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="area" class="form-label">Área</label>
              <select name="area" id="registrar-area-estudio" required>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="clasificacion" class="form-label">Clasificación de exámen</label>
              <select name="clasificacion" id="registrar-clasificacion-estudio" required>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="metodo" class="form-label">Método</label>
              <select name="metodo" id="registrar-metodos-estudio" required>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="medida" class="form-label">Medida</label>
              <select name="medida" id="registrar-medidas-estudio" required>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="entrega" class="form-label">Día de entrega</label>
              <input type="number" name="entrega" class="input-form" value="" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="confac" class="form-label">Concepto facturación</label>
              <select name="confac" id="registrar-concepto-facturacion" required>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Indicaciones</label>
              <textarea class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></textarea>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-6">
                <label for="">¿Mostrar valores de referencia? </label>
              </div>
              <div class="col-3">
                <input type="radio" name="varepo" id="registrar-varepoSi" value="1" required>
                <label for="registrar-varepoSi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" name="varepo" id="registrar-varepoNo" value="0" required>
                <label for="registrar-varepoNo">No</label>
              </div>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-6">
                <label for="">¿Se subroga?: </label>
              </div>
              <div class="col-3">
                <input type="radio" name="subroga" id="registrar-subrogaSi" value="1" required>
                <label for="registrar-subrogaSi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" name="subroga" id="registrar-subrogaNo" value="0" required>
                <label for="registrar-subrogaNo">No</label>
              </div>
            </div>
            <p style="margin-top:15px; margin-bottom: 15px">Seleccione los contenedores que necesite esté estudio</p>
            <div class="" id="div-select-contenedores">

            </div>
            <div class="row">
              <div class="col-12">
                <button type="button" class="btn btn-hover" id="nuevo-contenedor">
                  <i class="bi bi-plus"></i> Agregar nuevo contenedor
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarEstudio" class="btn btn-confirmar" id="submit-registrarEstudio">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>
