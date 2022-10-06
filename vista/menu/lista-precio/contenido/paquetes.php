<div class="row">

  <div class="col-5 row">

    <div class="col-12 card form-control ">
      form
      <label for="inputBuscarPaquetes">Seleccione Paquetes:</label>
      <select name="seleccionpaquete" id="seleccion-paquete" class="input-form" required>
      </select>

      <div></div>
    </div>

    <div class="col-12 card">
      info
    </div>
  </div>
  <div class="card col-7 pt-3" style="margin-bottom:5px;">
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
                <input type="number" class="form-control input-form costo" name="costo" placeholder="" value="">
                <span class="input-span">.00</span>
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-span">%</span>
                <input type="number" class="form-control input-form margen" name="margen" placeholder="" value="">
              </div>
            </td>
            <td class="total">
              $00
            </td>
          </tr>
          <tr>
            <td>2</td>
            <td>
              Nombre Estudio 2
            </td>
            <td>
              <div class="input-group">
                <span class="input-span">$</span>
                <input type="number" class="form-control input-form costo" name="costo" placeholder="" value="">
                <span class="input-span">.00</span>
              </div>
            </td>
            <td>
              <div class="input-group">
                <span class="input-span">%</span>
                <input type="number" class="form-control input-form margen" name="margen" placeholder="" value="">
              </div>
            </td>
            <td>
              <p class="total">00</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>