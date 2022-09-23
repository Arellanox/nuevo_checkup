<div class="modal fade" id="modalEditarEstudio" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Actualizar Estudio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formEditarEstudio">
          <p class="text-center">Modificar <strong>Estudio</strong> </p>
          <div class="row">
            <div class="col-6">
              <label for="nombre_estudio" class="form-label">Nombre del Estudio</label>
              <input type="text" name="nombre_estudio" class="form-control input-form" required id="edit-nombre-estudio">
            </div>
            <div class="col-6 col-md-6">
              <label for="grupo" class="form-label">Grupo de exámen</label>
              <select name="grupo" id="edit-grupo-estudio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="area" class="form-label">Área</label>
              <select name="area" id="edit-area-estudio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="clasificacion" class="form-label">Clasificación de exámen</label>
              <select name="clasificacion" id="edit-clasificacion-estudio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="metodo" class="form-label">Método</label>
              <select name="metodo" id="edit-metodos-estudio">
                <option value="1">Opcion 1</option>
                <option value="2">Opcion 2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="medida" class="form-label">Medida</label>
              <select name="medida" id="edit-medidas-estudio">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="entrega" class="form-label">Día de entrega</label>
              <input type="number" name="entrega" class="input-form" value="" required id="edit-dias-estudio">
            </div>
            <div class="col-6 col-md-6">
              <label for="confac" class="form-label">Concepto facturación</label>
              <select name="confac" id="edit-concepto-facturacion">
                <option value="1">DESCRIPCION</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Indicaciones</label>
              <br />
              <textarea class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder="" id="edit-indicaciones-estudio"></textarea>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-md-auto">
                <label for="">¿Mostrar valores de referencia? </label>
              </div>
              <div class="col">
                <input type="radio" name="varepo" value="1" required id="edit-checkValSi-estudio">
                <label for="varepo">Si</label>
              </div>
              <div class="col">
                <input type="radio" name="varepo" value="0" required id="edit-checkValNo-estudio">
                <label for="varepo">No</label>
              </div>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-md-auto">
                <label for="">Se Subroga?: </label>
              </div>
              <div class="col">
                <input type="radio" name="subroga" value="1" required id="edit-checkRogaSi-estudio">
                <label for="agre-subroga">Si</label>
              </div>
              <div class="col">
                <input type="radio" name="subroga" value="0" required id="edit-checkRogaNo-estudio">
                <label for="agre-subroga">No</label>
              </div>
            </div>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEditarEstudio" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Actualizar
        </button>
      </div>
    </div>
  </div>
</div>
</div>
