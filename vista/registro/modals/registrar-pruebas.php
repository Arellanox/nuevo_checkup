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
            <div class="card ">
              <h4 class="m-3">Antecedentes</h4>
              <hr class="dropdown-divider">
              <div class="accordion" id="accordionEstudios">
                <div class="accordion-item bg-acordion">
                  <h2 class="accordion-header" id="collapalergias">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAlergiasTarget" aria-expanded="true" aria-controls="accordionEstudios">
                      <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Alergias
                    </button>
                  </h2>
                  <div id="collapseAlergiasTarget" class="accordion-collapse collapse show" aria-labelledby="collapalergias">
                    <div class="accordion-body">
                      <div class="text-center">
                        <label for="inputBuscarTableListaNuevos">Ingrese la alergia:</label>
                        <input type="text" class="form-control input-form" name="inputBuscarTableListaNuevos" value="" style="display: unset !important;width:auto !important" >
                      </div>
                      <div class="d-flex justify-content-center align-items-center mt-3" >
                        <div class="card" style="width: 70%">
                          <ul class="list-group" >
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-10 d-flex justify-content-start align-items-center">
                                  A second item
                                </div>
                                <div class="col-2 d-flex justify-content-end">
                                  <a href="#"><i class="bi bi-trash3" style="zoom:140%"></i></a>
                                </div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="accordion-item bg-acordion">
                  <h2 class="accordion-header" id="collappatologicos">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePatologicosTarget" aria-expanded="false" aria-controls="accordionEstudios">
                      <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Antecedentes patológicos
                    </button>
                  </h2>
                  <div id="collapsePatologicosTarget" class="accordion-collapse collapse" aria-labelledby="collappatologicos">
                    <div class="accordion-body">
                      <?php
                        $Antecedentes = array(array('name' => "Hospitalización previa", 'id' => 'HP'),
                                              array('name' => "Cirugias previas", 'id' => 'CR'),
                                              array('name' => "Diabetes", 'id' => 'Dia')
                                              array('name' => "Enfermedades toroideas", 'id' => 'ET'));



                       ?>
                      <div class="row"style="zoom:110%;margin-left:5%;width: 70%">
                        <div class="col-6">
                          <label for="" >Hospitalización previa: </label>
                        </div>
                        <div class="col-3">
                          <input type="radio" id="pato-HP" name="Pato-HP" value="1" required  onclick="collapse('#CollapsePato-HP', true)">
                          <label for="pato-HP">Si</label>
                        </div>
                        <div class="col-3">
                          <input type="radio"  id="pato-HP" name="Pato-HP" value="0" required onclick="collapse('#CollapsePato-HP', false)">
                          <label for="pato-HP" >No</label>
                        </div>
                        <div class="collapse" id="CollapsePato-HP">
                          <textarea name="name" class="form-control input-form" rows="2" cols="2" placeholder="Comentario..."></textarea>
                        </div>
                      </div>
                      <div class="row"style="zoom:110%;margin-left:5%;width: 70%">
                        <div class="col-6">
                          <label for="" >CIRUGIAS PREVIAS: </label>
                        </div>
                        <div class="col-3">
                          <input type="radio" id="pato-CR" name="Pato-CR" value="1" required  onclick="collapse('#CollapsePato-CR', true)">
                          <label for="pato-CR">Si</label>
                        </div>
                        <div class="col-3">
                          <input type="radio"  id="pato-CR" name="Pato-CR" value="0" required onclick="collapse('#CollapsePato-CR', false)">
                          <label for="pato-CR" >No</label>
                        </div>
                        <div class="collapse" id="CollapsePato-CR">
                          <textarea name="name" class="form-control input-form" rows="2" cols="2" placeholder="Comentario..."></textarea>
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
<script type="text/javascript">
  function collapse(collapID, valor){
    if (valor == true) {
      $(collapID).collapse("show")
    }else{
      $(collapID).collapse("hide")
    }
  }
</script>
