<div class="modal fade" id="ModalRegistrarPrueba" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true" data-bs-backdrop="static">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-center">Utilice su <strong>CURP</strong> para crear su registro de laboratorio</p>
        <form id="formRegistrarPrueba">
          <div class="row">
            <div class="col-12 col-lg-4">
                <label for="curp" class="form-label">CURP</label>
                <input type="text" name="curp" value="" class="form-control input-form" id="curp-paciente" required>
            </div>
            <div class="col-12 col-lg-4" style="margin-bottom: 10px;">
                <label for="selectpaciente" class="form-label">Buscar paciente</label>
                <div class="row">
                  <div class="col-auto">
                    <button class="btn btn-sm btn-confirmar" type="button" id="actualizarForm"><i class="bi bi-binoculars"></i> Consultar</button>
                  </div>
                  <div class="col-auto">
                    <button class="btn btn-sm btn-borrar" type="button" id="eliminarForm" ><i class="bi bi-eraser"></i> Limpiar</button>
                  </div>
                </div>
              </div>
          </div>
          <div id="formDIV">
            <p id="mensaje" class="text-center"></p>
            <div class="row">
              <div class="col-auto">
                <p>Paciente:</p>
                <p id="paciente-registro">Luis Gerardo Cuevas González</p>
              </div>
              <div class="col-auto">
                <p>CURP:</p>
                <p id="cupr-registro">GLSUB2928NA28AN</p>
              </div>
              <div class="col-auto">
                <p>Sexo</p>
                <p id="sexo-registro">MASCULINO</p>
              </div>
            </div>

            <div class="accordion accordion-flush" id="accordionEstudios">
              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Historia clínica laboral
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                        <div class="row">
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="1" aria-label="Checkbox for following text input" id="checkClinica">
                                <label class="d-flex justify-content-center" for="checkClinica">Consultorio</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="2" aria-label="Checkbox for following text input" id="checkMesometria">
                                <label class="d-flex justify-content-center" for="checkMesometria">Mesometría</label>
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
                    Visión
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="3" aria-label="Checkbox for following text input" id="checkVision">
                              <label class="d-flex justify-content-center" for="checkVision">Agudeza visual y<br />Visión a colores</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="4" aria-label="Checkbox for following text input" id="checkTonometria">
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
                    Audición
                  </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="5" aria-label="Checkbox for following text input" id="checkAudiometria">
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
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="6" aria-label="Checkbox for following text input" id="checkGrupoRH">
                              <label class="d-flex justify-content-center" for="checkGrupoRH">Grupo y RH</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="7" aria-label="Checkbox for following text input" id="checkBiometria">
                              <label class="d-flex justify-content-center" for="checkBiometria">Biometría</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="8" aria-label="Checkbox for following text input" id="checkGlobular">
                              <label class="d-flex justify-content-center" for="checkGlobular">Sedimentación globular</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="9" aria-label="Checkbox for following text input" id="checkHepatica">
                              <label class="d-flex justify-content-center" for="checkHepatica">Función hepática</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="10" aria-label="Checkbox for following text input" id="checklipidos">
                              <label class="d-flex justify-content-center" for="checklipidos">Perfil de lípidos</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="11" aria-label="Checkbox for following text input" id="checkGlucosa">
                              <label class="d-flex justify-content-center" for="checkGlucosa">Glucosa</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="12" aria-label="Checkbox for following text input" id="checkUrea">
                              <label class="d-flex justify-content-center" for="checkUrea">Urea</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="13" aria-label="Checkbox for following text input" id="checkCreatinina">
                              <label class="d-flex justify-content-center" for="checkCreatinina">Creatinina</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="14" aria-label="Checkbox for following text input" id="checkAcidoUrico">
                              <label class="d-flex justify-content-center" for="checkAcidoUrico">Ácido Úrico</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="15" aria-label="Checkbox for following text input" id="checkCEA">
                              <label class="d-flex justify-content-center" for="checkCEA">CEA</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="16" aria-label="Checkbox for following text input" id="checkTSH">
                              <label class="d-flex justify-content-center" for="checkTSH">TSH</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="17" aria-label="Checkbox for following text input" id="checkAlcalina">
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
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="18" aria-label="Checkbox for following text input" id="checkGeneral">
                              <label class="d-flex justify-content-center" for="checkGeneral">Examen General</label>
                            </div>
                          </div>
                        </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="19" aria-label="Checkbox for following text input" id="checkToxicológico">
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
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="20" aria-label="Checkbox for following text input" id="checkCoproparasitoscopico">
                              <label class="d-flex justify-content-center" for="checkCoproparasitoscopico">Coproparasitoscópico</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="21" aria-label="Checkbox for following text input" id="checkSangreHeces">
                              <label class="d-flex justify-content-center" for="checkSangreHeces">Sangre en heces</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="22" aria-label="Checkbox for following text input" id="checkUltrasonido">
                              <label class="d-flex justify-content-center" for="checkUltrasonido">Ultrasonido abdominal y pélvico</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading7">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                    Pulmonar
                  </button>
                </h2>
                <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="23" aria-label="Checkbox for following text input" id="checkRadiografia">
                              <label class="d-flex justify-content-center" for="checkRadiografia">Radiografía de tórax</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="24" aria-label="Checkbox for following text input" id="checkEspirometria">
                              <label class="d-flex justify-content-center" for="checkEspirometria">Espirometría</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="headin8">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                    Cardiaco
                  </button>
                </h2>
                <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="headin8" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="25" aria-label="Checkbox for following text input" id="checkElectrocardiograma">
                              <label class="d-flex justify-content-center" for="checkElectrocardiograma">Electrocardiograma en reposo</label>
                            </div>
                          </div>
                        </div>
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="26" aria-label="Checkbox for following text input" id="checkPruebaEsfuerzo">
                              <label class="d-flex justify-content-center" for="checkPruebaEsfuerzo">Prueba de esfuerzo</label>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>


              <div class="accordion-item bg-acordion">
                <h2 class="accordion-header" id="heading9">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                    Estudio adicional para hombre
                  </button>
                </h2>
                <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                      <div class="row">
                        <div class="col-auto">
                          <div class="input-group mb-3">
                            <div class="input-group-text">
                              <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="27" aria-label="Checkbox for following text input" id="checkPSA">
                              <label class="d-flex justify-content-center" for="checkPSA">PSA</label>
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
        <button type="submit" form="formRegistrarPrueba" class="btn btn-confirmar" id="btnFormRegistrarPruba">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
