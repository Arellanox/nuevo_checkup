<div class="modal fade" id="modalReporteExcel" tabindex="-1" data-bs-backdrop="static" data-bs-focus="false" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportemodaltitle">Reporte de la lista de asistencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-xl-12">
                        <div class="mb-3">
                            <label for="FechaInicio">Fecha de Inicio:</label>
                            <input type="date" name="FechaInicio" value="" class="form-control input-form" required id="FechaInicio">
                        </div>
                    </div>
                    <div class="col-12 col-xl-12">
                        <div class="mb-3">
                            <label for="FechaFinal">Fecha Final:</label>
                            <input type="date" name="FechaFinal" value="" class="form-control input-form" required id="FechaFinal">
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