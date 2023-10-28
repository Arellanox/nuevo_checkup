<div class="modal fade" id="modalConsentimientoConfiguracion" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-consentimientoConfiguracion">Consentimiento de los pacientes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Para poder obtener el consentimiento del paciente, rellene los campos necesarios para continuar</p>
                <div class="row my-3">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="quimico" class="form-label p-0 m-0">Quimico en turno:</label>
                                    <select class="form-select input-form" name="   quimico" id=" quimico" required>
                                        <option selected>Elige un quimico</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="muestra" class="form-label p-0 m-0">Tomador de muestra:</label>
                                    <select class="form-select input-form" name="   muestra" id=" muestra" required>
                                        <option selected>Elige el que va a tomar la muestra</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="medico" class="form-label p-0 m-0">Medico:</label>
                                    <select class="form-select input-form" name="   medico" id=" medico" required>
                                        <option selected>Elige un medico</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <p class="text-center fw-bold">
                            Escanee el qr para firmar el consentimiento
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar</button>

                <button type="submit" class="btn btn-confirmar" id="btn-solicitar-consentimiento" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Solicitar el qr para poder visualizar y firmar el consentimiento del paciente">
                    <i class="bi bi-check2-square"></i> Solicitar Consentimiento
                </button>
            </div>
        </div>
    </div>
</div>