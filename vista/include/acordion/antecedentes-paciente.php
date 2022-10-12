<div class="card ">
  <h4 class="m-3">Antecedentes</h4>
  <hr class="dropdown-divider m-2">
  <p class="none-p" style="margin-left: 10px">Rellene todos los campos*</p>
  <div class="accordion m-2" id="accordionEstudios">
    <form id="formAntecedentes-paciente">
      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-patologicos">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-Patologicos-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES PERSONALES PATOLÓGICOS
          </button>
        </h2>
        <div id="collapse-Patologicos-Target" class="accordion-collapse collapse" aria-labelledby="collap-patologicos">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Alergia: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-aler" name="check-aler" value="1" required >
                <label for="checkSi-aler">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-aler" name="check-aler" value="2" required>
                <label for="checkNo-aler" >No</label>
              </div>
              <div class="collapse" id="collapse-aler">
                <textarea name="nota-antepatologi-aler" class="form-control input-form" rows="2" cols="2" placeholder="Especificar..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Fracturas: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-frac" name="check-frac" value="1" required >
                <label for="checkSi-frac">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-frac" name="check-frac" value="2" required>
                <label for="checkNo-frac" >No</label>
              </div>
              <div class="collapse" id="collapse-frac">
                <textarea name="nota-antepatologi-frac" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuáles?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Diabetes Mellitus: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-DiaMelli" name="check-DiaMelli" value="1" required >
                <label for="checkSi-DiaMelli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-DiaMelli" name="check-DiaMelli" value="2" required>
                <label for="checkNo-DiaMelli" >No</label>
              </div>
              <div class="collapse" id="collapse-DiaMelli">
                <textarea name="nota-antepatologi-DiaMelli" class="form-control input-form" rows="2" cols="2" placeholder="Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Hispertensión Arterial: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hiArt" name="check-hiArt" value="1" required >
                <label for="checkSi-hiArt">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hiArt" name="check-hiArt" value="2" required>
                <label for="checkNo-hiArt" >No</label>
              </div>
              <div class="collapse" id="collapse-hiArt">
                <textarea name="nota-antepatologi-hiArt" class="form-control input-form" rows="2" cols="2" placeholder="Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Dislipidemia: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-disli" name="check-disli" value="1" required >
                <label for="checkSi-disli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-disli" name="check-disli" value="2" required>
                <label for="checkNo-disli" >No</label>
              </div>
              <div class="collapse" id="collapse-disli">
                <textarea name="nota-antepatologi-disli" class="form-control input-form" rows="2" cols="2" placeholder="Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Enfermedad Tiroidea: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enTiro" name="check-enTiro" value="1" required >
                <label for="checkSi-enTiro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enTiro" name="check-enTiro" value="2" required>
                <label for="checkNo-enTiro" >No</label>
              </div>
              <div class="collapse" id="collapse-enTiro">
                <textarea name="nota-antepatologi-enTiro" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Cardiopatías: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-cardi" name="check-cardi" value="1" required >
                <label for="checkSi-cardi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-cardi" name="check-cardi" value="2" required>
                <label for="checkNo-cardi" >No</label>
              </div>
              <div class="collapse" id="collapse-cardi">
                <textarea name="nota-antepatologi-cardi" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Cáncer: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-cancr" name="check-cancr" value="1" required >
                <label for="checkSi-cancr">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-cancr" name="check-cancr" value="2" required>
                <label for="checkNo-cancr" >No</label>
              </div>
              <div class="collapse" id="collapse-cancr">
                <textarea name="nota-antepatologi-cancr" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Transfusiones: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-trans" name="check-trans" value="1" required >
                <label for="checkSi-trans">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-trans" name="check-trans" value="2" required>
                <label for="checkNo-trans" >No</label>
              </div>
              <div class="collapse" id="collapse-trans">
                <textarea name="nota-antepatologi-trans" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Enfermedad Respiratoria: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfRespi" name="check-enfRespi" value="1" required >
                <label for="checkSi-enfRespi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfRespi" name="check-enfRespi" value="2" required>
                <label for="checkNo-enfRespi" >No</label>
              </div>
              <div class="collapse" id="collapse-enfRespi">
                <textarea name="nota-antepatologi-enfRespi" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Enfermedad Gastrointestinal: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfGastro" name="check-enfGastro" value="1" required >
                <label for="checkSi-enfGastro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfGastro" name="check-enfGastro" value="2" required>
                <label for="checkNo-enfGastro" >No</label>
              </div>
              <div class="collapse" id="collapse-enfGastro">
                <textarea name="nota-antepatologi-enfGastro" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Enfermedad psicológica-psiquiátrica: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfPsiciPsiq" name="check-enfPsiciPsiq" value="1" required >
                <label for="checkSi-enfPsiciPsiq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfPsiciPsiq" name="check-enfPsiciPsiq" value="2" required>
                <label for="checkNo-enfPsiciPsiq" >No</label>
              </div>
              <div class="collapse" id="collapse-enfPsiciPsiq">
                <textarea name="nota-antepatologi-enfPsiciPsiq" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Tuberclosis: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Turberclo" name="check-Turberclo" value="1" required >
                <label for="checkSi-Turberclo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Turberclo" name="check-Turberclo" value="2" required>
                <label for="checkNo-Turberclo" >No</label>
              </div>
              <div class="collapse" id="collapse-Turberclo">
                <textarea name="nota-antepatologi-Turberclo" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Traumatismos: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Trauma" name="check-Trauma" value="1" required >
                <label for="checkSi-Trauma">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Trauma" name="check-Trauma" value="2" required>
                <label for="checkNo-Trauma" >No</label>
              </div>
              <div class="collapse" id="collapse-Trauma">
                <textarea name="nota-antepatologi-Trauma" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Enfermedad de transmisión sexual: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfTransSex" name="check-enfTransSex" value="1" required >
                <label for="checkSi-enfTransSex">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfTransSex" name="check-enfTransSex" value="2" required>
                <label for="checkNo-enfTransSex" >No</label>
              </div>
              <div class="collapse" id="collapse-enfTransSex">
                <textarea name="nota-antepatologi-enfTransSex" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Hospitalización previa: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hospitaPrevia" name="check-hospitaPrevia" value="1" required >
                <label for="checkSi-hospitaPrevia">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hospitaPrevia" name="check-hospitaPrevia" value="2" required>
                <label for="checkNo-hospitaPrevia" >No</label>
              </div>
              <div class="collapse" id="collapse-hospitaPrevia">
                <textarea name="nota-antepatologi-hospitaPrevia" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Cirugía previa: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ciruPrev" name="check-ciruPrev" value="1" required >
                <label for="checkSi-ciruPrev">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ciruPrev" name="check-ciruPrev" value="2" required>
                <label for="checkNo-ciruPrev" >No</label>
              </div>
              <div class="collapse" id="collapse-ciruPrev">
                <textarea name="nota-antepatologi-ciruPrev" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, Años, tratamiento..."></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-nopatologicos">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-nopatologicos-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; ANTECEDENTES NO PATOLOGICOS
          </button>
        </h2>
        <div id="collapse-nopatologicos-Target" class="accordion-collapse collapse" aria-labelledby="collap-nopatologicos">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Tabaquismo: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-tabaq" name="check-tabaq" value="1" required >
                <label for="checkSi-tabaq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-tabaq" name="check-tabaq" value="2" required>
                <label for="checkNo-tabaq" >No</label>
              </div>
              <div class="collapse" id="collapse-tabaq">
                <textarea name="nota-antePatologico-tabaq" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Alcoholismo: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-alcoh" name="check-alcoh" value="1" required >
                <label for="checkSi-alcoh">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-alcoh" name="check-alcoh" value="2" required>
                <label for="checkNo-alcoh" >No</label>
              </div>
              <div class="collapse" id="collapse-alcoh">
                <textarea name="nota-antePatologico-alcoh" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Uso de drogas: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-usDrog" name="check-usDrog" value="1" required >
                <label for="checkSi-usDrog">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-usDrog" name="check-usDrog" value="2" required>
                <label for="checkNo-usDrog" >No</label>
              </div>
              <div class="collapse" id="collapse-usDrog">
                <textarea name="nota-antePatologico-usDrog" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Actividad física: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-actFisica" name="check-actFisica" value="1" required >
                <label for="checkSi-actFisica">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-actFisica" name="check-actFisica" value="2" required>
                <label for="checkNo-actFisica" >No</label>
              </div>
              <div class="collapse" id="collapse-actFisica">
                <textarea name="nota-antePatologico-actFisica" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Vivienda con servicios de urbanización: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-viviSerUrba" name="check-viviSerUrba" value="1" required >
                <label for="checkSi-viviSerUrba">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-viviSerUrba" name="check-viviSerUrba" value="2" required>
                <label for="checkNo-viviSerUrba" >No</label>
              </div>
              <div class="collapse" id="collapse-viviSerUrba">
                <textarea name="nota-antePatologico-viviSerUrba" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Actividad Sexual: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-actSex" name="check-actSex" value="1" required >
                <label for="checkSi-actSex">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-actSex" name="check-actSex" value="2" required>
                <label for="checkNo-actSex" >No</label>
              </div>
              <div class="collapse" id="collapse-actSex">
                <textarea name="nota-antePatologico-actSex" class="form-control input-form" rows="2" cols="2" placeholder="Frecuencia..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Vacuna o inmunización reciente: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-vacReci" name="check-vacReci" value="1" required >
                <label for="checkSi-vacReci">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-vacReci" name="check-vacReci" value="2" required>
                <label for="checkNo-vacReci" >No</label>
              </div>
              <div class="collapse" id="collapse-vacReci">
                <textarea name="nota-antePatologico-vacReci" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, fecha"></textarea>
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
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Padre: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hero-padre" name="check-hero-padre" value="1" required >
                <label for="checkSi-hero-padre">Fallecido</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hero-padre" name="check-hero-padre" value="2" required>
                <label for="checkNo-hero-padre" >Vivo</label>
              </div>
              <div class="collapse" id="collapse-hero-padre">
                <textarea name="nota-anteHeredo-padre" class="form-control input-form" rows="2" cols="2" placeholder="¿Causa?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Diabetes Mellitus: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-diabe-padre" name="check-diabe-padre" value="1" required >
                <label for="checkSi-diabe-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-diabe-padre" name="check-diabe-padre" value="2" required>
                <label for="checkNo-diabe-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-diabe-padre">
                <textarea name="nota-anteHeredo-diabe-padre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Hispertensión Arterial: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hisperArt-padre" name="check-hisperArt-padre" value="1" required >
                <label for="checkSi-hisperArt-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hisperArt-padre" name="check-hisperArt-padre" value="2" required>
                <label for="checkNo-hisperArt-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-hisperArt-padre">
                <textarea name="nota-anteHeredo-hisperArt-padre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Cáncer: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-canc-padre" name="check-canc-padre" value="1" required >
                <label for="checkSi-canc-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-canc-padre" name="check-canc-padre" value="2" required>
                <label for="checkNo-canc-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-canc-padre">
                <textarea name="nota-anteHeredo-canc-padre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Otras: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-otra-padre" name="check-otra-padre" value="1" required >
                <label for="checkSi-otra-padre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-otra-padre" name="check-otra-padre" value="2" required>
                <label for="checkNo-otra-padre" >No</label>
              </div>
              <div class="collapse" id="collapse-otra-padre">
                <textarea name="nota-anteHeredo-otra-padre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <br>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Madre: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hero-madre" name="check-hero-madre" value="1" required >
                <label for="checkSi-hero-madre">Fallecida</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hero-madre" name="check-hero-madre" value="2" required>
                <label for="checkNo-hero-madre" >Viva</label>
              </div>
              <div class="collapse" id="collapse-hero-madre">
                <textarea name="nota-anteHeredo-madre" class="form-control input-form" rows="2" cols="2" placeholder="¿Causa?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Diabetes Mellitus: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-diabe-madre" name="check-diabe-madre" value="1" required >
                <label for="checkSi-diabe-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-diabe-madre" name="check-diabe-madre" value="2" required>
                <label for="checkNo-diabe-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-diabe-madre">
                <textarea name="nota-anteHeredo-diabe-madre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Hispertensión Arterial: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-hisperArt-madre" name="check-hisperArt-madre" value="1" required >
                <label for="checkSi-hisperArt-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-hisperArt-madre" name="check-hisperArt-madre" value="2" required>
                <label for="checkNo-hisperArt-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-hisperArt-madre">
                <textarea name="nota-anteHeredo-hisperArt-madre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Cáncer: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-canc-madre" name="check-canc-madre" value="1" required >
                <label for="checkSi-canc-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-canc-madre" name="check-canc-madre" value="2" required>
                <label for="checkNo-canc-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-canc-madre">
                <textarea name="nota-anteHeredo-canc-madre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Otras: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-otra-madre" name="check-otra-madre" value="1" required >
                <label for="checkSi-otra-madre">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-otra-madre" name="check-otra-madre" value="2" required>
                <label for="checkNo-otra-madre" >No</label>
              </div>
              <div class="collapse" id="collapse-otra-madre">
                <textarea name="nota-anteHeredo-otra-madre" class="form-control input-form" rows="2" cols="2" placeholder="..."></textarea>
              </div>
            </div>
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
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Padeces alguna enfermedad psicológica o psiquiátrica: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-enfpsicopsiq" name="check-enfpsicopsiq" value="1" required >
                <label for="checkSi-enfpsicopsiq">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enfpsicopsiq" name="check-enfpsicopsiq" value="2" required>
                <label for="checkNo-enfpsicopsiq" >No</label>
              </div>
              <div class="collapse" id="collapse-enfpsicopsiq">
                <textarea name="nota-antePsicoPsiqo-enfpsicopsiq" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Qué área de tu vida han sido afectadas por la enfermedad?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required id="checkFamiliar-enfAfect" name="check-enfAfect" value="3" required >
                  <label for="checkFamiliar-enfAfect">Familiar</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="checkSocial-enfAfect" name="check-enfAfect" value="4" required>
                  <label for="checkSocial-enfAfect" >Social</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Laboral-enfAfect" name="check-enfAfect" value="5" required>
                  <label for="check-Laboral-enfAfect">Laboral</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Todas-enfAfect" name="check-enfAfect" value="5" required>
                  <label for="check-Todas-enfAfect">Todas</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Ninguna-enfAfect" name="check-enfAfect" value="2" required>
                  <label for="check-Ninguna-enfAfect">Ninguna</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Con qué frecuencia te sientes feliz?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecFeliz" name="check-frecFeliz" value="7" required>
                  <label for="check-Nunca-frecFeliz">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecFeliz" name="check-frecFeliz" value="8" required>
                  <label for="check-A veces-frecFeliz">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecFeliz" name="check-frecFeliz" value="9" required>
                  <label for="check-Siempre-frecFeliz">Siempre</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>¿Te sientes realizado?: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-sienRealiz" name="check-sienRealiz" value="1" required >
                <label for="checkSi-sienRealiz">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-sienRealiz" name="check-sienRealiz" value="2" required>
                <label for="checkNo-sienRealiz" >No</label>
              </div>
              <div class="collapse" id="collapse-sienRealiz">
                <textarea name="nota-antePsicoPsiqo-sienRealiz" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Con qué frecuencia te sientes solo?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecSolo" name="check-frecSolo" value="7" required>
                  <label for="check-Nunca-frecSolo">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecSolo" name="check-frecSolo" value="8" required>
                  <label for="check-A veces-frecSolo">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecSolo" name="check-frecSolo" value="9" required>
                  <label for="check-Siempre-frecSolo">Siempre</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Con qué frecuencia te sientes triste?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frectris" name="check-frectris" value="7" required>
                  <label for="check-Nunca-frectris">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frectris" name="check-frectris" value="8" required>
                  <label for="check-A veces-frectris">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frectris" name="check-frectris" value="9" required>
                  <label for="check-Siempre-frectris">Siempre</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Constantemente te sientes frustado ante situaciones cotidianas?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-situaciCotidia" name="check-situaciCotidia" value="7" required>
                  <label for="check-Nunca-situaciCotidia">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-situaciCotidia" name="check-situaciCotidia" value="8" required>
                  <label for="check-A veces-situaciCotidia">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-situaciCotidia" name="check-situaciCotidia" value="9" required>
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
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Desayuno: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Desayuno" name="check-Desayuno" value="1" required >
                <label for="checkSi-Desayuno">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Desayuno" name="check-Desayuno" value="2" required>
                <label for="checkNo-Desayuno" >No</label>
              </div>
              <div class="collapse" id="collapse-Desayuno">
                <textarea name="nota-antNutrio-Desayuno" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Colación en la mañana: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-colaMana" name="check-colaMana" value="1" required >
                <label for="checkSi-colaMana">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-colaMana" name="check-colaMana" value="2" required>
                <label for="checkNo-colaMana" >No</label>
              </div>
              <div class="collapse" id="collapse-colaMana">
                <textarea name="nota-antNutrio-colaMana" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Comida: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-Comida" name="check-Comida" value="1" required >
                <label for="checkSi-Comida">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-Comida" name="check-Comida" value="2" required>
                <label for="checkNo-Comida" >No</label>
              </div>
              <div class="collapse" id="collapse-Comida">
                <textarea name="nota-antNutrio-Comida" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Colación en la tarde: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-colaTarde" name="check-colaTarde" value="1" required >
                <label for="checkSi-colaTarde">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-colaTarde" name="check-colaTarde" value="2" required>
                <label for="checkNo-colaTarde" >No</label>
              </div>
              <div class="collapse" id="collapse-colaTarde">
                <textarea name="nota-antNutrio-colaTarde" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>¿Consumes alimentos preparados en casa?: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-alimePrepa" name="check-alimePrepa" value="1" required >
                <label for="checkSi-alimePrepa">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-alimePrepa" name="check-alimePrepa" value="2" required>
                <label for="checkNo-alimePrepa" >No</label>
              </div>
              <div class="collapse" id="collapse-alimePrepa">
                <textarea name="nota-antNutrio-alimePrepa" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Con qué frecuencia consumes alimentos preparados en la calle?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Nunca-frecAlimprepa" name="check-frecAlimprepa" value="7" required>
                  <label for="check-Nunca-frecAlimprepa">Nunca</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-A veces-frecAlimprepa" name="check-frecAlimprepa" value="8" required>
                  <label for="check-A veces-frecAlimprepa">A veces</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Siempre-frecAlimprepa" name="check-frecAlimprepa" value="9" required>
                  <label for="check-Siempre-frecAlimprepa">Siempre</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Cuál es tu nivel de apetito?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Bueno-nivelApeti" name="check-nivelApeti" value="10" required>
                  <label for="check-Bueno-nivelApeti">Bueno</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Regular-nivelApeti" name="check-nivelApeti" value="11" required>
                  <label for="check-Regular-nivelApeti">Regular</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Malo-nivelApeti" name="check-nivelApeti" value="12" required>
                  <label for="check-Malo-nivelApeti">Malo</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Cuál es tu nivel de saciedad?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-Bueno-nivelSacied" name="check-nivelSacied" value="10" required>
                  <label for="check-Bueno-nivelSacied">Bueno</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Regular-nivelSacied" name="check-nivelSacied" value="11" required>
                  <label for="check-Regular-nivelSacied">Regular</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-Malo-nivelSacied" name="check-nivelSacied" value="12" required>
                  <label for="check-Malo-nivelSacied">Malo</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 95%;margin-top: 5px;">
              <div class="col-5">
                <label>¿Cuántos vasos de agua consumes al día?: </label>
              </div>
              <div class="col-7 row d-flex align-items-center">
                <div class="col-4">
                  <input type="radio" required  id="check-03-vasosAguaConsuem" name="check-vasosAguaConsuem" value="13" required>
                    <label for="check-03-vasosAguaConsuem">0 a 3</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-46-vasosAguaConsuem" name="check-vasosAguaConsuem" value="14" required>
                  <label for="check-46-vasosAguaConsuem">4 a 6</label>
                </div>
                <div class="col-4">
                  <input type="radio" required  id="check-79-vasosAguaConsuem" name="check-vasosAguaConsuem" value="15" required>
                  <label for="check-79-vasosAguaConsuem">7 a 9</label>
                </div>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>¿Padeces alguna enfermedad relacionada a los alimentos: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checksi-enferRelaciAlime" name="check-PadeceEnfeAlime" value="1" required >
                <label for="checksi-enferRelaciAlime">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-enferRelaciAlime" name="check-PadeceEnfeAlime" value="2" required>
                <label for="checkNo-enferRelaciAlime" >No</label>
              </div>
              <div class="collapse" id="collapse-PadeceEnfeAlime">
                <textarea name="nota-antNutrio-PadeceEnfeAlime" class="form-control input-form" rows="2" cols="2" placeholder="Especifique"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Consumes suplementos alimenticios: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ConssupleAli" name="check-ConssupleAli" value="1" required >
                <label for="checkSi-ConssupleAli">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ConssupleAli" name="check-ConssupleAli" value="2" required>
                <label for="checkNo-ConssupleAli" >No</label>
              </div>
              <div class="collapse" id="collapse-ConssupleAli">
                <textarea name="nota-antNutrio-ConssupleAli" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?"></textarea>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="accordion-item bg-acordion">
        <h2 class="accordion-header" id="collap-MedLabo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-MedLabo-Target" aria-expanded="false" aria-controls="accordionEstudios">
            <i class="bi bi-plus-circle-fill"></i>&nbsp;&nbsp;&nbsp; MEDIO LABORAL
          </button>
        </h2>
        <div id="collapse-MedLabo-Target" class="accordion-collapse collapse" aria-labelledby="collap-MedLabo">
          <div class="accordion-body">
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Incapacidades por accidentes: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-incapaAccid" name="check-incapaAccid" value="1" required >
                <label for="checkSi-incapaAccid">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-incapaAccid" name="check-incapaAccid" value="2" required>
                <label for="checkNo-incapaAccid" >No</label>
              </div>
              <div class="collapse" id="collapse-incapaAccid">
                <textarea name="nota-mediLabor-incapaAccid" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Incapacidad por enfermedad: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-incapaEnfer" name="check-incapaEnfer" value="1" required >
                <label for="checkSi-incapaEnfer">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-incapaEnfer" name="check-incapaEnfer" value="2" required>
                <label for="checkNo-incapaEnfer" >No</label>
              </div>
              <div class="collapse" id="collapse-incapaEnfer">
                <textarea name="nota-mediLabor-incapaEnfer" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Condiciones de la piel por contacto con materiales: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-condiPielMateri" name="check-condiPielMateri" value="1" required >
                <label for="checkSi-condiPielMateri">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-condiPielMateri" name="check-condiPielMateri" value="2" required>
                <label for="checkNo-condiPielMateri" >No</label>
              </div>
              <div class="collapse" id="collapse-condiPielMateri">
                <textarea name="nota-mediLabor-condiPielMateri" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Fracturas o lesiones por trabajo: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-fracLesiTrab" name="check-fracLesiTrab" value="1" required >
                <label for="checkSi-fracLesiTrab">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-fracLesiTrab" name="check-fracLesiTrab" value="2" required>
                <label for="checkNo-fracLesiTrab" >No</label>
              </div>
              <div class="collapse" id="collapse-fracLesiTrab">
                <textarea name="nota-mediLabor-fracLesiTrab" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Antecedentes enfermedades por trabajo: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-anteEnferTrabajo" name="check-anteEnferTrabajo" value="1" required >
                <label for="checkSi-anteEnferTrabajo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-anteEnferTrabajo" name="check-anteEnferTrabajo" value="2" required>
                <label for="checkNo-anteEnferTrabajo" >No</label>
              </div>
              <div class="collapse" id="collapse-anteEnferTrabajo">
                <textarea name="nota-mediLabor-anteEnferTrabajo" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición con material polvoso: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoMatpolvo" name="check-expoMatpolvo" value="1" required >
                <label for="checkSi-expoMatpolvo">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoMatpolvo" name="check-expoMatpolvo" value="2" required>
                <label for="checkNo-expoMatpolvo" >No</label>
              </div>
              <div class="collapse" id="collapse-expoMatpolvo">
                <textarea name="nota-mediLabor-expoMatpolvo" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a ruidos fuertes: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposiRuidFuertes" name="check-exposiRuidFuertes" value="1" required >
                <label for="checkSi-exposiRuidFuertes">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposiRuidFuertes" name="check-exposiRuidFuertes" value="2" required>
                <label for="checkNo-exposiRuidFuertes" >No</label>
              </div>
              <div class="collapse" id="collapse-exposiRuidFuertes">
                <textarea name="nota-mediLabor-exposiRuidFuertes" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a sustancias químicas: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoSustQuimi" name="check-expoSustQuimi" value="1" required >
                <label for="checkSi-expoSustQuimi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoSustQuimi" name="check-expoSustQuimi" value="2" required>
                <label for="checkNo-expoSustQuimi" >No</label>
              </div>
              <div class="collapse" id="collapse-expoSustQuimi">
                <textarea name="nota-mediLabor-expoSustQuimi" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a gases: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposGases" name="check-exposGases" value="1" required >
                <label for="checkSi-exposGases">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposGases" name="check-exposGases" value="2" required>
                <label for="checkNo-exposGases" >No</label>
              </div>
              <div class="collapse" id="collapse-exposGases">
                <textarea name="nota-mediLabor-exposGases" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a líquidos inflamables: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoLiquinfla" name="check-expoLiquinfla" value="1" required >
                <label for="checkSi-expoLiquinfla">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoLiquinfla" name="check-expoLiquinfla" value="2" required>
                <label for="checkNo-expoLiquinfla" >No</label>
              </div>
              <div class="collapse" id="collapse-expoLiquinfla">
                <textarea name="nota-mediLabor-expoLiquinfla" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a sólidos inflamables: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposoliInflamables" name="check-exposoliInflamables" value="1" required >
                <label for="checkSi-exposoliInflamables">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposoliInflamables" name="check-exposoliInflamables" value="2" required>
                <label for="checkNo-exposoliInflamables" >No</label>
              </div>
              <div class="collapse" id="collapse-exposoliInflamables">
                <textarea name="nota-mediLabor-exposoliInflamables" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a explosivos: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-expoExplosi" name="check-expoExplosi" value="1" required >
                <label for="checkSi-expoExplosi">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-expoExplosi" name="check-expoExplosi" value="2" required>
                <label for="checkNo-expoExplosi" >No</label>
              </div>
              <div class="collapse" id="collapse-expoExplosi">
                <textarea name="nota-mediLabor-expoExplosi" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a materiales radioactivos: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-ExposimateRadio" name="check-ExposimateRadio" value="1" required >
                <label for="checkSi-ExposimateRadio">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-ExposimateRadio" name="check-ExposimateRadio" value="2" required>
                <label for="checkNo-ExposimateRadio" >No</label>
              </div>
              <div class="collapse" id="collapse-ExposimateRadio">
                <textarea name="nota-mediLabor-ExposimateRadio" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a sustancias corrosivas: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposiSusCorro" name="check-exposiSusCorro" value="1" required >
                <label for="checkSi-exposiSusCorro">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposiSusCorro" name="check-exposiSusCorro" value="2" required>
                <label for="checkNo-exposiSusCorro" >No</label>
              </div>
              <div class="collapse" id="collapse-exposiSusCorro">
                <textarea name="nota-mediLabor-exposiSusCorro" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
              </div>
            </div>
            <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
              <div class="col-6">
                <label>Exposición a sustancias venenosas e infecciosas: </label>
              </div>
              <div class="col-3">
                <input type="radio" required id="checkSi-exposSusVeneInfe" name="check-exposSusVeneInfe" value="1" required >
                <label for="checkSi-exposSusVeneInfe">Si</label>
              </div>
              <div class="col-3">
                <input type="radio" required  id="checkNo-exposSusVeneInfe" name="check-exposSusVeneInfe" value="2" required>
                <label for="checkNo-exposSusVeneInfe" >No</label>
              </div>
              <div class="collapse" id="collapse-exposSusVeneInfe">
                <textarea name="nota-mediLabor-exposSusVeneInfe" class="form-control input-form" rows="2" cols="2" placeholder="Especifique, enfermedad y tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Disnea: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-disnea" name="check-disnea" value="1" required >
                      <label for="checkSi-disnea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-disnea" name="check-disnea" value="2" required>
                      <label for="checkNo-disnea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-disnea">
                      <textarea name="nota-sistCardi-disnea" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Frialdad de extremidades: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-frialExtremida" name="check-frialExtremida" value="1" required >
                      <label for="checkSi-frialExtremida">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-frialExtremida" name="check-frialExtremida" value="2" required>
                      <label for="checkNo-frialExtremida" >No</label>
                    </div>
                    <div class="collapse" id="collapse-frialExtremida">
                      <textarea name="nota-sistCardi-frialExtremida" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Dolor torácico: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-dolorToraci" name="check-dolorToraci" value="1" required >
                      <label for="checkSi-dolorToraci">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-dolorToraci" name="check-dolorToraci" value="2" required>
                      <label for="checkNo-dolorToraci" >No</label>
                    </div>
                    <div class="collapse" id="collapse-dolorToraci">
                      <textarea name="nota-sistCardi-dolorToraci" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Palpitaciones: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-palpita" name="check-palpita" value="1" required >
                      <label for="checkSi-palpita">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-palpita" name="check-palpita" value="2" required>
                      <label for="checkNo-palpita" >No</label>
                    </div>
                    <div class="collapse" id="collapse-palpita">
                      <textarea name="nota-sistCardi-palpita" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Edema: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-edema" name="check-edema" value="1" required >
                      <label for="checkSi-edema">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-edema" name="check-edema" value="2" required>
                      <label for="checkNo-edema" >No</label>
                    </div>
                    <div class="collapse" id="collapse-edema">
                      <textarea name="nota-sistCardi-edema" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Úlceras cutáneas: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-ulceCutane" name="check-ulceCutane" value="1" required >
                      <label for="checkSi-ulceCutane">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-ulceCutane" name="check-ulceCutane" value="2" required>
                      <label for="checkNo-ulceCutane" >No</label>
                    </div>
                    <div class="collapse" id="collapse-ulceCutane">
                      <textarea name="nota-sistCardi-ulceCutane" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Claudicación a la deambulación: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-claudiDeambula" name="check-claudiDeambula" value="1" required >
                      <label for="checkSi-claudiDeambula">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-claudiDeambula" name="check-claudiDeambula" value="2" required>
                      <label for="checkNo-claudiDeambula" >No</label>
                    </div>
                    <div class="collapse" id="collapse-claudiDeambula">
                      <textarea name="nota-sistCardi-claudiDeambula" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Cianosis: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-cianosis" name="check-cianosis" value="1" required >
                      <label for="checkSi-cianosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-cianosis" name="check-cianosis" value="2" required>
                      <label for="checkNo-cianosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-cianosis">
                      <textarea name="nota-sistCardi-cianosis" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Disnea: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-disnea" name="check-aparaRespir-disnea" value="1" required >
                      <label for="checkSi-aparaRespir-disnea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-disnea" name="check-aparaRespir-disnea" value="2" required>
                      <label for="checkNo-aparaRespir-disnea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-disnea">
                      <textarea name="nota-aparaRespir-disnea" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Tos: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-tos" name="check-aparaRespir-tos" value="1" required >
                      <label for="checkSi-aparaRespir-tos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-tos" name="check-aparaRespir-tos" value="2" required>
                      <label for="checkNo-aparaRespir-tos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-tos">
                      <textarea name="nota-aparaRespir-tos" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Expectoración: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-expectoracion" name="check-aparaRespir-expectoracion" value="1" required >
                      <label for="checkSi-aparaRespir-expectoracion">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-expectoracion" name="check-aparaRespir-expectoracion" value="2" required>
                      <label for="checkNo-aparaRespir-expectoracion" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-expectoracion">
                      <textarea name="nota-aparaRespir-expectoracion" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Dolor: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-dolor" name="check-aparaRespir-dolor" value="1" required >
                      <label for="checkSi-aparaRespir-dolor">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-dolor" name="check-aparaRespir-dolor" value="2" required>
                      <label for="checkNo-aparaRespir-dolor" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-dolor">
                      <textarea name="nota-aparaRespir-dolor" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Asma: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-asma" name="check-aparaRespir-asma" value="1" required >
                      <label for="checkSi-aparaRespir-asma">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-asma" name="check-aparaRespir-asma" value="2" required>
                      <label for="checkNo-aparaRespir-asma" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-asma">
                      <textarea name="nota-aparaRespir-asma" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Cianosis: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-cianosis" name="check-aparaRespir-cianosis" value="1" required >
                      <label for="checkSi-aparaRespir-cianosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-cianosis" name="check-aparaRespir-cianosis" value="2" required>
                      <label for="checkNo-aparaRespir-cianosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-cianosis">
                      <textarea name="nota-aparaRespir-cianosis" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Roncador: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-roncador" name="check-aparaRespir-roncador" value="1" required >
                      <label for="checkSi-aparaRespir-roncador">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-roncador" name="check-aparaRespir-roncador" value="2" required>
                      <label for="checkNo-aparaRespir-roncador" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-roncador">
                      <textarea name="nota-aparaRespir-roncador" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Infecciones respiratorias: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparaRespir-infeccRespira" name="check-aparaRespir-infeccRespira" value="1" required >
                      <label for="checkSi-aparaRespir-infeccRespira">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparaRespir-infeccRespira" name="check-aparaRespir-infeccRespira" value="2" required>
                      <label for="checkNo-aparaRespir-infeccRespira" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparaRespir-infeccRespira">
                      <textarea name="nota-aparaRespir-infeccRespira" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Digestión: </label>
                    </div>
                    <div class="" id="collapse-aparaRespir-roncador">
                      <textarea name="nota-aparaRespir-digestion" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Flatulencias: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-flatulencias" name="check-aparatoDigestivo-flatulencias" value="1" required >
                      <label for="checkSi-aparatoDigestivo-flatulencias">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-flatulencias" name="check-aparatoDigestivo-flatulencias" value="2" required>
                      <label for="checkNo-aparatoDigestivo-flatulencias" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-flatulencias">
                      <textarea name="nota-aparatoDigestivo-flatulencias" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Meteorismo: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-meteorismo" name="check-aparatoDigestivo-meteorismo" value="1" required >
                      <label for="checkSi-aparatoDigestivo-meteorismo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-meteorismo" name="check-aparatoDigestivo-meteorismo" value="2" required>
                      <label for="checkNo-aparatoDigestivo-meteorismo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-meteorismo">
                      <textarea name="nota-aparatoDigestivo-meteorismo" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Pirosis: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-pirosis" name="check-aparatoDigestivo-pirosis" value="1" required >
                      <label for="checkSi-aparatoDigestivo-pirosis">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-pirosis" name="check-aparatoDigestivo-pirosis" value="2" required>
                      <label for="checkNo-aparatoDigestivo-pirosis" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-pirosis">
                      <textarea name="nota-aparatoDigestivo-pirosis" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Disfagia: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-disfagia" name="check-aparatoDigestivo-disfagia" value="1" required >
                      <label for="checkSi-aparatoDigestivo-disfagia">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-disfagia" name="check-aparatoDigestivo-disfagia" value="2" required>
                      <label for="checkNo-aparatoDigestivo-disfagia" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-disfagia">
                      <textarea name="nota-aparatoDigestivo-disfagia" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Odinofagia: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-odinofagia" name="check-aparatoDigestivo-odinofagia" value="1" required >
                      <label for="checkSi-aparatoDigestivo-odinofagia">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-odinofagia" name="check-aparatoDigestivo-odinofagia" value="2" required>
                      <label for="checkNo-aparatoDigestivo-odinofagia" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-odinofagia">
                      <textarea name="nota-aparatoDigestivo-odinofagia" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Reflujo: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-reflujo" name="check-aparatoDigestivo-reflujo" value="1" required >
                      <label for="checkSi-aparatoDigestivo-reflujo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-reflujo" name="check-aparatoDigestivo-reflujo" value="2" required>
                      <label for="checkNo-aparatoDigestivo-reflujo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-reflujo">
                      <textarea name="nota-aparatoDigestivo-reflujo" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Nauseas: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-Nauseas" name="check-aparatoDigestivo-Nauseas" value="1" required >
                      <label for="checkSi-aparatoDigestivo-Nauseas">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-Nauseas" name="check-aparatoDigestivo-Nauseas" value="2" required>
                      <label for="checkNo-aparatoDigestivo-Nauseas" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-Nauseas">
                      <textarea name="nota-aparatoDigestivo-Nauseas" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Vómitos: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-Vómitos" name="check-aparatoDigestivo-Vómitos" value="1" required >
                      <label for="checkSi-aparatoDigestivo-Vómitos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-Vómitos" name="check-aparatoDigestivo-Vómitos" value="2" required>
                      <label for="checkNo-aparatoDigestivo-Vómitos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-Vómitos">
                      <textarea name="nota-aparatoDigestivo-Vómitos" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Ritmo intestinal: </label>
                    </div>
                    <div class="" id="collapse-aparatoDigestivo-ritmaIntestinal">
                      <textarea name="nota-aparatoDigestivo-ritmaIntestinal" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Heces (Color, consistencia): </label>
                    </div>
                    <div class="" id="collapse-aparatoDigestivo-hecesColroConsis">
                      <textarea name="nota-aparatoDigestivo-hecesColroConsis" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Cantidad de orina al día: </label>
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-cantidadOrinaDia">
                      <textarea name="nota-aparatoGenitourina-cantidadOrinaDia" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Color de orina: </label>
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-colorOrina">
                      <textarea name="nota-aparatoGenitourina-colorOrina" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Hematuria: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-Hematuria" name="check-aparatoDigestivo-Hematuria" value="1" required >
                      <label for="checkSi-aparatoDigestivo-Hematuria">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-Hematuria" name="check-aparatoDigestivo-Hematuria" value="2" required>
                      <label for="checkNo-aparatoDigestivo-Hematuria" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-Hematuria">
                      <textarea name="nota-aparatoDigestivo-Hematuria" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Disuria: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-disuria" name="check-aparatoDigestivo-disuria" value="1" required >
                      <label for="checkSi-aparatoDigestivo-disuria">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-disuria" name="check-aparatoDigestivo-disuria" value="2" required>
                      <label for="checkNo-aparatoDigestivo-disuria" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-disuria">
                      <textarea name="nota-aparatoDigestivo-disuria" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Poliaquiuria: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-poliaquiur" name="check-aparatoDigestivo-poliaquiur" value="1" required >
                      <label for="checkSi-aparatoDigestivo-poliaquiur">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-poliaquiur" name="check-aparatoDigestivo-poliaquiur" value="2" required>
                      <label for="checkNo-aparatoDigestivo-poliaquiur" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-poliaquiur">
                      <textarea name="nota-aparatoDigestivo-poliaquiur" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Tenesmo: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoDigestivo-tenesm" name="check-aparatoDigestivo-tenesm" value="1" required >
                      <label for="checkSi-aparatoDigestivo-tenesm">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoDigestivo-tenesm" name="check-aparatoDigestivo-tenesm" value="2" required>
                      <label for="checkNo-aparatoDigestivo-tenesm" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoDigestivo-tenesm">
                      <textarea name="nota-aparatoDigestivo-tenesm" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Micción imperiosa: </label>
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-micciImperi">
                      <textarea name="nota-aparatoGenitourina-micciImperi" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Expulsión de arenilla: </label>
                    </div>
                    <div class="" id="collapse-aparatoGenitourina-expulsiArenilla">
                      <textarea name="nota-aparatoGenitourina-expulsiArenilla" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Cefalea: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Cefalea" name="check-sistemNervios-Cefalea" value="1" required >
                      <label for="checkSi-sistemNervios-Cefalea">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Cefalea" name="check-sistemNervios-Cefalea" value="2" required>
                      <label for="checkNo-sistemNervios-Cefalea" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Cefalea">
                      <textarea name="nota-sistemNervios-Cefalea" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Parestesias: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Parestesias" name="check-sistemNervios-Parestesias" value="1" required >
                      <label for="checkSi-sistemNervios-Parestesias">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Parestesias" name="check-sistemNervios-Parestesias" value="2" required>
                      <label for="checkNo-sistemNervios-Parestesias" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Parestesias">
                      <textarea name="nota-sistemNervios-Parestesias" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Pérdida de fuerza: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-perdidFuerza" name="check-sistemNervios-perdidFuerza" value="1" required >
                      <label for="checkSi-sistemNervios-perdidFuerza">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-perdidFuerza" name="check-sistemNervios-perdidFuerza" value="2" required>
                      <label for="checkNo-sistemNervios-perdidFuerza" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-perdidFuerza">
                      <textarea name="nota-sistemNervios-perdidFuerza" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Alteraciones en la marcha: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-alterMarcha" name="check-sistemNervios-alterMarcha" value="1" required >
                      <label for="checkSi-sistemNervios-alterMarcha">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-alterMarcha" name="check-sistemNervios-alterMarcha" value="2" required>
                      <label for="checkNo-sistemNervios-alterMarcha" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-alterMarcha">
                      <textarea name="nota-sistemNervios-alterMarcha" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Alteraciones visuales: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-alteracioVisuales" name="check-sistemNervios-alteracioVisuales" value="1" required >
                      <label for="checkSi-sistemNervios-alteracioVisuales">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-alteracioVisuales" name="check-sistemNervios-alteracioVisuales" value="2" required>
                      <label for="checkNo-sistemNervios-alteracioVisuales" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-alteracioVisuales">
                      <textarea name="nota-sistemNervios-alteracioVisuales" class="form-control input-form" rows="2" cols="2" placeholder="(Visión, borrosidad) ¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Temblor: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-temblor" name="check-sistemNervios-temblor" value="1" required >
                      <label for="checkSi-sistemNervios-temblor">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-temblor" name="check-sistemNervios-temblor" value="2" required>
                      <label for="checkNo-sistemNervios-temblor" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-temblor">
                      <textarea name="nota-sistemNervios-temblor" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Calambres: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-sistemNervios-Calambres" name="check-sistemNervios-Calambres" value="1" required >
                      <label for="checkSi-sistemNervios-Calambres">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-sistemNervios-Calambres" name="check-sistemNervios-Calambres" value="2" required>
                      <label for="checkNo-sistemNervios-Calambres" >No</label>
                    </div>
                    <div class="collapse" id="collapse-sistemNervios-Calambres">
                      <textarea name="nota-sistemNervios-Calambres" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Apetito: </label>
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-Apetito">
                      <textarea name="nota-EndrocrinoloMetabolism-Apetito" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Hábitos nutricionales: </label>
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-habitoNutrici">
                      <textarea name="nota-EndrocrinoloMetabolism-habitoNutrici" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Patrón alimentario: </label>
                    </div>
                    <div class="" id="collapse-EndrocrinoloMetabolism-patroAliment">
                      <textarea name="nota-EndrocrinoloMetabolism-patroAliment" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Obesidad: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-Obesidad" name="check-EndrocrinoloMetabolism-Obesidad" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-Obesidad">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-Obesidad" name="check-EndrocrinoloMetabolism-Obesidad" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-Obesidad" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-Obesidad">
                      <textarea name="nota-EndrocrinoloMetabolism-Obesidad" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Delgadez: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-Delgadez" name="check-EndrocrinoloMetabolism-Delgadez" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-Delgadez">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-Delgadez" name="check-EndrocrinoloMetabolism-Delgadez" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-Delgadez" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-Delgadez">
                      <textarea name="nota-EndrocrinoloMetabolism-Delgadez" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Ganacia o pérdida de peso: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-EndrocrinoloMetabolism-gananperdiPeso" name="check-EndrocrinoloMetabolism-gananperdiPeso" value="1" required >
                      <label for="checkSi-EndrocrinoloMetabolism-gananperdiPeso">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-EndrocrinoloMetabolism-gananperdiPeso" name="check-EndrocrinoloMetabolism-gananperdiPeso" value="2" required>
                      <label for="checkNo-EndrocrinoloMetabolism-gananperdiPeso" >No</label>
                    </div>
                    <div class="collapse" id="collapse-EndrocrinoloMetabolism-gananperdiPeso">
                      <textarea name="nota-EndrocrinoloMetabolism-gananperdiPeso" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Dolores osteo-articular: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-DolorOsteoArticu" name="check-aparatoLocomot-DolorOsteoArticu" value="1" required >
                      <label for="checkSi-aparatoLocomot-DolorOsteoArticu">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-DolorOsteoArticu" name="check-aparatoLocomot-DolorOsteoArticu" value="2" required>
                      <label for="checkNo-aparatoLocomot-DolorOsteoArticu" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-DolorOsteoArticu">
                      <textarea name="nota-aparatoLocomot-DolorOsteoArticu" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Reumatismo: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-Reumatismo" name="check-aparatoLocomot-Reumatismo" value="1" required >
                      <label for="checkSi-aparatoLocomot-Reumatismo">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-Reumatismo" name="check-aparatoLocomot-Reumatismo" value="2" required>
                      <label for="checkNo-aparatoLocomot-Reumatismo" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-Reumatismo">
                      <textarea name="nota-aparatoLocomot-Reumatismo" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Inflamación articular: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-inflamaciArticu" name="check-aparatoLocomot-inflamaciArticu" value="1" required >
                      <label for="checkSi-aparatoLocomot-inflamaciArticu">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-inflamaciArticu" name="check-aparatoLocomot-inflamaciArticu" value="2" required>
                      <label for="checkNo-aparatoLocomot-inflamaciArticu" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-inflamaciArticu">
                      <textarea name="nota-aparatoLocomot-inflamaciArticu" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Deformidades: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-aparatoLocomot-Deformidades" name="check-aparatoLocomot-Deformidades" value="1" required >
                      <label for="checkSi-aparatoLocomot-Deformidades">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-aparatoLocomot-Deformidades" name="check-aparatoLocomot-Deformidades" value="2" required>
                      <label for="checkNo-aparatoLocomot-Deformidades" >No</label>
                    </div>
                    <div class="collapse" id="collapse-aparatoLocomot-Deformidades">
                      <textarea name="nota-aparatoLocomot-Deformidades" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Fiebre: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Fiebre" name="check-Termoregulacin-Fiebre" value="1" required >
                      <label for="checkSi-Termoregulacin-Fiebre">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Fiebre" name="check-Termoregulacin-Fiebre" value="2" required>
                      <label for="checkNo-Termoregulacin-Fiebre" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Fiebre">
                      <textarea name="nota-Termoregulacin-Fiebre" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Escalofríos: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Escalofríos" name="check-Termoregulacin-Escalofríos" value="1" required >
                      <label for="checkSi-Termoregulacin-Escalofríos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Escalofríos" name="check-Termoregulacin-Escalofríos" value="2" required>
                      <label for="checkNo-Termoregulacin-Escalofríos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Escalofríos">
                      <textarea name="nota-Termoregulacin-Escalofríos" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Sudoración: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Sudoración" name="check-Termoregulacin-Sudoración" value="1" required >
                      <label for="checkSi-Termoregulacin-Sudoración">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Sudoración" name="check-Termoregulacin-Sudoración" value="2" required>
                      <label for="checkNo-Termoregulacin-Sudoración" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Sudoración">
                      <textarea name="nota-Termoregulacin-Sudoración" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Transtornos: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-Transtornos" name="check-Termoregulacin-Transtornos" value="1" required >
                      <label for="checkSi-Termoregulacin-Transtornos">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-Transtornos" name="check-Termoregulacin-Transtornos" value="2" required>
                      <label for="checkNo-Termoregulacin-Transtornos" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-Transtornos">
                      <textarea name="nota-Termoregulacin-Transtornos" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Congénitos de metabolismo: </label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required id="checkSi-Termoregulacin-congenMetabolism" name="check-Termoregulacin-congenMetabolism" value="1" required >
                      <label for="checkSi-Termoregulacin-congenMetabolism">Si</label>
                    </div>
                    <div class="col-3">
                      <input type="radio" required  id="checkNo-Termoregulacin-congenMetabolism" name="check-Termoregulacin-congenMetabolism" value="2" required>
                      <label for="checkNo-Termoregulacin-congenMetabolism" >No</label>
                    </div>
                    <div class="collapse" id="collapse-Termoregulacin-congenMetabolism">
                      <textarea name="nota-Termoregulacin-congenMetabolism" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Cambios de coloración "manchas": </label>
                    </div>
                    <div class="" id="collapse-piel-CambiosColoracion">
                      <textarea name="nota-piel-CambiosColoracion" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Prurito: </label>
                    </div>
                    <div class="" id="collapse-piel-prurito">
                      <textarea name="nota-piel-prurito" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Frialdad: </label>
                    </div>
                    <div class="" id="collapse-piel-frialdad">
                      <textarea name="nota-piel-frialdad" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
                    </div>
                  </div>
                  <div class="row" style="zoom:110%;margin-left:5%;width: 90%;margin-top: 5px;">
                    <div class="col-6">
                      <label>Dematosis: </label>
                    </div>
                    <div class="" id="collapse-piel-dematosis">
                      <textarea name="nota-piel-dematosis" class="form-control input-form" rows="2" cols="2" placeholder="¿Cuál?, tiempo, tratamiento"></textarea>
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
  //     $(collapID).collapse("hide")
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

  $("#iniciar-consulta").on('click', function(){
    if ($('input[type="radio"]:not(:checked)').length > 125) {
      alert($('input[type="radio"]:not(:checked)').length)
      console.log($('input[type="radio"]:not(:checked)'))
      $('input[type="radio"]').prop("checked", true);
    }else{
      alert("todo bien");
    }
  })

  $("#formAntecedentes-paciente").submit(function (event) {
    event.preventDefault();
    var form = document.getElementById("formAntecedentes-paciente");
    var formData = new FormData(form);
    console.log(formData)
    $.ajax({
      data: formData,
      url: http + servidor + "/nuevo_checkup/api/usuarios_api.php",
      type: "POST",
      processData: false,
      contentType: false,
      success: function (data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {
          Toast.fire({
            icon: "success",
            title: "Equipo registrado!",
            timer: 2000,
          });
          document.getElementById("formAgregarEquipo").reset();
          $("#ModalRegistrarEquipo").modal("hide");
          tablaEquipo.ajax.reload();
        }
      },
    });
    event.preventDefault();
  });
</script>
