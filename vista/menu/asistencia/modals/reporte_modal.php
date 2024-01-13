<div class="modal fade" id="modalReporteExcel" tabindex="-1" data-bs-backdrop="static" data-bs-focus="false" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportemodaltitle">Reporte de la lista de asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- tabs para movil -->
                <div id="tab-button"></div>

                <div class="row mt-2 ">

                    <!-- Columna 1 - tabla de usuarios -->
                    <div class="col-12 col-xl-3 tab-first" id="tab-usuarios" style="margin-right: -5px !important;">
                        <div class="rounded p-3 shadow" id="lista-pacientes">
                            <h5>Tabla usuarios</h5>
                            <table id="tablaUsuariosFiltro" class="table table-hover display responsive"></table>
                        </div>
                    </div>

                    <!-- Columna 2 - Configuración de fecha e información del usuario -->
                    <div class="col-12 col-xl-4 tab-second d-lg-block" id="tab-informacion" style="margin-right: -5px !important;">
                        <!-- Configuración de fechas -->
                        <div class=" rounded p-3 shadow border">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="mb-2">
                                        <label for="FechaInicio">Fecha de Inicio:</label>
                                        <input type="date" name="FechaInicio" value="" class="form-control input-form" required id="FechaInicio">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="mb-2">
                                        <label for="FechaFinal">Fecha Final:</label>
                                        <input type="date" name="FechaFinal" value="" class="form-control input-form" required id="FechaFinal">
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <div>
                                        <button type="button" class="btn btn-secondary buttons-excel buttons-html5 btn-success" id="consultarInformacion">
                                            <i class="bi bi-search"></i> Consultar Información
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Información de horario -->
                        <div class="rounded p-3 shadow border" id="divHorarios" style="display: none;">
                            <div class="d-flex justify-content-center gap-4">
                                <div class="d-flex">
                                    <h5 class=" ">
                                        Horario de entrada:
                                        <strong>09:00 AM</strong>
                                    </h5>
                                </div>
                                <div class="d-flex">
                                    <h5 class=" ">Horario de salida:
                                        <strong>05:00 PM</strong>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Columna 3 - Tabla de registros -->
                    <div class="col-12 col-xl-5 tab-second" id="tab-reporte" style="margin-right: -5px !important;  display:none !important">
                        <div class="rounded p-3 shadow" id="divtablaReporteAsistencias">
                            <h5>Asistencias</h5>
                            <table id="tablaReporteAsistencias" class="table table-hover display responsive"></table>
                        </div>
                    </div>


                    <!-- Tercera Columna visual -->
                    <div id="reload-selectable">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-secondary buttons-excel buttons-html5 btn-success" id="generReporteExcel">
                    <i class="fa fa-file-excel-o"></i> Generar Reporte
                </button>
            </div>
        </div>
    </div>
</div>