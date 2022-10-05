<div class="row ">
  <div class="card col-12 pt-3" style="margin-bottom:5px;">
    <div class="text-start" id="text-start" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-estudio-editar">
        <i class="bi bi-list"></i> Rayos X, Imagenologia
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-estudio-editar">
        <i class="bi bi-list"></i> Laboratorio
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-estudio-editar">
        <i class="bi bi-list"></i>Otros Servicios
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-estudio-editar">
        <i class="bi bi-list"></i> Paquetes
      </button>

      <label for="inputBuscarTableListaNuevos">Seleccione Cliente:</label>
      <select name="metodo" id="seleccion-cliente" required>
      </select>
    </div>
    <div>
      <table class="table table-hover display responsive " id="TablaListaPrecios" style="width: 100%">
        <thead style="width: 100%">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Costo</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Margen</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>
              Nombre Estudio
            </td>
            <td>
              <div class="input-group">
                <span class="input-span">$</span>
                <input type="number" class="form-control input-form" name="costo" placeholder="" value="">
                <span class="input-span">.00</span>
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-span">%</span>
                <input type="number" class="form-control input-form" name="margen" placeholder="" value="">
              </div>
            </td>
            <td>
              Total
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</div>
