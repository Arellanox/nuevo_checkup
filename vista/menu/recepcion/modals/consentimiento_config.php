<div class="modal fade" id="modalConsentimientoConfiguracion" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-consentimientoConfiguracion">Consentimiento de los pacientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="fw-bold">Para poder obtener el consentimiento del paciente, rellene los campos necesarios para continuar</p>
                <div class="row my-3">
                    <div class="col-12 col-xl-6" id="formularios_consentimiento">

                    </div>
                    <div class="col-12 col-xl-6">

                        <div class="" id="qr" style="display: none;">
                            <p class="text-center fw-bold">
                                Escanee el QR para firmar el consentimiento
                            </p>
                            <p class="text-center">Escanee el qr para visualizar el consentimiento del paciente</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar</button>

                <button type="submit" class="btn btn-confirmar" id="btn-solicitar-consentimiento" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Solicitar el QR para poder visualizar y firmar el consentimiento del paciente">
                    <i class="bi bi-check2-square"></i> Solicitar Consentimiento
                </button>
            </div>
        </div>
    </div>
</div>


<style>
    #formularios_consentimiento {
        max-height: 60vh;
        position: relative;
        overflow: auto !important;
    }
</style>