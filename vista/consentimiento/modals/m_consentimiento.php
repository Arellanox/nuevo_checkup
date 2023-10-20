<div class="modal fade" id="consentimiento_paciente_modal" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="temperaturaPdfTitle">Vista previa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row container-pages my-3">
                    <!-- Section con el reporte y check para dar el consentimiento -->
                    <section class="page" style="display: none;">
                        <!-- Reporte del paciente con su firma y datos -->
                        <div class="col-12">
                            <h1>ventana 1</h1>
                            <!-- <div id="pdfviewer h-100" style="height: 100%;">
                                <div id="adobe-dc-view"></div>
                            </div> -->
                        </div>
                        <!-- Checkbox para dar su consentimiento -->
                        <div class="col-12 my-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="consentimiento_check">
                                <label class="form-check-label" for="consentimiento_check" data-bs-toggle='tooltip' data-bs-placement='top' title="Si estas de acuerdo en dar tu consentimiento da click a esta casilla">
                                    Doy mi consentimiento.
                                </label>
                            </div>
                        </div>
                    </section>

                    <section class="page" style="display: none;">
                        <!-- Reporte del paciente con su firma y datos -->
                        <div class="col-12">
                            <h1>ventana 2</h1>
                            <!-- <div id="pdfviewer h-100" style="height: 100%;">
                                <div id="adobe-dc-view"></div>
                            </div> -->
                        </div>
                        <!-- Checkbox para dar su consentimiento -->
                        <div class="col-12 my-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="consentimiento_check">
                                <label class="form-check-label" for="consentimiento_check" data-bs-toggle='tooltip' data-bs-placement='top' title="Si estas de acuerdo en dar tu consentimiento da click a esta casilla">
                                    Doy mi consentimiento.
                                </label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <div class="modal-footer">
                <!-- Paginacion del formulario -->
                <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="back">
                    <i class="bi bi-arrow-left"></i>
                    Regresar</button>
                <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="next">
                    <i class="bi bi-arrow-right"></i>
                    Siguiente</button>
                <!-- /////// -->
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cerrar
                </button>
                <button type="submit" class="btn btn-confirmar" data-bs-toggle='tooltip' data-bs-placement='top' title="Se enviara mi reporte y doy mi consentimiento" id="btn-enviar-consentimiento">
                    <i class="bi bi-box-arrow-down"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    .page.animate__animated {
        animation-duration: 0.5s;
        /* Ajusta este valor según lo rápido que quieras que sea */
    }

    .container-pages {
        position: relative;
    }

    .page {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
    }
</style>