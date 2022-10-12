<div class="row">
  <div class="card col-3 col-lg-3 pt-4">
    <div class="" id="panel-informacion">

    </div>
    <div class="" id="contacto-informacion">

    </div>
  </div>
  <div class="card col-6 col-lg-6" style="margin-bottom:5px">
    <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-cliente-editar">
        <i class="bi bi-pencil-square"></i> Editar Cliente
      </button>
    </div>
    <table class="table table-hover display responsive tableContenido" id="TablaClientes" style="width: 100%">
      <thead class="" style="width: 100%">
        <tr>
          <th scope="col d-flex justify-content-center" class="all">#</th>
          <th scope="col d-flex justify-content-center" class="all">Nombre</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">
            <Ri:a>Razon Social</Ri:a>
          </th>
          <th scope="col d-fkex justify-content-center" class="min-tablet">Abreviatura</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>#1</td>
          <td>Kevin Gabriel Rodriguez</td>
          <td>UNRECOVERY-DZ S. RL de CV</td>
          <td>URCDZ</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-lg-3 card">
    <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-contacto-agregar">
        <i class="bi bi-plus-square"></i> Agregar Nuevo Contacto
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-contacto-editar">
        <i class="bi bi-pencil-square"></i> Editar Contacto
      </button>
    </div>
    <div class="" id=" panel-informacion">
      <h5>Lista de contactos</h5>
      <div class="text-center">
        <label for="inputBuscarTableListaNuevos">Buscar:</label>
        <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaNuevos" value="" style="width:80%" id="BuscarTablaContactos">
      </div>
      <table class="table table-hover display responsive " id="TablaContacto">
        <thead class="" style="width: 40%">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Nombre</th>
        </thead>
        <tbody>
          <tr>
            <td>#1</td>
            <td>Kevin Gabriel Rodriguez</td>

          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<style media="screen">
  #TablaContacto_filter {
    display: none;
  }
</style>