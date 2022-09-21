<div class="modal fade" id="ModalVistaMetodos" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Métodos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
          <div class="col-12 col-lg-5">
              <label for="metodo-buscar" class="form-label">Métodos</label>
              <select class="" name="curp" id="select_metodos" style="width:100%;">
                <option></option>
                <option value="1">Metodo 1</option>
                <option value="2">Metodo 2</option>
                <option value="3">Metodo 3</option>
                <option value="4">Metodo 4</option>
              </select>
              <!-- <input type="text" name="metodo-buscar" value="" class="form-control input-form" id="select_metodos" required> -->
          </div>
          <div class="col-12 col-lg-4" style="margin-bottom: 10px;">
              <label for="selectpaciente" class="form-label"></label>
              <div class="row">
                <div class="col-auto">
                  <button class="btn btn-sm btn-confirmar" type="button" id="Buscarmetodo"><i class="bi bi-binoculars"></i> Buscar</button>
                </div>
                <div class="col-auto">
                  <button class="btn btn-sm btn-cancelar" type="button" id="Limpiarmetodo" ><i class="bi bi-eraser"></i> Limpiar</button>
                </div>
              </div>
          </div>
        </div>
        <h4>Métodos</h4>
        <p class="none-p">Doble click para editar <i class="bi bi-pencil"></i></p>
        <div class="row mt-3">
          <div class="col-6">
            <table class="table table-hover display responsive tableContenido" id="TablaMetodos" style="width:100%">
              <thead class="" style="width: 100%">
                <tr>
                  <th scope="col d-flex justify-content-center" class="all">#</th>
                  <th scope="col d-flex justify-content-center" class="min-tablet">Método</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Metodo 1</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Metodo 2</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Metodo 3</td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>Metodo 4</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col-6" id="RegistrarMetodoCol">
            <p>Crear nuevo metodo:</p>
            <form class="row" id="formRegistrarMetodo">
              <div class="col-12">
                <label for="metodo" class="form-label">Nombre del metodo</label>
                <input type="text" name="metodo" value="" class="form-control input-form" >
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">
                  <i class="bi bi-send-plus"></i> Guardar metodo
                </button>
              </div>
            </form>
          </div>
          <div class="col-6" id="editarMetodoCol" style="display:none">
            <p>Actualizar metodo:</p>
            <form class="row" id="formEditarmetodo">
              <div class="col-12">
                <label for="metodo" class="form-label">Nombre del metodo</label>
                <input type="text" name="metodo" id="edit-metodo-descripcion" class="form-control input-form" >
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">
                  <i class="bi bi-pencil-square"></i> Actualizar
                </button>
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="desactivar-metodo">
                  <i class="bi bi-collection"></i> Desactivar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cerrar</button>
        <!-- <button type="submit" class="btn btn-confirmar">
          <i class="bi bi-person-plus"></i> Crear
        </button> -->
      </div>
    </div>
  </div>
</div>
