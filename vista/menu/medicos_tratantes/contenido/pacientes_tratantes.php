<!-- <div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
</div> -->
<!-- Vista de la ujat parecia al menu principal de BIMO :) -->
<div class="row">
    <div class="col-12 col-xl-12 col-lg-12">
        <div class="rounded p-1 shadow my-2">
            <div class="row">
                <div class="col-12">
                    <p class="mt-2 mx-2">
                        Pacientes que estan relacionados con el médico tratante
                    </p>
                </div>

            </div>

            <!-- Tabla -->
            <div class="p-3" id="TablaPacientesTratantesContainer">
                <table class="table table-hover display responsive" id="tablaPacientesTratantes" style="width: 100%;">
                    <thead>
                        <tr>
                            <th scope="" class="col-number all">#</th>
                            <th scope="" class="col-20% all">Fecha recepcion</th>
                            <!-- <th scope="" class="col-20% mobile-l desktop">Procedencia</th> -->
                            <th scope="" class="col-8% all">Descripcion</th>
                            <th scope="" class="col-8% desktop">Paciente (Nombre)</th>

                            <!-- Laboratorio 4 -->
                            <th scope="" class="col-icons min-tablet">Prefolio.</th>

                            <th scope="" class="all tools"><i class="bi bi-info-square"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Off canvas -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasInfoPrincipal" aria-labelledby="offcanvasInfoPrincipalLabel">
    <div class="d-flex flex-column flex-shrink-0 p-3 off-canvas-container" style="width: 100%;height:100%">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="bi bi-person-bounding-box"></i> Información
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr>
        <div class="offcanvas-body">
            <div class="" id="panel-muestras-estudios"></div>
        </div>
    </div>
</div>