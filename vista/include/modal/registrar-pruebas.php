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
            <div class="col-12 col-lg-8">
                <label for="procedencia" class="form-label">CURP</label>
                <select class="" name="curp" id="selectCURPPaciente" style="width:100%;">

                      <option value="1" >Ninguno...</opcion>
                      <option value="PFIZER">PFIZER</opcion>
                      <option value="ASTRA ZENECA" >ASTRA ZENECA</opcion>
                      <option value="SPUTNIK V" >SPUTNIK V</opcion>
                      <option value="SINOVAC" >SINOVAC</opcion>
                      <option value="CANSINO" >CANSINO</opcion>
                      <option value="MODERNA" >MODERNA</opcion>
                      <option value="COVAX" >COVAX</opcion>
                      <option value="JOHNSON & JOHNSON" >JOHNSON & JOHNSON</opcion>
                      <option value="SINOPHARM" >SINOPHARM</opcion>
                      <option value="OTRA">OTRA (ESPECIFIQUE)</opcion>
                </select>
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
                    Historia Clinica Laboral
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionEstudios">
                  <div class="accordion-body">
                        <div class="row">
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="1" aria-label="Checkbox for following text input" id="checkClinica">
                                <label class="d-flex justify-content-center" for="checkClinica">Historia Clinica Laboral</label>
                              </div>
                            </div>
                          </div>
                          <div class="col-auto">
                            <div class="input-group mb-3">
                              <div class="input-group-text">
                                <input class="form-check-input mt-0" type="checkbox" name="estudiosLab[]" value="2" aria-label="Checkbox for following text input" id="checkMesometria">
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
                    AUDICION
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
<script type="text/javascript">

const modalRegistrarPrueba = document.getElementById('ModalRegistrarPrueba')
modalRegistrarPrueba.addEventListener('show.bs.modal', event => {
  // Colocar ajax
  var select = document.getElementById("selectCURPPaciente"),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  // If necessary, you could initiate an AJAX request here
  $.ajax({
    url: "https://bimo-lab.com/includeHTML/formularios/php/consulta-paciente-ingreso.php",
    type: "POST",
    success: function(data) {
      var data = jQuery.parseJSON(data);
      //Equipo Utilizado
      console.log(data);
      var select = document.getElementById("selectCURPPaciente");
      for (var i = 0; i < data.length; i++) {
        var content = data[i]['nombre']+" - "+ data[i]['curp']+" - "+data[i]['prefolio'];
        var value = data[i]['id_paciente'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        select.appendChild(el);
      }
    }
  })
})


//Formulario de registro de pruebas
$('#formDIV *').prop('disabled',true);
$('#btnFormRegistrarPruba').prop('disabled',true);

$('#actualizarForm').click(function(){
  //Solicitar si la curp existe
  document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                   'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                '</div>';
  $('#formDIV *').prop('disabled',false);
  $('#btnFormRegistrarPruba').prop('disabled',false);
  curp = document.getElementById("selectCURPPaciente").value;
  $.ajax({
    data: {curp:curp},
    url: "??",
    type: "POST",
    processData: false,
    contentType: false,
    success: function(data) {
      data = jQuery.parseJSON(data);
      switch (data['codigo'] == 1) {
        case 1:
          Toast.fire({
            icon: 'success',
            title: 'CURP valida...',
            timer: 2000
          });
          document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                           'CURP aceptada, concluya el registro seleccionando el estudio a realizar.'+
                                                        '</div>';
          document.getElementById("paciente-registro").innerHTML = "Paciente";
          document.getElementById("cupr-registro").innerHTML = "CURP";
          document.getElementById("sexo-registro").innerHTML = "sexo";

          $('#formDIV *').prop('disabled',false);
          $('#btnFormRegistrarPruba').prop('disabled',false);
        break;
        case "error":
         document.getElementById("mensaje").innerHTML = data['error']; //Mensaje desde api o funcion
        break
        default:
          Swal.fire({
             icon: 'error',
             title: 'Oops...',
             text: 'Hubo un problema!',
             footer: 'Reporte este error con el personal :)'
          })
      }
    },
  });
})

$("#formRegistrarPrueba").submit(function(event){
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formRegistrarPrueba");
    var formData = new FormData(form);
    console.log(formData.get('estudiosLab[]'))
    if (formData.get('estudiosLab[]') == null) {
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'No ha seleccionado ninguna prueba!',
      })
      return
    }
    formData.set('api', 3);
    // console.log(formData);
    Swal.fire({
       title: '¿Está seguro de haber seleccionado todo?',
       text: "¡No podrá volverse a regisrtrar con su CURP hasta terminar la solicitud de registro anterior!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Si, registrame',
       cancelButtonText: "Cancelar"
     }).then((result) => {
       if (result.isConfirmed) {
         $("#btn-registrarse").prop('disabled', true);

         $.ajax({
           data: formData,
           url: "??",
           type: "POST",
           processData: false,
           contentType: false,
           success: function(data) {
             data = jQuery.parseJSON(data);
             switch (data['codigo'] == 1) {
               case 1:
                 Toast.fire({
                   icon: 'success',
                   title: 'Su información a sido registrada :)',
                   timer: 2000
                 });
                 // Autocompletar el campo de prefolio y CURP en consulta de resultado

                 document.getElementById("formRegistrarPrueba").reset();
                 $("#ModalRegistrarPrueba").modal('hide');
               break;
               default:
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un problema!',
                    footer: 'Reporte este error con el personal :)'
                 })
             }
           },
         });
       }
     })
})
 // $("#formDIV").addClass("disable-div");

 $('#selectCURPPaciente').select2({
   dropdownParent: $('#ModalRegistrarPrueba'),
   tags: true
 });
</script>
