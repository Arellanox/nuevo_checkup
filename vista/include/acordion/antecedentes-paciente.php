<div class="card ">
  <h4 class="m-3">Antecedentes</h4>
  <hr class="dropdown-divider m-2">
  <p class="none-p" style="margin-left: 10px">Rellene todos los campos*</p>
  <div class="accordion m-2" id="accordionEstudios">
    <form class="" id="formAntecedentes">
      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-patologicos">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Patologicos-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES PERSONALES PATOLÓGICOS
          </button>
        </h2>
        <div id="collapse-Patologicos-Target" class="accordion-collapse collapse" aria-labelledby="collap-patologicos">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ERES ALÉRGICO A ALGÚN MEDICAMENTO O ALIMENTO?: </label>
                <input type="hidden" name="check-aler[]" value="1">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-aler" name="check-aler[]" value="1" required >
                <label for="checkSi-aler">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-aler" name="check-aler[]" value="2" required>
                <label for="checkNo-aler" >No</label>
              </div>
              <div class="collapse" id="collapse-aler">
                <textarea name="check-aler[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HAS SUFRIDO DE ALGUNA FRACTURA?: </label>
                <input type="hidden" name="check-frac[]" value="2">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-frac" name="check-frac[]" value="1" required >
                <label for="checkSi-frac">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-frac" name="check-frac[]" value="2" required>
                <label for="checkNo-frac" >No</label>
              </div>
              <div class="collapse" id="collapse-frac">
                <textarea name="check-frac[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES DIABETES MELLITUS?: </label>
                <input type="hidden" name="check-DiaMelli[]" value="3">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-DiaMelli" name="check-DiaMelli[]" value="1" required >
                <label for="checkSi-DiaMelli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-DiaMelli" name="check-DiaMelli[]" value="2" required>
                <label for="checkNo-DiaMelli" >No</label>
              </div>
              <div class="collapse onlyMedico" id="collapse-DiaMelli">
                <textarea name="check-DiaMelli[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES HIPERTENSIÓN ARTERIAL?: </label>
                <input type="hidden" name="check-hiArt[]" value="4">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hiArt" name="check-hiArt[]" value="1" required >
                <label for="checkSi-hiArt">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hiArt" name="check-hiArt[]" value="2" required>
                <label for="checkNo-hiArt" >No</label>
              </div>
              <div class="collapse onlyMedico" id="collapse-hiArt">
                <textarea name="check-hiArt[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES DE COLESTEROL Y TRIGLICERIDOS?: </label>
                <input type="hidden" name="check-disli[]" value="5">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-disli" name="check-disli[]" value="1" required >
                <label for="checkSi-disli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-disli" name="check-disli[]" value="2" required>
                <label for="checkNo-disli" >No</label>
              </div>
              <div class="collapse onlyMedico" id="collapse-disli">
                <textarea name="check-disli[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD RELACIONADA CON LA TIROIDES?: </label>
                <input type="hidden" name="check-enTiro[]" value="6">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enTiro" name="check-enTiro[]" value="1" required >
                <label for="checkSi-enTiro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enTiro" name="check-enTiro[]" value="2" required>
                <label for="checkNo-enTiro" >No</label>
              </div>
              <div class="collapse" id="collapse-enTiro">
                <textarea name="check-enTiro[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD RELACIONADA CON EL CORAZÓN COMO: INSUFICIENCIA CARDIACA, ARRITMIAS, DERRAME CEREBRAL?: </label>
                <input type="hidden" name="check-cardi[]" value="7">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-cardi" name="check-cardi[]" value="1" required >
                <label for="checkSi-cardi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-cardi" name="check-cardi[]" value="2" required>
                <label for="checkNo-cardi" >No</label>
              </div>
              <div class="collapse" id="collapse-cardi">
                <textarea name="check-cardi[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGÚN TIPO DE CÁNCER?: </label>
                <input type="hidden" name="check-cancr[]" value="8">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-cancr" name="check-cancr[]" value="1" required >
                <label for="checkSi-cancr">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-cancr" name="check-cancr[]" value="2" required>
                <label for="checkNo-cancr" >No</label>
              </div>
              <div class="collapse" id="collapse-cancr">
                <textarea name="check-cancr[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA TENIDO ALGUNA TRANSFUSIÓN SANGUINEA?: </label>
                <input type="hidden" name="check-trans[]" value="9">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-trans" name="check-trans[]" value="1" required >
                <label for="checkSi-trans">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-trans" name="check-trans[]" value="2" required>
                <label for="checkNo-trans" >No</label>
              </div>
              <div class="collapse" id="collapse-trans">
                <textarea name="check-trans[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD RESPIRATORIA COMO: ASMA, BRONQUITIS, ENFERMEDAD PULMONAR OBSTRUCTIVA, ENTRE OTRAS?: </label>
                <input type="hidden" name="check-enfRespi[]" value="10">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfRespi" name="check-enfRespi[]" value="1" required >
                <label for="checkSi-enfRespi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfRespi" name="check-enfRespi[]" value="2" required>
                <label for="checkNo-enfRespi" >No</label>
              </div>
              <div class="collapse" id="collapse-enfRespi">
                <textarea name="check-enfRespi[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD GASTROINTESTINAL COMO: GASTRITIS, REFLUJO GASTROESOFÁGICO, PÓLIPOS INTESTINALES, ENTRE OTRAS: </label>
                <input type="hidden" name="check-enfGastro[]" value="11">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfGastro" name="check-enfGastro[]" value="1" required >
                <label for="checkSi-enfGastro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfGastro" name="check-enfGastro[]" value="2" required>
                <label for="checkNo-enfGastro" >No</label>
              </div>
              <div class="collapse" id="collapse-enfGastro">
                <textarea name="check-enfGastro[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES DEPRESIÓN, ANSIEDAD, TRASTORNO DE LA CONDUCTA, ENTRE OTRAS?: </label>
                <input type="hidden" name="check-enfPsiciPsiq[]" value="12">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfPsiciPsiq" name="check-enfPsiciPsiq[]" value="1" required >
                <label for="checkSi-enfPsiciPsiq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfPsiciPsiq" name="check-enfPsiciPsiq[]" value="2" required>
                <label for="checkNo-enfPsiciPsiq" >No</label>
              </div>
              <div class="collapse" id="collapse-enfPsiciPsiq">
                <textarea name="check-enfPsiciPsiq[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA SIDO DIAGNOSTICADO CON TUBERCULOSIS: </label>
                <input type="hidden" name="check-Turberclo[]" value="13">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Turberclo" name="check-Turberclo[]" value="1" required >
                <label for="checkSi-Turberclo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Turberclo" name="check-Turberclo[]" value="2" required>
                <label for="checkNo-Turberclo" >No</label>
              </div>
              <div class="collapse" id="collapse-Turberclo">
                <textarea name="check-Turberclo[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA SUFRIDO ALGÚN TRAUMATISMO EN CABEZA, CARA, COLUMNA CERVICAL, ESGUINCES, ENTRE OTRAS?: </label>
                <input type="hidden" name="check-Trauma[]" value="14">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Trauma" name="check-Trauma[]" value="1" required >
                <label for="checkSi-Trauma">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Trauma" name="check-Trauma[]" value="2" required>
                <label for="checkNo-Trauma" >No</label>
              </div>
              <div class="collapse" id="collapse-Trauma">
                <textarea name="check-Trauma[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA TENIDO ALGUNA ENFERMEDAD DE TRANSMISIÓN SEXUAL?: </label>
                <input type="hidden" name="check-enfTransSex[]" value="15">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfTransSex" name="check-enfTransSex[]" value="1" required >
                <label for="checkSi-enfTransSex">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfTransSex" name="check-enfTransSex[]" value="2" required>
                <label for="checkNo-enfTransSex" >No</label>
              </div>
              <div class="collapse" id="collapse-enfTransSex">
                <textarea name="check-enfTransSex[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA ESTADO HOSPITALIZADO EN ESTE AÑO?: </label>
                <input type="hidden" name="check-hospitaPrevia[]" value="16">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hospitaPrevia" name="check-hospitaPrevia[]" value="1" required >
                <label for="checkSi-hospitaPrevia">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hospitaPrevia" name="check-hospitaPrevia[]" value="2" required>
                <label for="checkNo-hospitaPrevia" >No</label>
              </div>
              <div class="collapse" id="collapse-hospitaPrevia">
                <textarea name="check-hospitaPrevia[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿SE HA SOMETIDO A ALGUNA INTERVENCIÓN QUIRÚRGICA?: </label>
                <input type="hidden" name="check-ciruPrev[]" value="17">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ciruPrev" name="check-ciruPrev[]" value="1" required >
                <label for="checkSi-ciruPrev">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ciruPrev" name="check-ciruPrev[]" value="2" required>
                <label for="checkNo-ciruPrev" >No</label>
              </div>
              <div class="collapse" id="collapse-ciruPrev">
                <textarea name="check-ciruPrev[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-nopatologicos">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-nopatologicos-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES NO PATOLÓGICOS
          </button>
        </h2>
        <div id="collapse-nopatologicos-Target" class="accordion-collapse collapse" aria-labelledby="collap-nopatologicos">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿FUMA?: </label>
                <input type="hidden" name="check-tabaq[]" value="18">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-tabaq" name="check-tabaq[]" value="1" required >
                <label for="checkSi-tabaq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-tabaq" name="check-tabaq[]" value="2" required>
                <label for="checkNo-tabaq" >No</label>
              </div>
              <div class="collapse" id="collapse-tabaq">
                <textarea name="check-tabaq[]" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿CONSUME BEBIDAS ALCOHÓLICAS?: </label>
                <input type="hidden" name="check-alcoh[]" value="19">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-alcoh" name="check-alcoh[]" value="1" required >
                <label for="checkSi-alcoh">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-alcoh" name="check-alcoh[]" value="2" required>
                <label for="checkNo-alcoh" >No</label>
              </div>
              <div class="collapse" id="collapse-alcoh">
                <textarea name="check-alcoh[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿UTILIZA ALGÚN TIPO DE DROGAS?: </label>
                <input type="hidden" name="check-usDrog[]" value="20">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-usDrog" name="check-usDrog[]" value="1" required >
                <label for="checkSi-usDrog">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-usDrog" name="check-usDrog[]" value="2" required>
                <label for="checkNo-usDrog" >No</label>
              </div>
              <div class="collapse" id="collapse-usDrog">
                <textarea name="check-usDrog[]" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿REALIZA ACTIVIDAD FÍSICA FRECUENTEMENTE?: </label>
                <input type="hidden" name="check-actFisica[]" value="21">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-actFisica" name="check-actFisica[]" value="1" required >
                <label for="checkSi-actFisica">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-actFisica" name="check-actFisica[]" value="2" required>
                <label for="checkNo-actFisica" >No</label>
              </div>
              <div class="collapse" id="collapse-actFisica">
                <textarea name="check-actFisica[]" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿SU VIVIENDA CUENTA CON AGUA POTABLE, LUZ Y DRENAJE? : </label>
                <input type="hidden" name="check-viviSerUrba[]" value="22">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-viviSerUrba" name="check-viviSerUrba[]" value="1" required >
                <label for="checkSi-viviSerUrba">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-viviSerUrba" name="check-viviSerUrba[]" value="2" required>
                <label for="checkNo-viviSerUrba" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-viviSerUrba">
                <textarea name="check-viviSerUrba[]" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿TIENE UNA VIDA SEXUAL ACTIVA?: </label>
                <input type="hidden" name="check-actSex[]" value="23">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-actSex" name="check-actSex[]" value="1" required >
                <label for="checkSi-actSex">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-actSex" name="check-actSex[]" value="2" required>
                <label for="checkNo-actSex" >No</label>
              </div>
              <div class="collapse onlyMedico" id="collapse-actSex">
                <textarea name="check-actSex[]" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HA SIDO VACUNADO RECIENTEMENTE?: </label>
                <input type="hidden" name="check-vacReci[]" value="24">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-vacReci" name="check-vacReci[]" value="1" required >
                <label for="checkSi-vacReci">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-vacReci" name="check-vacReci[]" value="2" required>
                <label for="checkNo-vacReci" >No</label>
              </div>
              <div class="collapse" id="collapse-vacReci">
                <textarea name="check-vacReci[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, fecha"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-anteHeredo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-anteHeredo-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES HEREDOFAMILIARES
          </button>
        </h2>
        <div id="collapse-anteHeredo-Target" class="accordion-collapse collapse" aria-labelledby="collap-anteHeredo">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿SU PADRE ESTÁ VIVO?: </label>
                <input type="hidden" name="check-hero-padre[]" value="26">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hero-padre" name="check-hero-padre[]" value="1" required >
                <label for="checkSi-hero-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hero-padre" name="check-hero-padre[]" value="2" required>
                <label for="checkNo-hero-padre">No</label>
              </div>
              <div class="collapse" id="collapse-hero-padre">
                <textarea name="check-hero-padre[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Causa?"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE DIABETES MELLITUS?: </label>
                <input type="hidden" name="check-diabe-padre[]" value="27">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-diabe-padre" name="check-diabe-padre[]" value="1" required >
                <label for="checkSi-diabe-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-diabe-padre" name="check-diabe-padre[]" value="2" required>
                <label for="checkNo-diabe-padre" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-diabe-padre">
                <textarea name="check-diabe-padre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE HIPERTENSIÓN ARTERIAL?: </label>
                <input type="hidden" name="check-hisperArt-padre[]" value="28">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hisperArt-padre" name="check-hisperArt-padre[]" value="1" required >
                <label for="checkSi-hisperArt-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hisperArt-padre" name="check-hisperArt-padre[]" value="2" required>
                <label for="checkNo-hisperArt-padre" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-hisperArt-padre">
                <textarea name="check-hisperArt-padre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE ALGÚN TIPO DE CÁNCER?: </label>
                <input type="hidden" name="check-canc-padre[]" value="29">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-canc-padre" name="check-canc-padre[]" value="1" required >
                <label for="checkSi-canc-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-canc-padre" name="check-canc-padre[]" value="2" required>
                <label for="checkNo-canc-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-canc-padre">
                <textarea name="check-canc-padre[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>

            <!-- <hr class="dropdown-divider m-2"> -->
            <!-- <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>Otras: </label>
                <input type="hidden" name="check-otra-padre[]" value="30">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-otra-padre" name="check-otra-padre[]" value="1" required >
                <label for="checkSi-otra-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-otra-padre" name="check-otra-padre[]" value="2" required>
                <label for="checkNo-otra-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-otra-padre">
                <textarea name="check-otra-padre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div> -->
            <br>
            <!-- <hr class="dropdown-divider m-2"> -->
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿SU MADRE ESTÁ VIVA?: </label>
                <input type="hidden" name="check-hero-madre[]" value="31">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hero-madre" name="check-hero-madre[]" value="1" required >
                <label for="checkSi-hero-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hero-madre" name="check-hero-madre[]" value="2" required>
                <label for="checkNo-hero-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-hero-madre">
                <textarea name="check-hero-madre[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Causa?"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE DIABETES MELLITUS?: </label>
                <input type="hidden" name="check-diabe-madre[]" value="32">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-diabe-madre" name="check-diabe-madre[]" value="1" required >
                <label for="checkSi-diabe-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-diabe-madre" name="check-diabe-madre[]" value="2" required>
                <label for="checkNo-diabe-madre" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-diabe-madre">
                <textarea name="check-diabe-madre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE HIPERTENSIÓN ARTERIAL?: </label>
                <input type="hidden" name="check-hisperArt-madre[]" value="33">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hisperArt-madre" name="check-hisperArt-madre[]" value="1" required >
                <label for="checkSi-hisperArt-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hisperArt-madre" name="check-hisperArt-madre[]" value="2" required>
                <label for="checkNo-hisperArt-madre" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-hisperArt-madre">
                <textarea name="check-hisperArt-madre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECE O PADECIÓ DE ALGÚN TIPO DE CÁNCER?: </label>
                <input type="hidden" name="check-canc-madre[]" value="34">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-canc-madre" name="check-canc-madre[]" value="1" required >
                <label for="checkSi-canc-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-canc-madre" name="check-canc-madre[]" value="2" required>
                <label for="checkNo-canc-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-canc-madre">
                <textarea name="check-canc-madre[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <!-- <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>Otras: </label>
                <input type="hidden" name="check-otra-madre[]" value="35">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-otra-madre" name="check-otra-madre[]" value="1" required >
                <label for="checkSi-otra-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-otra-madre" name="check-otra-madre[]" value="2" required>
                <label for="checkNo-otra-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-otra-madre">
                <textarea name="check-otra-madre[]" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div> -->
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-antPsico">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-antPsico-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES PSICOLÓGICOS/ PSIQUIATRICOS
          </button>
        </h2>
        <div id="collapse-antPsico-Target" class="accordion-collapse collapse" aria-labelledby="collap-antPsico">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD PSICOLÓGICA O PSIQUIÁTRICA?: </label>
                <input type="hidden" name="check-enfpsicopsiq[]" value="36">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfpsicopsiq" name="check-enfpsicopsiq[]" value="1" required >
                <label for="checkSi-enfpsicopsiq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfpsicopsiq" name="check-enfpsicopsiq[]" value="2" required>
                <label for="checkNo-enfpsicopsiq" >No</label>
              </div>
              <div class="collapse" id="collapse-enfpsicopsiq">
                <textarea name="check-enfpsicopsiq[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿QUÉ ÁREAS DE TU VIDA HAN SIDO AFECTADAS POR LA ENFERMEDAD?: </label>
                <input type="hidden" name="check-enfAfect[]" value="37">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required id="checkFamiliar-enfAfect" name="check-enfAfect[]" value="3" required >
                  <label for="checkFamiliar-enfAfect">Familiar</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="checkSocial-enfAfect" name="check-enfAfect[]" value="4" required>
                  <label for="checkSocial-enfAfect" >Social</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Laboral-enfAfect" name="check-enfAfect[]" value="5" required>
                  <label for="check-Laboral-enfAfect">Laboral</label>
                </div>
                <!-- <div class="col-4">
                  <input type="radio" required  id="check-Todas-enfAfect" name="check-enfAfect[]" value="5" required>
                  <label for="check-Todas-enfAfect">Todas</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Ninguna-enfAfect" name="check-enfAfect[]" value="2" required>
                  <label for="check-Ninguna-enfAfect">Ninguna</label>
                </div> -->
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CON QUÉ FRECUENCIA TE SIENTES FELIZ?: </label>
                <input type="hidden" name="check-frecFeliz[]" value="38">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecFeliz" name="check-frecFeliz[]" value="7" required>
                  <label for="check-Nunca-frecFeliz">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecFeliz" name="check-frecFeliz[]" value="8" required>
                  <label for="check-A veces-frecFeliz">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecFeliz" name="check-frecFeliz[]" value="9" required>
                  <label for="check-Siempre-frecFeliz">Siempre</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿CONSIDERAS QUE HAZ CUMPLIDO TUS METAS?: </label>
                <input type="hidden" name="check-sienRealiz[]" value="39">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-sienRealiz" name="check-sienRealiz[]" value="1" required >
                <label for="checkSi-sienRealiz">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-sienRealiz" name="check-sienRealiz[]" value="2" required>
                <label for="checkNo-sienRealiz" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-sienRealiz">
                <textarea name="check-sienRealiz[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CON QUÉ FRECUENCIA TE SIENTES SOLO?: </label>
                <input type="hidden" name="check-frecSolo[]" value="40">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecSolo" name="check-frecSolo[]" value="7" required>
                  <label for="check-Nunca-frecSolo">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecSolo" name="check-frecSolo[]" value="8" required>
                  <label for="check-A veces-frecSolo">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecSolo" name="check-frecSolo[]" value="9" required>
                  <label for="check-Siempre-frecSolo">Siempre</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CON QUÉ FRECUENCIA TE SIENTES TRISTE?: </label>
                <input type="hidden" name="check-frectris[]" value="41">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frectris" name="check-frectris[]" value="7" required>
                  <label for="check-Nunca-frectris">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frectris" name="check-frectris[]" value="8" required>
                  <label for="check-A veces-frectris">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frectris" name="check-frectris[]" value="9" required>
                  <label for="check-Siempre-frectris">Siempre</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CONSTANTEMENTE TE SIENTES FRUSTRADO ANTE SITUACIONES COTIDIANAS?: </label>
                <input type="hidden" name="check-situaciCotidia[]" value="42">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-situaciCotidia" name="check-situaciCotidia[]" value="7" required>
                  <label for="check-Nunca-situaciCotidia">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-situaciCotidia" name="check-situaciCotidia[]" value="8" required>
                  <label for="check-A veces-situaciCotidia">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-situaciCotidia" name="check-situaciCotidia[]" value="9" required>
                  <label for="check-Siempre-situaciCotidia">Siempre</label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-antNutri">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-antNutri-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES NUTRICIONALES
          </button>
        </h2>
        <div id="collapse-antNutri-Target" class="accordion-collapse collapse" aria-labelledby="collap-antNutri">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿DESAYUNAS ENTRE LAS 08:00AM Y 11:00AM?: </label>
                <input type="hidden" name="check-Desayuno[]" value="43">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Desayuno" name="check-Desayuno[]" value="1" required >
                <label for="checkSi-Desayuno">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Desayuno" name="check-Desayuno[]" value="2" required>
                <label for="checkNo-Desayuno" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-Desayuno">
                <textarea name="check-Desayuno[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿REALIZAS UNA COLACIÓN DE ALIMENTOS POR LA MAÑANA?: </label>
                <input type="hidden" name="check-colaMana[]" value="44">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-colaMana" name="check-colaMana[]" value="1" required >
                <label for="checkSi-colaMana">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-colaMana" name="check-colaMana[]" value="2" required>
                <label for="checkNo-colaMana" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-colaMana">
                <textarea name="check-colaMana[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ALMUERZAS ENTRE LAS 02:00PM Y 05:00PM?: </label>
                <input type="hidden" name="check-Comida[]" value="45">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Comida" name="check-Comida[]" value="1" required >
                <label for="checkSi-Comida">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Comida" name="check-Comida[]" value="2" required>
                <label for="checkNo-Comida" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-Comida">
                <textarea name="check-Comida[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿REALIZAS UNA COLACIÓN DE ALIMENTOS POR LA TARDE?: </label>
                <input type="hidden" name="check-colaTarde[]" value="46">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-colaTarde" name="check-colaTarde[]" value="1" required >
                <label for="checkSi-colaTarde">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-colaTarde" name="check-colaTarde[]" value="2" required>
                <label for="checkNo-colaTarde" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-colaTarde">
                <textarea name="check-colaTarde[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿CONSUMES ALIMENTOS PREPARADOS EN CASA?: </label>
                <input type="hidden" name="check-alimePrepa[]" value="47">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-alimePrepa" name="check-alimePrepa[]" value="1" required >
                <label for="checkSi-alimePrepa">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-alimePrepa" name="check-alimePrepa[]" value="2" required>
                <label for="checkNo-alimePrepa" >No</label>
              </div>
              <!-- <div class="collapse" id="collapse-alimePrepa">
                <textarea name="check-alimePrepa[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div> -->
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CON QUÉ FRECUENCIA COSUMES ALIMENTOS PREPARADOS EN LA CALLE?: </label>
                <input type="hidden" name="check-frecAlimprepa[]" value="48">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecAlimprepa" name="check-frecAlimprepa[]" value="7" required>
                  <label for="check-Nunca-frecAlimprepa">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecAlimprepa" name="check-frecAlimprepa[]" value="8" required>
                  <label for="check-A veces-frecAlimprepa">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecAlimprepa" name="check-frecAlimprepa[]" value="9" required>
                  <label for="check-Siempre-frecAlimprepa">Siempre</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CUÁL ES TU NIVEL DE APETITO?: </label>
                <input type="hidden" name="check-nivelApeti[]" value="49">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Bueno-nivelApeti" name="check-nivelApeti[]" value="10" required>
                  <label for="check-Bueno-nivelApeti">Bueno</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Regular-nivelApeti" name="check-nivelApeti[]" value="11" required>
                  <label for="check-Regular-nivelApeti">Regular</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Malo-nivelApeti" name="check-nivelApeti[]" value="12" required>
                  <label for="check-Malo-nivelApeti">Malo</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CUÁL ES TU NIVEL DE SACIEDAD?: </label>
                <input type="hidden" name="check-nivelSacied[]" value="50">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Bueno-nivelSacied" name="check-nivelSacied[]" value="10" required>
                  <label for="check-Bueno-nivelSacied">Bueno</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Regular-nivelSacied" name="check-nivelSacied[]" value="11" required>
                  <label for="check-Regular-nivelSacied">Regular</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Malo-nivelSacied" name="check-nivelSacied[]" value="12" required>
                  <label for="check-Malo-nivelSacied">Malo</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 10px;">
              <div class="col-5">
                <label>¿CUÁNTOS VASOS DE AGUA CONSUMES AL DÍA?: </label>
                <input type="hidden" name="check-vasosAguaConsuem[]" value="51">
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-03-vasosAguaConsuem" name="check-vasosAguaConsuem[]" value="13" required>
                    <label for="check-03-vasosAguaConsuem">0 a 3</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-46-vasosAguaConsuem" name="check-vasosAguaConsuem[]" value="14" required>
                  <label for="check-46-vasosAguaConsuem">4 a 6</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-79-vasosAguaConsuem" name="check-vasosAguaConsuem[]" value="15" required>
                  <label for="check-79-vasosAguaConsuem">7 a 9</label>
                </div>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD RELACIONADA CON LOS ALIMENTOS?: </label>
                <input type="hidden" name="check-PadeceEnfeAlime[]" value="52">
              </div>
              <div class="col-3">
                <input type="radio" required id="checksi-enferRelaciAlime" name="check-PadeceEnfeAlime[]" value="1" required >
                <label for="checksi-enferRelaciAlime">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enferRelaciAlime" name="check-PadeceEnfeAlime[]" value="2" required>
                <label for="checkNo-enferRelaciAlime" >No</label>
              </div>
              <div class="collapse" id="collapse-PadeceEnfeAlime">
                <textarea name="check-PadeceEnfeAlime[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿CONSUMES SUPLEMENTOS ALIMENTICIOS?: </label>
                <input type="hidden" name="check-ConssupleAli[]" value="53">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ConssupleAli" name="check-ConssupleAli[]" value="1" required >
                <label for="checkSi-ConssupleAli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ConssupleAli" name="check-ConssupleAli[]" value="2" required>
                <label for="checkNo-ConssupleAli" >No</label>
              </div>
              <div class="collapse" id="collapse-ConssupleAli">
                <textarea name="check-ConssupleAli[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion onlyProcedencia">
        <h2 class="accordion-header" id="collap-MedLabo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-MedLabo-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; MEDIO LABORAL
          </button>
        </h2>
        <div id="collapse-MedLabo-Target" class="accordion-collapse collapse" aria-labelledby="collap-MedLabo">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HAZ TENIDO INCAPACIDAD POR ACCIDENTE LABORAL?: </label>
                <input type="hidden" name="check-incapaAccid[]" value="54">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-incapaAccid" name="check-incapaAccid[]" value="1" required >
                <label for="checkSi-incapaAccid">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-incapaAccid" name="check-incapaAccid[]" value="2" required>
                <label for="checkNo-incapaAccid" >No</label>
              </div>
              <div class="collapse" id="collapse-incapaAccid">
                <textarea name="check-incapaAccid[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HAZ TENIDO INCAPACIDAD POR ALGUNA ENFERMEDAD?: </label>
                <input type="hidden" name="check-incapaEnfer[]" value="55">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-incapaEnfer" name="check-incapaEnfer[]" value="1" required >
                <label for="checkSi-incapaEnfer">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-incapaEnfer" name="check-incapaEnfer[]" value="2" required>
                <label for="checkNo-incapaEnfer" >No</label>
              </div>
              <div class="collapse" id="collapse-incapaEnfer">
                <textarea name="check-incapaEnfer[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD DE LA PIEL POR CONTACTO CON MATERIALES?: </label>
                <input type="hidden" name="check-condiPielMateri[]" value="56">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-condiPielMateri" name="check-condiPielMateri[]" value="1" required >
                <label for="checkSi-condiPielMateri">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-condiPielMateri" name="check-condiPielMateri[]" value="2" required>
                <label for="checkNo-condiPielMateri" >No</label>
              </div>
              <div class="collapse" id="collapse-condiPielMateri">
                <textarea name="check-condiPielMateri[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿HAZ TENIDO ALGUNA FRACTURA O LESIÓN PROVOCADA EN EL TRABAJO?: </label>
                <input type="hidden" name="check-fracLesiTrab[]" value="57">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-fracLesiTrab" name="check-fracLesiTrab[]" value="1" required >
                <label for="checkSi-fracLesiTrab">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-fracLesiTrab" name="check-fracLesiTrab[]" value="2" required>
                <label for="checkNo-fracLesiTrab" >No</label>
              </div>
              <div class="collapse" id="collapse-fracLesiTrab">
                <textarea name="check-fracLesiTrab[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿PADECES ALGUNA ENFERMEDAD RELACIONADA CON TU TIPO DE ACTIVIDAD LABORAL?: </label>
                <input type="hidden" name="check-anteEnferTrabajo[]" value="58">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-anteEnferTrabajo" name="check-anteEnferTrabajo[]" value="1" required >
                <label for="checkSi-anteEnferTrabajo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-anteEnferTrabajo" name="check-anteEnferTrabajo[]" value="2" required>
                <label for="checkNo-anteEnferTrabajo" >No</label>
              </div>
              <div class="collapse" id="collapse-anteEnferTrabajo">
                <textarea name="check-anteEnferTrabajo[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A MATERIAL POLVOSO?: </label>
                <input type="hidden" name="check-expoMatpolvo[]" value="59">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoMatpolvo" name="check-expoMatpolvo[]" value="1" required >
                <label for="checkSi-expoMatpolvo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoMatpolvo" name="check-expoMatpolvo[]" value="2" required>
                <label for="checkNo-expoMatpolvo" >No</label>
              </div>
              <div class="collapse" id="collapse-expoMatpolvo">
                <textarea name="check-expoMatpolvo[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A RUIDOS FUERTES?: </label>
                <input type="hidden" name="check-exposiRuidFuertes[]" value="60">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposiRuidFuertes" name="check-exposiRuidFuertes[]" value="1" required >
                <label for="checkSi-exposiRuidFuertes">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposiRuidFuertes" name="check-exposiRuidFuertes[]" value="2" required>
                <label for="checkNo-exposiRuidFuertes" >No</label>
              </div>
              <div class="collapse" id="collapse-exposiRuidFuertes">
                <textarea name="check-exposiRuidFuertes[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A SUSTANCIAS QUÍMICAS?: </label>
                <input type="hidden" name="check-expoSustQuimi[]" value="61">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoSustQuimi" name="check-expoSustQuimi[]" value="1" required >
                <label for="checkSi-expoSustQuimi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoSustQuimi" name="check-expoSustQuimi[]" value="2" required>
                <label for="checkNo-expoSustQuimi" >No</label>
              </div>
              <div class="collapse" id="collapse-expoSustQuimi">
                <textarea name="check-expoSustQuimi[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A GASES?: </label>
                <input type="hidden" name="check-exposGases[]" value="62">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposGases" name="check-exposGases[]" value="1" required >
                <label for="checkSi-exposGases">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposGases" name="check-exposGases[]" value="2" required>
                <label for="checkNo-exposGases" >No</label>
              </div>
              <div class="collapse" id="collapse-exposGases">
                <textarea name="check-exposGases[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A LÍQUIDOS INFLAMABLES?: </label>
                <input type="hidden" name="check-expoLiquinfla[]" value="63">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoLiquinfla" name="check-expoLiquinfla[]" value="1" required >
                <label for="checkSi-expoLiquinfla">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoLiquinfla" name="check-expoLiquinfla[]" value="2" required>
                <label for="checkNo-expoLiquinfla" >No</label>
              </div>
              <div class="collapse" id="collapse-expoLiquinfla">
                <textarea name="check-expoLiquinfla[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A SÓLIDOS INFLAMABLES?: </label>
                <input type="hidden" name="check-exposoliInflamables[]" value="64">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposoliInflamables" name="check-exposoliInflamables[]" value="1" required >
                <label for="checkSi-exposoliInflamables">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposoliInflamables" name="check-exposoliInflamables[]" value="2" required>
                <label for="checkNo-exposoliInflamables" >No</label>
              </div>
              <div class="collapse" id="collapse-exposoliInflamables">
                <textarea name="check-exposoliInflamables[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A EXPLOSIVOS?: </label>
                <input type="hidden" name="check-expoExplosi[]" value="65">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoExplosi" name="check-expoExplosi[]" value="1" required >
                <label for="checkSi-expoExplosi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoExplosi" name="check-expoExplosi[]" value="2" required>
                <label for="checkNo-expoExplosi" >No</label>
              </div>
              <div class="collapse" id="collapse-expoExplosi">
                <textarea name="check-expoExplosi[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A MATERIALES RADIOACTIVOS?: </label>
                <input type="hidden" name="check-ExposimateRadio[]" value="66">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ExposimateRadio" name="check-ExposimateRadio[]" value="1" required >
                <label for="checkSi-ExposimateRadio">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ExposimateRadio" name="check-ExposimateRadio[]" value="2" required>
                <label for="checkNo-ExposimateRadio" >No</label>
              </div>
              <div class="collapse" id="collapse-ExposimateRadio">
                <textarea name="check-ExposimateRadio[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS ESPUESTO A SUSTANCIAS CORROSIVAS?: </label>
                <input type="hidden" name="check-exposiSusCorro[]" value="67">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposiSusCorro" name="check-exposiSusCorro[]" value="1" required >
                <label for="checkSi-exposiSusCorro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposiSusCorro" name="check-exposiSusCorro[]" value="2" required>
                <label for="checkNo-exposiSusCorro" >No</label>
              </div>
              <div class="collapse" id="collapse-exposiSusCorro">
                <textarea name="check-exposiSusCorro[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <hr class="dropdown-divider m-2">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
              <div class="col-6">
                <label>¿ESTÁS EXPUESTO A SUSTANCIAS VENENOSAS Y/O INFECCIOSAS?: </label>
                <input type="hidden" name="check-exposSusVeneInfe[]" value="68">
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposSusVeneInfe" name="check-exposSusVeneInfe[]" value="1" required >
                <label for="checkSi-exposSusVeneInfe">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposSusVeneInfe" name="check-exposSusVeneInfe[]" value="2" required>
                <label for="checkNo-exposSusVeneInfe" >No</label>
              </div>
              <div class="collapse" id="collapse-exposSusVeneInfe">
                <textarea name="check-exposSusVeneInfe[]" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-AnanApar">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-AnanApar-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANAMNESIS POR APARATOS

          </button>
        </h2>
        <div id="collapse-AnanApar-Target" class="accordion-collapse collapse" aria-labelledby="collap-AnanApar">
          <div class="accordion-body">

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-sisteCardio">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-sisteCardio-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Sistema Cardiovascular
                </button>
              </h2>
              <div id="collapse-sub-sisteCardio-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-sisteCardio">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Disnea: </label>
                      <input type="hidden" name="check-disnea[]" value="69">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-disnea" name="check-disnea[]" value="1" required >
                      <label for="checkSi-disnea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-disnea" name="check-disnea[]" value="2" required>
                      <label for="checkNo-disnea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-disnea">
                      <textarea name="check-disnea[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Frialdad de extremidades: </label>
                      <input type="hidden" name="check-frialExtremida[]" value="70">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-frialExtremida" name="check-frialExtremida[]" value="1" required >
                      <label for="checkSi-frialExtremida">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-frialExtremida" name="check-frialExtremida[]" value="2" required>
                      <label for="checkNo-frialExtremida" >No</label>
                    </div>
                    <div class="collapse" id="collapse-frialExtremida">
                      <textarea name="check-frialExtremida[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Dolor torácico: </label>
                      <input type="hidden" name="check-dolorToraci[]" value="71">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-dolorToraci" name="check-dolorToraci[]" value="1" required >
                      <label for="checkSi-dolorToraci">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-dolorToraci" name="check-dolorToraci[]" value="2" required>
                      <label for="checkNo-dolorToraci" >No</label>
                    </div>
                    <div class="collapse" id="collapse-dolorToraci">
                      <textarea name="check-dolorToraci[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Palpitaciones: </label>
                      <input type="hidden" name="check-palpita[]" value="72">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-palpita" name="check-palpita[]" value="1" required >
                      <label for="checkSi-palpita">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-palpita" name="check-palpita[]" value="2" required>
                      <label for="checkNo-palpita" >No</label>
                    </div>
                    <div class="collapse" id="collapse-palpita">
                      <textarea name="check-palpita[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Edema: </label>
                      <input type="hidden" name="check-edema[]" value="73">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-edema" name="check-edema[]" value="1" required >
                      <label for="checkSi-edema">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-edema" name="check-edema[]" value="2" required>
                      <label for="checkNo-edema" >No</label>
                    </div>
                    <div class="collapse" id="collapse-edema">
                      <textarea name="check-edema[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Úlceras cutáneas: </label>
                      <input type="hidden" name="check-ulceCutane[]" value="74">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-ulceCutane" name="check-ulceCutane[]" value="1" required >
                      <label for="checkSi-ulceCutane">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-ulceCutane" name="check-ulceCutane[]" value="2" required>
                      <label for="checkNo-ulceCutane" >No</label>
                    </div>
                    <div class="collapse" id="collapse-ulceCutane">
                      <textarea name="check-ulceCutane[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Claudicación a la deambulación: </label>
                      <input type="hidden" name="check-claudiDeambula[]" value="75">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-claudiDeambula" name="check-claudiDeambula[]" value="1" required >
                      <label for="checkSi-claudiDeambula">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-claudiDeambula" name="check-claudiDeambula[]" value="2" required>
                      <label for="checkNo-claudiDeambula" >No</label>
                    </div>
                    <div class="collapse" id="collapse-claudiDeambula">
                      <textarea name="check-claudiDeambula[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Cianosis: </label>
                      <input type="hidden" name="check-cianosis[]" value="76">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-cianosis" name="check-cianosis[]" value="1" required >
                      <label for="checkSi-cianosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-cianosis" name="check-cianosis[]" value="2" required>
                      <label for="checkNo-cianosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-cianosis">
                      <textarea name="check-cianosis[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-AparaRespiratorio">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-AparaRespiratorio-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Aparato Respiratorio
                </button>
              </h2>
              <div id="collapse-sub-AparaRespiratorio-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-AparaRespiratorio">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Disnea: </label>
                      <input type="hidden" name="check-aparaRespir-disnea[]" value="77">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-disnea" name="check-aparaRespir-disnea[]" value="1" required >
                      <label for="checkSi-aparaRespir-disnea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-disnea" name="check-aparaRespir-disnea[]" value="2" required>
                      <label for="checkNo-aparaRespir-disnea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-disnea">
                      <textarea name="check-aparaRespir-disnea[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Tos: </label>
                      <input type="hidden" name="check-aparaRespir-tos[]" value="78">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-tos" name="check-aparaRespir-tos[]" value="1" required >
                      <label for="checkSi-aparaRespir-tos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-tos" name="check-aparaRespir-tos[]" value="2" required>
                      <label for="checkNo-aparaRespir-tos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-tos">
                      <textarea name="check-aparaRespir-tos[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Expectoración: </label>
                      <input type="hidden" name="check-aparaRespir-expectoracion[]" value="79">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-expectoracion" name="check-aparaRespir-expectoracion[]" value="1" required >
                      <label for="checkSi-aparaRespir-expectoracion">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-expectoracion" name="check-aparaRespir-expectoracion[]" value="2" required>
                      <label for="checkNo-aparaRespir-expectoracion" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-expectoracion">
                      <textarea name="check-aparaRespir-expectoracion[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Dolor: </label>
                      <input type="hidden" name="check-aparaRespir-dolor[]" value="80">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-dolor" name="check-aparaRespir-dolor[]" value="1" required >
                      <label for="checkSi-aparaRespir-dolor">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-dolor" name="check-aparaRespir-dolor[]" value="2" required>
                      <label for="checkNo-aparaRespir-dolor" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-dolor">
                      <textarea name="check-aparaRespir-dolor[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Asma: </label>
                      <input type="hidden" name="check-aparaRespir-asma[]" value="81">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-asma" name="check-aparaRespir-asma[]" value="1" required >
                      <label for="checkSi-aparaRespir-asma">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-asma" name="check-aparaRespir-asma[]" value="2" required>
                      <label for="checkNo-aparaRespir-asma" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-asma">
                      <textarea name="check-aparaRespir-asma[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Cianosis: </label>
                      <input type="hidden" name="check-aparaRespir-cianosis[]" value="82">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-cianosis" name="check-aparaRespir-cianosis[]" value="1" required >
                      <label for="checkSi-aparaRespir-cianosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-cianosis" name="check-aparaRespir-cianosis[]" value="2" required>
                      <label for="checkNo-aparaRespir-cianosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-cianosis">
                      <textarea name="check-aparaRespir-cianosis[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Roncador: </label>
                      <input type="hidden" name="check-aparaRespir-roncador[]" value="83">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-roncador" name="check-aparaRespir-roncador[]" value="1" required >
                      <label for="checkSi-aparaRespir-roncador">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-roncador" name="check-aparaRespir-roncador[]" value="2" required>
                      <label for="checkNo-aparaRespir-roncador" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-roncador">
                      <textarea name="check-aparaRespir-roncador[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Infecciones respiratorias: </label>
                      <input type="hidden" name="check-aparaRespir-infeccRespira[]" value="84">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-infeccRespira" name="check-aparaRespir-infeccRespira[]" value="1" required >
                      <label for="checkSi-aparaRespir-infeccRespira">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-infeccRespira" name="check-aparaRespir-infeccRespira[]" value="2" required>
                      <label for="checkNo-aparaRespir-infeccRespira" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-infeccRespira">
                      <textarea name="check-aparaRespir-infeccRespira[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-aparatoRespirator">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-aparatoRespirator-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Aparato Digestivo
                </button>
              </h2>
              <div id="collapse-sub-aparatoRespirator-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-aparatoRespirator">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Digestión: </label>
                      <input type="hidden" name="check-aparatoDigestivo-roncador[]" value="85">
                    </div>
                    <div class="" id="collapse-aparatoDigestivo-roncador">
                      <textarea name="check-aparatoDigestivo-roncador[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Flatulencias: </label>
                      <input type="hidden" name="check-aparatoDigestivo-flatulencias[]" value="86">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-flatulencias" name="check-aparatoDigestivo-flatulencias[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-flatulencias">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-flatulencias" name="check-aparatoDigestivo-flatulencias[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-flatulencias" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-flatulencias">
                      <textarea name="check-aparatoDigestivo-flatulencias[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Meteorismo: </label>
                      <input type="hidden" name="check-aparatoDigestivo-meteorismo[]" value="87">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-meteorismo" name="check-aparatoDigestivo-meteorismo[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-meteorismo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-meteorismo" name="check-aparatoDigestivo-meteorismo[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-meteorismo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-meteorismo">
                      <textarea name="check-aparatoDigestivo-meteorismo[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Pirosis: </label>
                      <input type="hidden" name="check-aparatoDigestivo-pirosis[]" value="88">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-pirosis" name="check-aparatoDigestivo-pirosis[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-pirosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-pirosis" name="check-aparatoDigestivo-pirosis[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-pirosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-pirosis">
                      <textarea name="check-aparatoDigestivo-pirosis[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Disfagia: </label>
                      <input type="hidden" name="check-aparatoDigestivo-disfagia[]" value="89">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-disfagia" name="check-aparatoDigestivo-disfagia[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-disfagia">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-disfagia" name="check-aparatoDigestivo-disfagia[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-disfagia" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-disfagia">
                      <textarea name="check-aparatoDigestivo-disfagia[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Odinofagia: </label>
                      <input type="hidden" name="check-aparatoDigestivo-odinofagia[]" value="90">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-odinofagia" name="check-aparatoDigestivo-odinofagia[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-odinofagia">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-odinofagia" name="check-aparatoDigestivo-odinofagia[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-odinofagia" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-odinofagia">
                      <textarea name="check-aparatoDigestivo-odinofagia[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Reflujo: </label>
                      <input type="hidden" name="check-aparatoDigestivo-reflujo[]" value="91">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-reflujo" name="check-aparatoDigestivo-reflujo[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-reflujo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-reflujo" name="check-aparatoDigestivo-reflujo[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-reflujo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-reflujo">
                      <textarea name="check-aparatoDigestivo-reflujo[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Náuseas: </label>
                      <input type="hidden" name="check-aparatoDigestivo-Nauseas[]" value="92">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-Nauseas" name="check-aparatoDigestivo-Nauseas[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-Nauseas">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-Nauseas" name="check-aparatoDigestivo-Nauseas[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-Nauseas" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-Nauseas">
                      <textarea name="check-aparatoDigestivo-Nauseas[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Vómitos: </label>
                      <input type="hidden" name="check-aparatoDigestivo-Vómitos[]" value="93">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-Vómitos" name="check-aparatoDigestivo-Vómitos[]" value="1" required >
                      <label for="checkSi-aparatoDigestivo-Vómitos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-Vómitos" name="check-aparatoDigestivo-Vómitos[]" value="2" required>
                      <label for="checkNo-aparatoDigestivo-Vómitos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-Vómitos">
                      <textarea name="check-aparatoDigestivo-Vómitos[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Ritmo intestinal: </label>
                      <input type="hidden" name="check-aparatoDigestivo-ritmaIntestinal[]" value="94">
                    </div>
                    <div class="" id="collapse-aparatoDigestivo-ritmaIntestinal">
                      <textarea name="check-aparatoDigestivo-ritmaIntestinal[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Heces (Color, consistencia): </label>
                      <input type="hidden" name="check-aparatoDigestivo-hecesColroConsis[]" value="95">
                    </div>
                    <div class="" id="collapse-aparatoDigestivo-hecesColroConsis">
                      <textarea name="check-aparatoDigestivo-hecesColroConsis[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-aparatoGenitourina">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-aparatoGenitourina-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Aparato Genitourinario
                </button>
              </h2>
              <div id="collapse-sub-aparatoGenitourina-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-aparatoGenitourina">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Cantidad de orina al día: </label>
                      <input type="hidden" name="check-aparatoGenitourina-cantidadOrinaDia[]" value="96">
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-cantidadOrinaDia">
                      <textarea name="check-aparatoGenitourina-cantidadOrinaDia[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Color de orina: </label>
                      <input type="hidden" name="check-aparatoGenitourina-colorOrina[]" value="97">
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-colorOrina">
                      <textarea name="check-aparatoGenitourina-colorOrina[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Hematuria: </label>
                      <input type="hidden" name="check-aparatoGenitourina-colorOrina[]" value="98">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoGenitourina-Hematuria" name="check-aparatoGenitourina-Hematuria[]" value="1" required >
                      <label for="checkSi-aparatoGenitourina-Hematuria">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoGenitourina-Hematuria" name="check-aparatoGenitourina-Hematuria[]" value="2" required>
                      <label for="checkNo-aparatoGenitourina-Hematuria" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoGenitourina-Hematuria">
                      <textarea name="check-aparatoGenitourina-Hematuria[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Disuria: </label>
                      <input type="hidden" name="check-aparatoGenitourina-disuria[]" value="99">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoGenitourina-disuria" name="check-aparatoGenitourina-disuria[]" value="1" required >
                      <label for="checkSi-aparatoGenitourina-disuria">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoGenitourina-disuria" name="check-aparatoGenitourina-disuria[]" value="2" required>
                      <label for="checkNo-aparatoGenitourina-disuria" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoGenitourina-disuria">
                      <textarea name="check-aparatoGenitourina-disuria[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Poliaquiuria: </label>
                      <input type="hidden" name="check-aparatoGenitourina-poliaquiur[]" value="100">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoGenitourina-poliaquiur" name="check-aparatoGenitourina-poliaquiur[]" value="1" required >
                      <label for="checkSi-aparatoGenitourina-poliaquiur">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoGenitourina-poliaquiur" name="check-aparatoGenitourina-poliaquiur[]" value="2" required>
                      <label for="checkNo-aparatoGenitourina-poliaquiur" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoGenitourina-poliaquiur">
                      <textarea name="check-aparatoGenitourina-poliaquiur[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Tenesmo: </label>
                      <input type="hidden" name="check-aparatoGenitourina-tenesm[]" value="101">
                    </divtenesm
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoGenitourina-tenesm" name="check-aparatoGenitourina-tenesm[]" value="1" required >
                      <label for="checkSi-aparatoGenitourina-tenesm">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoGenitourina-tenesm" name="check-aparatoGenitourina-tenesm[]" value="2" required>
                      <label for="checkNo-aparatoGenitourina-tenesm" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoGenitourina-tenesm">
                      <textarea name="check-aparatoGenitourina-tenesm[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Micción imperiosa: </label>
                      <input type="hidden" name="check-aparatoGenitourina-micciImperi[]" value="102">
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-micciImperi">
                      <textarea name="check-aparatoGenitourina-micciImperi[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Expulsión de arenilla: </label>
                      <input type="hidden" name="check-aparatoGenitourina-expulsiArenilla[]" value="103">
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-expulsiArenilla">
                      <textarea name="check-aparatoGenitourina-expulsiArenilla[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-sistemNervios">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-sistemNervios-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Sistema Nervioso
                </button>
              </h2>
              <div id="collapse-sub-sistemNervios-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-sistemNervios">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Cefalea: </label>
                      <input type="hidden" name="check-sistemNervios-Cefalea[]" value="104">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Cefalea" name="check-sistemNervios-Cefalea[]" value="1" required >
                      <label for="checkSi-sistemNervios-Cefalea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Cefalea" name="check-sistemNervios-Cefalea[]" value="2" required>
                      <label for="checkNo-sistemNervios-Cefalea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Cefalea">
                      <textarea name="check-sistemNervios-Cefalea[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Parestesias: </label>
                      <input type="hidden" name="check-sistemNervios-Parestesias[]" value="105">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Parestesias" name="check-sistemNervios-Parestesias[]" value="1" required >
                      <label for="checkSi-sistemNervios-Parestesias">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Parestesias" name="check-sistemNervios-Parestesias[]" value="2" required>
                      <label for="checkNo-sistemNervios-Parestesias" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Parestesias">
                      <textarea name="check-sistemNervios-Parestesias[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Pérdida de fuerza: </label>
                      <input type="hidden" name="check-sistemNervios-perdidFuerza[]" value="106">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-perdidFuerza" name="check-sistemNervios-perdidFuerza[]" value="1" required >
                      <label for="checkSi-sistemNervios-perdidFuerza">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-perdidFuerza" name="check-sistemNervios-perdidFuerza[]" value="2" required>
                      <label for="checkNo-sistemNervios-perdidFuerza" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-perdidFuerza">
                      <textarea name="check-sistemNervios-perdidFuerza[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Alteraciones en la marcha: </label>
                      <input type="hidden" name="check-sistemNervios-alterMarcha[]" value="107">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-alterMarcha" name="check-sistemNervios-alterMarcha[]" value="1" required >
                      <label for="checkSi-sistemNervios-alterMarcha">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-alterMarcha" name="check-sistemNervios-alterMarcha[]" value="2" required>
                      <label for="checkNo-sistemNervios-alterMarcha" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-alterMarcha">
                      <textarea name="check-sistemNervios-alterMarcha[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Alteraciones visuales: </label>
                      <input type="hidden" name="check-sistemNervios-alteracioVisuales[]" value="108">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-alteracioVisuales" name="check-sistemNervios-alteracioVisuales[]" value="1" required >
                      <label for="checkSi-sistemNervios-alteracioVisuales">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-alteracioVisuales" name="check-sistemNervios-alteracioVisuales[]" value="2" required>
                      <label for="checkNo-sistemNervios-alteracioVisuales" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-alteracioVisuales">
                      <textarea name="check-sistemNervios-alteracioVisuales[]" class="form-control input-form" rows="2" cols="2" placeholder="(Visión, borrosidad) ¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Temblor: </label>
                      <input type="hidden" name="check-sistemNervios-temblor[]" value="109">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-temblor" name="check-sistemNervios-temblor[]" value="1" required >
                      <label for="checkSi-sistemNervios-temblor">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-temblor" name="check-sistemNervios-temblor[]" value="2" required>
                      <label for="checkNo-sistemNervios-temblor" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-temblor">
                      <textarea name="check-sistemNervios-temblor[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Calambres: </label>
                      <input type="hidden" name="check-sistemNervios-Calambres[]" value="110">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Calambres" name="check-sistemNervios-Calambres[]" value="1" required >
                      <label for="checkSi-sistemNervios-Calambres">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Calambres" name="check-sistemNervios-Calambres[]" value="2" required>
                      <label for="checkNo-sistemNervios-Calambres" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Calambres">
                      <textarea name="check-sistemNervios-Calambres[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-EndrocrinoloMetabolism">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-EndrocrinoloMetabolism-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Endocrinología y Metabolismo
                </button>
              </h2>
              <div id="collapse-sub-EndrocrinoloMetabolism-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-EndrocrinoloMetabolism">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Apetito: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-Apetito[]" value="112">
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-Apetito">
                      <textarea name="check-EndrocrinoloMetabolism-Apetito[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Hábitos nutricionales: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-habitoNutrici[]" value="113">
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-habitoNutrici">
                      <textarea name="check-EndrocrinoloMetabolism-habitoNutrici[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Patrón alimentario: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-patroAliment[]" value="114">
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-patroAliment">
                      <textarea name="check-EndrocrinoloMetabolism-patroAliment[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Obesidad: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-Obesidad[]" value="115">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-Obesidad" name="check-EndrocrinoloMetabolism-Obesidad[]" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-Obesidad">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-Obesidad" name="check-EndrocrinoloMetabolism-Obesidad[]" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-Obesidad" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-Obesidad">
                      <textarea name="check-EndrocrinoloMetabolism-Obesidad[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Delgadez: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-Delgadez[]" value="116">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-Delgadez" name="check-EndrocrinoloMetabolism-Delgadez[]" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-Delgadez">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-Delgadez" name="check-EndrocrinoloMetabolism-Delgadez[]" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-Delgadez" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-Delgadez">
                      <textarea name="check-EndrocrinoloMetabolism-Delgadez[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Ganacia o pérdida de peso: </label>
                      <input type="hidden" name="check-EndrocrinoloMetabolism-gananperdiPeso[]" value="117">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-gananperdiPeso" name="check-EndrocrinoloMetabolism-gananperdiPeso[]" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-gananperdiPeso">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-gananperdiPeso" name="check-EndrocrinoloMetabolism-gananperdiPeso[]" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-gananperdiPeso" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-gananperdiPeso">
                      <textarea name="check-EndrocrinoloMetabolism-gananperdiPeso[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-aparatoLocomot">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-aparatoLocomot-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Aparato Locomotor
                </button>
              </h2>
              <div id="collapse-sub-aparatoLocomot-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-aparatoLocomot">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Dolor osteo-articular: </label>
                      <input type="hidden" name="check-aparatoLocomot-DolorOsteoArticu[]" value="118">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-DolorOsteoArticu" name="check-aparatoLocomot-DolorOsteoArticu[]" value="1" required >
                      <label for="checkSi-aparatoLocomot-DolorOsteoArticu">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-DolorOsteoArticu" name="check-aparatoLocomot-DolorOsteoArticu[]" value="2" required>
                      <label for="checkNo-aparatoLocomot-DolorOsteoArticu" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-DolorOsteoArticu">
                      <textarea name="check-aparatoLocomot-DolorOsteoArticu[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Reumatismo: </label>
                      <input type="hidden" name="check-aparatoLocomot-Reumatismo[]" value="119">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-Reumatismo" name="check-aparatoLocomot-Reumatismo[]" value="1" required >
                      <label for="checkSi-aparatoLocomot-Reumatismo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-Reumatismo" name="check-aparatoLocomot-Reumatismo[]" value="2" required>
                      <label for="checkNo-aparatoLocomot-Reumatismo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-Reumatismo">
                      <textarea name="check-aparatoLocomot-Reumatismo[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Inflamación articular: </label>
                      <input type="hidden" name="check-aparatoLocomot-inflamaciArticu[]" value="120">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-inflamaciArticu" name="check-aparatoLocomot-inflamaciArticu[]" value="1" required >
                      <label for="checkSi-aparatoLocomot-inflamaciArticu">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-inflamaciArticu" name="check-aparatoLocomot-inflamaciArticu[]" value="2" required>
                      <label for="checkNo-aparatoLocomot-inflamaciArticu" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-inflamaciArticu">
                      <textarea name="check-aparatoLocomot-inflamaciArticu[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Deformidades: </label>
                      <input type="hidden" name="check-aparatoLocomot-Deformidades[]" value="121">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-Deformidades" name="check-aparatoLocomot-Deformidades[]" value="1" required >
                      <label for="checkSi-aparatoLocomot-Deformidades">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-Deformidades" name="check-aparatoLocomot-Deformidades[]" value="2" required>
                      <label for="checkNo-aparatoLocomot-Deformidades" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-Deformidades">
                      <textarea name="check-aparatoLocomot-Deformidades[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-Termoregulacin">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-Termoregulacin-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Termoregulación
                </button>
              </h2>
              <div id="collapse-sub-Termoregulacin-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-Termoregulacin">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Fiebre: </label>
                      <input type="hidden" name="check-Termoregulacin-Fiebre[]" value="122">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Fiebre" name="check-Termoregulacin-Fiebre[]" value="1" required >
                      <label for="checkSi-Termoregulacin-Fiebre">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Fiebre" name="check-Termoregulacin-Fiebre[]" value="2" required>
                      <label for="checkNo-Termoregulacin-Fiebre" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Fiebre">
                      <textarea name="check-Termoregulacin-Fiebre[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Escalofríos: </label>
                      <input type="hidden" name="check-Termoregulacin-Escalofríos[]" value="123">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Escalofríos" name="check-Termoregulacin-Escalofríos[]" value="1" required >
                      <label for="checkSi-Termoregulacin-Escalofríos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Escalofríos" name="check-Termoregulacin-Escalofríos[]" value="2" required>
                      <label for="checkNo-Termoregulacin-Escalofríos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Escalofríos">
                      <textarea name="check-Termoregulacin-Escalofríos[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Sudoración: </label>
                      <input type="hidden" name="check-Termoregulacin-Sudoración[]" value="124">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Sudoración" name="check-Termoregulacin-Sudoración[]" value="1" required >
                      <label for="checkSi-Termoregulacin-Sudoración">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Sudoración" name="check-Termoregulacin-Sudoración[]" value="2" required>
                      <label for="checkNo-Termoregulacin-Sudoración" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Sudoración">
                      <textarea name="check-Termoregulacin-Sudoración[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <!-- <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Transtornos: </label>
                      <input type="hidden" name="check-Termoregulacin-Transtornos[]" value="124">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Transtornos" name="check-Termoregulacin-Transtornos[]" value="1" required >
                      <label for="checkSi-Termoregulacin-Transtornos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Transtornos" name="check-Termoregulacin-Transtornos[]" value="2" required>
                      <label for="checkNo-Termoregulacin-Transtornos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Transtornos">
                      <textarea name="check-Termoregulacin-Transtornos[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div> -->
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Transtornos congénitos de metabolismo: </label>
                      <input type="hidden" name="check-Termoregulacin-congenMetabolism[]" value="125">
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-congenMetabolism" name="check-Termoregulacin-congenMetabolism[]" value="1" required >
                      <label for="checkSi-Termoregulacin-congenMetabolism">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-congenMetabolism" name="check-Termoregulacin-congenMetabolism[]" value="2" required>
                      <label for="checkNo-Termoregulacin-congenMetabolism" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-congenMetabolism">
                      <textarea name="check-Termoregulacin-congenMetabolism[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="accordion-item bg-acordion">
              <h2 class="accordion-header" id="collap-sub-piel">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-sub-piel-Target" aria-expanded="false" aria-controls="accordionEstudios">
                  <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; Piel
                </button>
              </h2>
              <div id="collapse-sub-piel-Target" class="accordion-collapse collapse" aria-labelledby="collap-sub-piel">
                <div class="accordion-body">
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Cambios de coloración "manchas": </label>
                      <input type="hidden" name="check-piel-CambiosColoracion[]" value="126">
                    </div>
                    <div class="" id="collapse-piel-CambiosColoracion">
                      <textarea name="check-piel-CambiosColoracion[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Prurito: </label>
                      <input type="hidden" name="check-piel-prurito[]" value="127">
                    </div>
                    <div class="" id="collapse-piel-prurito">
                      <textarea name="check-piel-prurito[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Frialdad: </label>
                      <input type="hidden" name="check-piel-frialdad[]" value="128">
                    </div>
                    <div class="" id="collapse-piel-frialdad">
                      <textarea name="check-piel-frialdad[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 10px;">
                    <div class="col-6">
                      <label>Dermatosis: </label>
                      <input type="hidden" name="check-piel-dematosis[]" value="129">
                    </div>
                    <div class="" id="collapse-piel-dematosis">
                      <textarea name="check-piel-dematosis[]" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
</div>

<script type="text/javascript">
  // function collapse(collapID, valor){
  //   if (valor == true) {
  //     $(collapID).collapse("show")
  //   }else{
  //     $(collapID).collapse("hidden")
  //     $(collapID).find(':input').val('')
  //   }
  // }


  jQuery(document).on("change ,  keyup" , "input[type='radio']" ,function(){
       var parent_element = jQuery(this).closest("div[class='row']");
      if (this.value == true) {
          var collapID = jQuery(parent_element).children("div[class='collapse']").attr("id");
          $('#'+collapID).collapse("show")
          $('#'+collapID).find(':input').prop('required', true);
      }else{
          var collapID = jQuery(parent_element).children("div[class='collapse show']").attr("id");
          $('#'+collapID).collapse("hide")
          $('#'+collapID).find(':input').val('')
          $('#'+collapID).find(':input').prop('required', false);
      }
  });
   $('input[type="radio"]').prop("checked", true);

  // $("#iniciar-consulta").on('click', function(){
  //   if ($('input[type="radio"]:not(:checked)').length > 125) {
  //     alert($('input[type="radio"]:not(:checked)').length)
  //     console.log($('input[type="radio"]:not(:checked)'))
  //     $('input[type="radio"]').prop("checked", true);
  //   }else{
  //     alert("todo bien");
  //   }
  // })

  // $("#formAntecedentes-paciente").submit(function (event) {
  //   event.preventDefault();
  //   var form = document.getElementById("formAntecedentes-paciente");
  //   var formData = new FormData(form);
  //   console.log(formData)
  //   $.ajax({
  //     data: formData,
  //     url: http + servidor + "/nuevo_checkup/api/usuarios_api.php",
  //     type: "POST",
  //     processData: false,
  //     contentType: false,
  //     success: function (data) {
  //       data = jQuery.parseJSON(data);
  //       if (mensajeAjax(data)) {
  //         Toast.fire({
  //           icon: "success",
  //           title: "Equipo registrado!",
  //           timer: 2000,
  //         });
  //         document.getElementById("formAgregarEquipo").reset();
  //         $("#ModalRegistrarEquipo").modal("hidden");
  //         tablaEquipo.ajax.reload();
  //       }
  //     },
  //   });
  //   event.preventDefault();
  // });
</script>
