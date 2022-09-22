<div class="modal fade" id="ModalRegistrarServicio" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
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

            <div class="col-6">
              <label for="nombre_estudio" class="form-label">Nombre del Estudio</label>
              <input type="text" name="nombre_estudio" class="form-control input-form" required>
            </div>
            <div class="col-6 col-md-6">
              <label for="clasificacion" class="form-label">Clasificacion</label>
              <select name="clasificacion" class="input-form clasificacionExamenes">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="metodo" class="form-label">Metodo</label>
              <select name="metodo" class="input-form metodoExamenes">
                <option value="1">Opcion 1</option>
                <option value="2">Opcion 2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="medida" class="form-label">Medida</label>
              <select name="medida" class="input-form medidasExamenes">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-3 col-md-3">
              <label for="entrega" class="form-label">Dia de Entrega</label>
              <input type="number" name="entrega" class="input-form" value="">
            </div>
            <div class="col-6 col-md-6">
              <label for="confac" class="form-label">Concepto Facturacion</label>
              <select name="confac" class="input-form conceptoFactu">
                <option value="1">DESCRIPCION</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>
            <div class="col-6 col-md-6">
              <label for="indicaciones" class="form-label">Indicaciones</label>
              <br />
              <textarea class="md-textarea input-form" name="indicaciones" cols="45" rows="2" placeholder=""></textarea>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-md-auto">
                <label for="">¿Mostrar valores de Referencia? </label>
              </div>
              <div class="col">
                <input type="radio" name="varepo" value="1" required="" checked="checked">
                <label for="varepo">Si</label>
              </div>
              <div class="col">
                <input type="radio" name="varepo" value="0" required="">
                <label for="varepo">No</label>
              </div>
            </div>
            <div class="row" style="zoom:100%;">
              <div class="col-md-auto">
                <label for="">Se Subroga?: </label>
              </div>
              <div class="col">
                <input type="radio" name="subroga" value="1" required="" checked="checked">
                <label for="agre-subroga">Si</label>
              </div>
              <div class="col">
                <input type="radio" name="subroga" value="0" required="">
                <label for="agre-subroga">No</label>
              </div>
            </div>


          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarEstudio" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Crear
        </button>
      </div>
    </div>
  </div>
</div>
