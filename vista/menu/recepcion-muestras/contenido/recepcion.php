<!-- <div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div> -->

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <!-- Lotes -->
  <!-- Los lotes con estatus finalizados, llevan 3 colores, verde (aceptados), amarillo(Aceptados con recervas), rojo(rechazados) -->
  <!-- El numero de conteo, la procedencia, folio del lote, fecha del envio del lote, estatus (visibles) -->
  <!-- registrado por, formato(pdf) (invisible) -->
  <div class="col-12 col-xl-5 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <h5>Lista de lotes</h5>

      <!-- Control de turnos -->
      <!-- <div id="turnos_panel"></div> -->

      <table class="table responsive" id="TablaListaLotes" style="width: 100%">
        <thead class="">
          <tr>
            <th scope="col d-flex justify-content-center" class="all">#</th>
            <th scope="col d-flex justify-content-center" class="all">Procedencia</th>
            <th scope="col d-flex justify-content-center" class="desktop">Folio</th>
            <th scope="col d-flex justify-content-center" class="desktop">Fecha envio</th>
            <th scope="col d-flex justify-content-center" class="all">Estatus</th>
            <th scope="col d-flex justify-content-center" class="none">Registrado por: </th>
            <th scope="col d-flex justify-content-center" class="none">Formato: </th>

        </thead>
      </table>
    </div>
  </div>

  <!-- <div class="col-12 col-xl-3 tab-second" id="tab-informacion" style="margin-right: -5px !important;  display:none !important">
    <div class="rounded p-3 shadow my-2" id="panel-informacion"> </div>
  </div> -->

  <!-- PAcientes del lote -->
  <!-- Informacion del lote, como encabezado -->

  <!-- Numero, nombre del paciente complet, folio, estatus:  verde (aceptados), amarillo(Aceptados con recervas), rojo(rechazados), boton (abrir las muestras) (visibles)-->

  <!-- Resultado, fecha de resultado, fecha de registro, registrado por, edad, sexo (invisibles) -->
  <div class="col-12 col-xl-7 tab-second" id="tab-reporte" style="margin-right: -5px !important; display: none;">

    <div class="d-flex justify-content-end">
      <div class="rounded p-3 shadow my-2 w-50">
        <p>Informacion del lote</p>
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" data-bs-toggle="modal" data-bs-target="#modalRecepcionMuestras">
          <i class="bi bi-plus-square"></i> Muestras (eliminar luego)
        </button>
      </div>
    </div>

    <div class="rounded p-3 shadow my-2">
      <table class="table responsive" id="TablaPacientesLotes" style="width: 100%">
        <thead class="">
          <tr>
            <th scope="col" class="all">#</th>
            <th scope="col" class="all">Nombre</th>
            <th scope="col" class="none">Fecha resultado:</th>
            <th scope="col" class="all">Sexo:</th>
            <th scope="col" class="all">Fecha registro:</th>
            <th scope="col" class="none">Registrado por: </th>
            <th scope="col" class="none">Edad:</th>
            <th scope="col" class="all">Estatus</th>
            <th scope="col" class="all">Resultado</th>
            <th scope="col" class="all">#</th>
        </thead>
      </table>
    </div>
  </div>


  <!-- Tercera Columna visual -->
  <div id="reload-selectable">

  </div>
</div>