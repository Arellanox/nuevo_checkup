<div class="col-12 loader" id="loader">
  <div class="preloader" id="preloader"> </div>
</div>

<!-- tabs para movil -->
<div id="tab-button"></div>

<!-- style="max-height: 60vh" -->
<div class="row overflow-auto">
  <!-- Lotes -->
  <!-- Los lotes con estatus finalizados, llevan 3 colores, verde (aceptados), amarillo(Aceptados con recervas), rojo(rechazados) -->
  <!-- El numero de conteo, la procedencia, folio del lote, fecha del envio del lote, estatus (visibles) -->
        <!-- registrado por, formato(pdf) (invisible) -->
  <div class="col-12 col-xl-4 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
    <div class="rounded p-3 shadow my-2" id="lista-pacientes">
      <h5>Lista de pacientes</h5>

      <!-- Control de turnos -->
      <div id="turnos_panel"></div>

      <table class="table display responsive" id="TablaMuestras" style="width: 100%">
        <thead class="">
          <tr>
            <th class="all">#</th>
            <th class="all">Nombre</th>
            <th class="min-tablet">Folio</th>
            <th class="tablet">Compañia</th>
            <th class="tablet">Edad</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
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
  <div class="col-12 col-xl-8 tab-second" id="tab-reporte" style="margin-right: -5px !important;">
    <table class="table responsive" id="TablaListaLotes" style="width: 100%">
      <thead class="">
        <tr>
          <th scope="col d-flex justify-content-center" class="all 5-%">#</th>
          <th scope="col d-flex justify-content-center" class="all">Folio</th>
          <th scope="col d-flex justify-content-center" class="all">Estatus</th>
          <th scope="col d-flex justify-content-center" class="all 5-%">Formato</th>
          <th scope="col d-flex justify-content-center" class="none">Fecha registro:</th>
          <th scope="col d-flex justify-content-center" class="none">Registrado por: </th>

      </thead>
    </table>
  </div>


  <!-- Tercera Columna visual -->
  <div id="reload-selectable">

  </div>
</div>