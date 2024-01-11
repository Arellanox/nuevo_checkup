<div class="modal fade" id="modalReporteExcel" tabindex="-1" data-bs-backdrop="static" data-bs-focus="false" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered modal-dialog-scrollable" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportemodaltitle">Reporte de la lista de asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <div class=" rounded p-3 shadow border">
                            <div class="row">
                                <div class="col-12 col-xl-5">
                                    <div class="mb-2">
                                        <label for="FechaInicio">Fecha de Inicio:</label>
                                        <input type="date" name="FechaInicio" value="" class="form-control input-form" required id="FechaInicio">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-5">
                                    <div class="mb-2">
                                        <label for="FechaFinal">Fecha Final:</label>
                                        <input type="date" name="FechaFinal" value="" class="form-control input-form" required id="FechaFinal">
                                    </div>
                                </div>
                                <div class="col-12 col-xl-2">
                                    <div class="mb-2 mt-4">
                                        <button type="button" class="btn btn-secondary buttons-excel buttons-html5 btn-success" id="generTablaReporte">
                                            <i class="bi bi-search"></i> Consultar Información
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 ">
                    <div class="col-3">
                        <div class="rounded p-3 shadow border">
                            <h5>Tabla usuarios</h5>
                            <table id="tablaUsuariosFiltro" class="table table-hover display responsive"></table>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-12">
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
                            <div class="col-12">
                                <div class="rounded p-3 shadow border mt-2" id="divtablaReporteAsistencias" style="display: none;">
                                    <h5>Asistencias</h5>
                                    <table id="tablaReporteAsistencias" class="table table-hover display responsive"></table>
                                </div>
                            </div>
                        </div>
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