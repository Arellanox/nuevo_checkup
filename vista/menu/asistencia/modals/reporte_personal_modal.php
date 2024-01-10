<div class="modal fade" id="modalReportePersonal" tabindex="-1" data-bs-backdrop="static" data-bs-focus="false" data-bs-keyboard="true" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reportemodaltitle">Reporte individual de asistencias</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6 col-xl-6">
                        <div class="mb-3">
                            <label for="FechaInicioPdf">Fecha de Inicio:</label>
                            <input type="date" name="FechaInicioPdf" value="" class="form-control input-form" required id="FechaInicioPdf">
                        </div>
                    </div>
                    <div class="col-6 col-xl-6">
                        <div class="mb-3">
                            <label for="FechaFinalPdf">Fecha Final:</label>
                            <input type="date" name="FechaFinalPdf" value="" class="form-control input-form" required id="FechaFinalPdf">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="vacaciones">Vacaciones:</label>
                            <input type="text" name="vacaciones" value="" class="form-control input-form" required id="vacaciones">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="permisosCGS">Permisos CGS:</label>
                            <input type="text" name="permisosCGS" value="" class="form-control input-form" required id="permisosCGS">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="incapacidad">Incapacidad:</label>
                            <input type="text" name="incapacidad" value="" class="form-control input-form" required id="incapacidad">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="faltaInjustificada">Faltas injustificada:</label>
                            <input type="text" name="faltaInjustificada" value="" class="form-control input-form" required id="faltaInjustificada">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="hrsExtras">Hrs. Extras:</label>
                            <input type="text" name="hrsExtras" value="" class="form-control input-form" required id="hrsExtras">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="permisoSGS">Permiso SGS:</label>
                            <input type="text" name="permisoSGS" value="" class="form-control input-form" required id="permisoSGS">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-secondary  buttons-html5 btn-danger" id="btnReporteEntradasSalidas">
                    <i class="bi bi-filetype-pdf"></i> Generar Reporte
                </button>
            </div>
        </div>
    </div>
</div>