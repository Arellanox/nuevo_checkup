<div class="modal fade" id="ModalRegistrarPrueba" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">Utilice su <strong>CURP</strong> para crear su registro de laboratorio</p>
        <form class="row" id="formRegistrarPaciente">
          <div class="row">
            <div class="col-12 col-lg-4">
                <label for="procedencia" class="form-label">CURP</label>
                <input type="text" name="procedencia" value="" class="input-form">
            </div>
            <div class="col-12 col-lg-4" style="margin-bottom: 10px;">
              <label for="selectpaciente" class="form-label">Buscar paciente</label>
              <div class="row">
                <div class="col-auto">
                  <button class="btn btn-sm btn-confirmar" type="button"  id="actualizarForm"><i class="bi bi-binoculars"></i> Consultar</button>
                </div>
                <div class="col-auto">
                  <button class="btn btn-sm btn-borrar" type="button"><i class="bi bi-eraser"></i> Limpiar</button>
                </div>
              </div>
            </div>

            <div class="accordion accordion-flush" id="accordionEstudios">
              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Historia Clinica Laboral
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                        <div class="row">
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkClinica">
                                <label class="d-flex justify-content-center" for="checkClinica">Historia Clinica Laboral</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="2" aria-label="Checkbox for following text input" id="checkMesometria">
                                <label class="d-flex justify-content-center" for="checkMesometria">Mesometria</label>
                              </div>
                            </div>
                          </div>
                        </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Vision
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkVision">
                              <label class="d-flex justify-content-center" for="checkVision">Agudeza visual y<br />Visión a colores</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="2" aria-label="Checkbox for following text input" id="checkTonometria">
                              <label class="d-flex justify-content-center" for="checkTonometria">Tonometría</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    AUDICION
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkAudiometria">
                              <label class="d-flex justify-content-center" for="checkAudiometria">Audiometría</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading4">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    Examenes de sangre
                  </button>
                </h2>
                <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkGrupoRH">
                              <label class="d-flex justify-content-center" for="checkGrupoRH">Grupo y RH</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkBiometria">
                              <label class="d-flex justify-content-center" for="checkBiometria">Biometría</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkGlobular">
                              <label class="d-flex justify-content-center" for="checkGlobular">Sedimentación globular</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkHepatica">
                              <label class="d-flex justify-content-center" for="checkHepatica">Función hepática</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checklipidos">
                              <label class="d-flex justify-content-center" for="checklipidos">Perfil de lípidos</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkGlucosa">
                              <label class="d-flex justify-content-center" for="checkGlucosa">Glucosa</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkUrea">
                              <label class="d-flex justify-content-center" for="checkUrea">Urea</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkCreatinina">
                              <label class="d-flex justify-content-center" for="checkCreatinina">Creatinina</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkAcidoUrico">
                              <label class="d-flex justify-content-center" for="checkAcidoUrico">Ácido Úrico</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkCEA">
                              <label class="d-flex justify-content-center" for="checkCEA">CEA</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkTSH">
                              <label class="d-flex justify-content-center" for="checkTSH">TSH</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkAlcalina">
                              <label class="d-flex justify-content-center" for="checkAlcalina">Fosfatasa alcalina</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading5">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    Orina
                  </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkGeneral">
                              <label class="d-flex justify-content-center" for="checkGeneral">Examen General</label>
                            </div>
                          </div>
                        </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkToxicológico">
                                <label class="d-flex justify-content-center" for="checkToxicológico">Perfil toxicológico</label>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading6">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                    Aparato digestivo
                  </button>
                </h2>
                <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkCoproparasitoscopico">
                              <label class="d-flex justify-content-center" for="checkCoproparasitoscopico">Coproparasitoscópico</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkSangreHeces">
                              <label class="d-flex justify-content-center" for="checkSangreHeces">Sangre en heces</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkUltrasonido">
                              <label class="d-flex justify-content-center" for="checkUltrasonido">Ultrasonido abdominal y pélvico</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading5">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    Orina
                  </button>
                </h2>
                <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkGeneral">
                              <label class="d-flex justify-content-center" for="checkGeneral">Examen General</label>
                            </div>
                          </div>
                        </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" value="1" aria-label="Checkbox for following text input" id="checkToxicológico">
                                <label class="d-flex justify-content-center" for="checkToxicológico">Perfil toxicológico</label>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarPaciente" class="btn btn-confirmar">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
