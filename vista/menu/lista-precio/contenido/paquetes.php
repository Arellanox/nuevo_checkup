<div class="row" id="paq">

  <div class="col-5 row">

    <div class="col-auto card form-control ">
      <div>
        <label for="inputBuscarPaquetes">Seleccione Paquetes:</label>
        <select name="seleccionpaquete" id="seleccion-paquete" class="input-form" required>
        </select>
        <div class="text-start" id="text-start" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
          <style media="screen">
            .btn-outline-success {
              border-color: transparent;
            }

            .btn-outline-success:hover {
              opacity: 50%;
            }
          </style>
          <input type="radio" class="btn-check" name="selectChecko" id="check-img" value="img" autocomplete="off">
          <label class="btn btn-outline-success" for="check-img"><i class="bi bi-list"></i> Rayos X, Imagennología</label>

          <input type="radio" class="btn-check" name="selectChecko" id="check-lab" value="14" autocomplete="off">
          <label class="btn btn-outline-success" for="check-lab"><i class="bi bi-list"></i> Laboratorio</label>

          <input type="radio" class="btn-check" name="selectChecko" id="check-otros" value="otr" autocomplete="off">
          <label class="btn btn-outline-success" for="check-otros"><i class="bi bi-list"></i>Otros Servicios</label>

        </div>
      </div>
      <label for="inputBuscarAreaEstudio">Buscar Estudio:</label>
      <select name="estudio" id="seleccion-estudio" class="input-form" required>
      </select>
      <button type="submit" form="formCompletarPaquete" class="btn btn-confirmar" id="submit-completarPaquete">
        <i class="bi bi-clipboard-plus"> </i> Agregar Estudio
      </button>
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
            <th scope="col d-flex justify-content-center" class="all">Descripcin</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Cantidad</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Costo Total</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Precio Venta</th>
            <th scope="col d-flex justify-content-center" class="min-tablet">Subtotal</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </div>
  </div>
</div>