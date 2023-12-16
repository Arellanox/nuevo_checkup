<div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
</div>



<!-- tabs para movil -->
<div id="tab-button"></div>

<div class="row">
    <div class="col-12 col-xl-4 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
        <div class="rounded p-3 shadow my-2" id="lista-pacientes">
            <h4>Lista de pacientes</h4>
            <table class="table table-hover display responsive tableContenido" id="TablaPacientesPrequirurgica" style="width: 100%">
                <thead class="" style="width: 100%">
                    <tr>
                        <th scope="col d-flex justify-content-center" class="all">#</th>
                        <th scope="col d-flex j ustify-content-center" class="all">Nombre</th>
                        <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
                        <th scope="col d-flex justify-content-center" class="none">Procedencia</th>
                        <th scope="col d-flex justify-content-center" class="none">Edad</th>
                        <th scope="col d-flex justify-content-center" class="none">Sexo</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-12 col-xl-4 tab-second" id="tab-informacion" style="margin-right: -5px !important;">
        <div class="rounded p-3 shadow my-2" id="panel-informacion"> </div>

    </div>
    <div class="col-12 col-xl-4 tab-second" id="tab-reporte" style="margin-right: -5px !important;">
        <div class="rounded p-3 shadow my-2">
            <div class="row">
                <div class="col-12 col-lg-7">
                    <h4>Reporte de interpretación</h4>
                    <p class="none-p"></p>
                </div>
                <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
                    <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-interpretacionPrequi">
                        <i class="bi bi-clipboard2-plus"></i> Subir interpretación
                    </button>


                </div>

                <div id="mostrarResultado" style="display: none;">

                    <h5>Resultados del paciente:</h5>
                    <div class="accordion" id="resultadosServicios-areas">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tercera Columna visual -->
    <div id="reload-selectable">

    </div>
</div>