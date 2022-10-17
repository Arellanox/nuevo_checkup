<div class="row ">
  <div class="card col-4 p-4" style="margin-bottom:5px;">
    <div class="text-start row" id="text-start" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <h4>Seleccione una area</h4>
      <style media="screen">
        .btn-outline-success{
          border-color: transparent;
        }
        .btn-outline-success:hover{
          opacity: 50%;
        }
      </style>
      <div class="col-auto m-1">
        <input type="radio" class="btn-check" name="selectChecko" id="check-img" value="7" autocomplete="off" checked>
        <label class="btn btn-outline-success" for="check-img"><i class="bi bi-list"></i> Imagennología</label>
      </div>
      <div class="col-auto m-1">
        <input type="radio" class="btn-check" name="selectChecko" id="check-lab" value="6" autocomplete="off">
        <label class="btn btn-outline-success" for="check-lab"><i class="bi bi-list"></i> Laboratorio</label>
      </div>
      <div class="col-auto m-1">
        <input type="radio" class="btn-check" name="selectChecko" id="check-otros" value="0" autocomplete="off">
        <label class="btn btn-outline-success" for="check-otros"><i class="bi bi-list"></i>Otros Servicios</label>
      </div>
      <div class="col-12 m-1">
        <input type="radio" class="btn-check" name="selectChecko" id="check-paquetes" value="Paq" autocomplete="off">
        <label class="btn btn-outline-success" for="check-paquetes"><i class="bi bi-list"></i> Paquetes</label>
        <label for="inputBuscarTableListaNuevos">Seleccione Cliente:</label>
        <select name="metodo" id="seleccion-cliente" required>
        </select>
      </div>
    </div>
  </div>
  <div class="col-8 card">
    <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-precios-guardar">
        <i class="bi bi-save"></i> Guardar
      </button>
    </div>
    <div class="" style="margin-left: 30px; margin-right: 30px;">
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
        <tbody id="contenido-lista-precios"> </tbody>
      </table>
      <div class="d-flex justify-content-center" >
        <div class="preloader" id="loader-tabla-precios"></div>
      </div>
    </div>
  </div>
</div>
