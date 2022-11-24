<div class="modal fade" id="modalPacienteAceptar" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="title-paciente_aceptar">Nombre paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formAceptarPacienteRecepcion">
          <div class="row">
            <div class="col-8">
              <p>Escanea la identificación del paciente y espere a que se guarde</p>
            </div>
            <div class="col-4">
              <button type="button" class="btn btn-confirmar" id="btn-obtenerID">
                <i class="bi bi-person-badge"></i> Obtener ID
              </button>
            </div>
          </div>
          <p style="margin-top:20px"> <strong>Verifique los siguientes datos</strong> </p>
          <div class="row">
            <div class="col-12 col-lg-6">
              <p class="text-center" >Estudios del paciente</p>
              <div class="col-12">
                  <label for="paquete" class="form-label">Seleccionar un paquete</label>
                  <select class="" id="select-paquetes">
                  </select>
                  <div class="mt-3">
                    <textarea rows="4" cols="90" class="input-form" placeholder="Observaciones" id="Observaciones-aceptar"></textarea>
                  </div>
              </div>
              <!-- <div class="overflow-auto" style="max-width: 100%; max-height: 220px;margin-bottom:10px;">
                <ul class="list-group" id="list-estudiosPaciente">
                  <li class="list-group-item">An item</li>
                  <li class="list-group-item">A second item</li>
                  <li class="list-group-item">A third item</li>
                </ul>
              </div> -->
            </div>
            <div class="col-12 col-lg-6">
              <p class="text-center" >Identificación</p>
              <div class="overflow-hidden" style="max-width: 100%; max-height: 235px;">
                <img src="https://mdbootstrap.com/img/Others/documentation/img%20(131)-mini.jpg" class="img-fluid" alt="Responsive image" id="image-perfil">
              </div>
            </div>
            <div class="col-12">
              <h4>Añade mas estudios</h4>
              <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      Estudios de laboratorio
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="row">
                            <div class="col-12">
                              <select class="" id="select-lab">
                              </select>
                            </div>
                            <div class="col-12">
                              <button type="button" class="btn btn-confirmar" id="btn-AgregarEstudioLab">
                                <i class="bi bi-person-badge"></i> Agregar
                              </button>
                            </div>
                            <div class="col-12 mt-3">
                              <label for="paquete" class="form-label">Orden médica de laboratorio:</label>
                              <input type="file" name="orden-medica-laboratorio[]" id="file-laboratorio" class="form-control input-form" value="">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <ul class="list-group" id="list-estudios-laboratorio">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Estudios de Rayos X
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="row">
                            <div class="col-12">
                              <select class="" id="select-rx">
                              </select>
                            </div>
                            <div class="col-12">
                              <button type="button" class="btn btn-confirmar" id="btn-agregarEstudioRX">
                                <i class="bi bi-person-badge"></i> Agregar
                              </button>
                            </div>
                            <div class="col-12 mt-3">
                              <label for="paquete" class="form-label">Orden médica de Rayos X:</label>
                              <input type="file" name="orden-medica-rx[]" id="file-r-x" class="form-control input-form" value="">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <ul class="list-group" id="list-estudios-rx">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Estudios de Ultra Sonido
                    </button>
                  </h2>
                  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="row">
                            <div class="col-12">
                              <select class="" id="select-us">
                              </select>
                            </div>
                            <div class="col-12">
                              <button type="button" class="btn btn-confirmar" id="btn-agregarEstudioImg">
                                <i class="bi bi-person-badge"></i> Agregar
                              </button>
                            </div>
                            <div class="col-12 mt-3">
                              <label for="paquete" class="form-label">Orden médica de Ultra Sonido:</label>
                              <input type="file" name="orden-medica-us[]" id="file-ultra-sonido" class="form-control input-form">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <ul class="list-group" id="list-estudios-ultrasonido">
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Otros estudios
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-6">
                          <div class="row">
                            <div class="col-12">
                              <select class="" id="select-otros">
                              </select>
                            </div>
                            <div class="col-12">
                              <button type="button" class="btn btn-confirmar" id="btn-agregarEstudioOtros">
                                <i class="bi bi-person-badge"></i> Agregar
                              </button>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <ul class="list-group" id="list-estudios-otros">
                          </ul>
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
        <button type="submit" form="formAceptarPacienteRecepcion" class="btn btn-confirmar" id="btn-confirmar-paciente">
          <i class="bi bi-check2-square"></i> Aceptar paciente
        </button>
      </div>
    </div>
  </div>
</div>
