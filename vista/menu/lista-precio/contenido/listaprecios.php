<div class="row ">
  <div class="card col-4 p-4" style="margin-bottom:5px;">
    <div class="text-start row" id="text-start" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <h4>Seleccione una area</h4>
      <p class="none-p">Tipo de lista a mostrar:</p>
      <div class="d-flex justify-content-center">
          <?php  if(filter_var($_POST['franquicia'], FILTER_VALIDATE_BOOLEAN) === false):  ?>
            <div class="col-auto m-1">
              <input type="radio" class="btn-check" name="selectTipLista" title="Costo" id="check-Costo" value="1" autocomplete="off" checked>
              <label class="btn btn-outline-primary" for="check-Costo"><i class="bi bi-list"></i> Costo</label>
            </div>
          <?php endif;  ?>
        <div class="col-auto m-1">
          <input type="radio" class="btn-check" name="selectTipLista" title="Precios" id="check-Precios" value="2" autocomplete="off">
          <label class="btn btn-outline-primary" for="check-Precios"><i class="bi bi-list"></i> Precios</label>
        </div>
        <div class="col-auto m-1">
          <input type="radio" class="btn-check" name="selectTipLista" title="Paquetes" id="check-paquetes" value="3" autocomplete="off">
          <label class="btn btn-outline-primary" for="check-paquetes"><i class="bi bi-list"></i> Paquetes</label>
        </div>
      </div>
      <div class="mt-3" id="divSeleccionCliente">
        <label for="inputBuscarTableListaNuevos">Seleccione un cliente:</label>
        <select name="metodo" id="seleccionar-cliente" required>
        </select>
      </div>
      <p class="none-p vista_estudios-precios">Seleccione area:</p>

      <style media="screen">
        .btn-outline-success {
          border-color: transparent;
        }

        .btn-outline-success:hover {
          opacity: 50%;
        }
      </style>


      <div class="col-auto m-1 vista_estudios-precios">
        <input type="radio" class="btn-check" name="selectChecko" title="Ultrasonido" id="check-img" value="11" autocomplete="off">
        <label class="btn btn-outline-success" for="check-img"><i class="bi bi-list"></i> Ultrasonido</label>
      </div>
      <div class="col-auto m-1 vista_estudios-precios">
        <input type="radio" class="btn-check" name="selectChecko" title="Rayos X" id="check-rx" value="8" autocomplete="off">
        <label class="btn btn-outline-success" for="check-rx"><i class="bi bi-list"></i> Rayos X</label>
      </div>
      <div class="col-auto m-1 vista_estudios-precios">
        <input type="radio" class="btn-check" name="selectChecko" title="Laboratorio" id="check-lab" value="6" autocomplete="off">
        <label class="btn btn-outline-success" for="check-lab"><i class="bi bi-list"></i> Laboratorio</label>
      </div>
      <div class="col-auto m-1 vista_estudios-precios">
        <input type="radio" class="btn-check" name="selectChecko" title="Otros Servicios" id="check-otros" value="0" autocomplete="off">
        <label class="btn btn-outline-success" for="check-otros"><i class="bi bi-list"></i>Otros Servicios</label>
      </div>
    </div>
  </div>
  <div class="col-8 card">
    <div class="text-center" style="margin-top:4px; margin-bottom:5px;">
        <?php  if(filter_var($_POST['franquicia'], FILTER_VALIDATE_BOOLEAN) === false):  ?>
          <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-guardar-lista">
            <i class="bi bi-save"></i> Guardar
          </button>
          <span data-bs-toggle="tooltip" data-bs-placement="top" title="Selecciona una opción de lista a mostrar...">
            <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="vistaPreviaExel" data-bs-toggle="modal" disabled data-bs-target="#vistaPreviaExelModal">
              <i class="bi bi-filetype-exe"></i> Excel (Vista previa)
            </button>
          </span>


          <span data-bs-toggle="tooltip" data-bs-placement="top" title="Muestra/Oculta las columnas">
            <button type="button" class="btn btn-hover me-2 toggle-vis" style="margin-bottom:4px">
              <i class="bi bi-eye"></i> Ver/Ocultar
            </button>
          </span>
        <?php endif; ?>
    </div>

    <div class="" style="margin-left: 30px; margin-right: 30px;">
      <table class="table table-hover display responsive " id="TablaListaPrecios" style="width: 100%">
        <thead style="width: 100%">
        </thead>
        <tbody id="contenido-lista-precios"> </tbody>
      </table>
    </div>
  </div>
</div>