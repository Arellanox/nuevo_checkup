<h5 class="m-2">Lista de contactos</h5>
<div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-contacto-agregar">
    <i class="bi bi-plus-square"></i> Agregar
  </button>
  <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-contacto-editar">
    <i class="bi bi-pencil-square"></i> Editar
  </button>
</div>

<div class="">
  <div class="text-center">
    <label for="inputBuscarTableListaNuevos">Buscar:</label>
    <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" id="BuscarTablaContactos">
  </div>
  <p class="none-p m-3">Seleccione un cliente para mostrar sus contactos</p>
  <table class="table table-hover display responsive " id="TablaContacto">
    <thead class="" style="width: 40%">
      <tr>
        <th scope="col d-flex justify-content-center" class="all">#</th>
        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
        <th scope="col d-flex justify-content-center" class="all">Tipo</th>
    </thead>
    <tbody id="contenido-contacto"> </tbody>
  </table>
  <div class="d-flex justify-content-center" >
    <div class="preloader" id="loader-tabla-contacto"></div>
  </div>
</div>
