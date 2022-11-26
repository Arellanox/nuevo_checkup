<div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div>

<div class="container-fluid" style="z-index:5">
  <div class="row" id="menu-consultorio">
    <div class="col-8 row">
      <?php include "include/info_paci_consulta.php"; ?>
    </div>
    <div class="col-4 d-flex justify-content-end">
      <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" data-bs-toggle="modal" data-bs-target="#modalMotivoConsulta">
        <i class="bi bi-clipboard2-check"></i> Terminar consulta
      </button>
    </div>
    <div class="col-12 d-flex justify-content-center">
      <?php include "include/navbar_consulta.php"; ?>
    </div>
  </div>
</div>

<div class="overflow-auto" style="max-height:70vh; margin-bottom: 50px">
  <div class="container">


    <section id="notas-padecimiento" class="card mt-3">
      <h4 class="m-3">Notas de padecimiento</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name-notas-padecimiento" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aquí sus notas" id="nota-notas-padecimiento"></textarea>
      <div class=" d-flex justify-content-start m-2">
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-guardar-notaPadecimiento">
        <i class="bi bi-paperclip"></i> Guardar
        </button>
      </div>
    </section>

    
    <section id="card-diagnostico" class="card mt-3">
      <h4 class="m-3">Diagnóstico</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name-diagnostico" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aquí sus notas" id="diagnostico-campo-consulta" ></textarea>
      <div class=" d-flex justify-content-start m-2">
        <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-guardar-Diagnostico">
        <i class="bi bi-paperclip"></i> Guardar
        </button>
      </div>
    </section>


    <section id="card-nutricion" class="card mt-3">
      <h4 class="m-3">Nutrición</h4>
      <hr class="dropdown-divider m-2">
      <div class="row m-4">
        <div class="col-6">
          <ul class="list-group info-detalle">
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8 ">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Peso perdido
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8 ">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Grasa
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8 ">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Cintura
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <div class="col-6">
          <ul class="list-group info-detalle">
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8 ">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Agua
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Músculo
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Abdomen
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required>
                </div>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </section>
    <section id="card-exploracion-clinica" class="card mt-3">
      <h4 class="m-3">Exploración clinica</h4>
      <hr class="dropdown-divider m-2">
      <div class="row" style="margin:0">
        <div class="col-5">
          <label for="metodo" class="form-label"></label>
          <select name="metodo" id="select-exploracion-clinica" class="form-select input-form" required>
            <option value="1">Hábito constitucionales</option>
            <option value="2">Cabeza</option>
            <option value="3">Cavidad bucal</option>
            <option value="4">Cuello</option>
            <option value="5">Tórax</option>
            <option value="6">Aparato respiratorio</option>
            <option value="7">Cardiovascular</option>
            <option value="8">Abdomen y pélvis</option>
            <option value="9">Ingles</option>
            <option value="10">Aparato genito-urinario</option>
            <option value="11">Gineco-obstétrico</option>
            <option value="12">Piel y faneras</option>
            <option value="13">Sistema hemolinfopoyético</option>
            <option value="14">Aparato osteomuscular</option>
            <option value="15">Sistema nervioso central</option>
          </select>
          <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aquí sus notas" style="width:95%" id="text-exploracion-clinica"></textarea>
          <div class=" d-flex justify-content-end">
            <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-agregar-exploracion-clinina">
              <i class="bi bi-clipboard-plus"></i> Agregar
            </button>
          </div>
        </div>
        <div class="col-6 card m-3" id="texto-exp-cli">
          Estado de conciencia. Orientación temporo-espacial. Peso. Talla. Indice de masa corporal.
          Deformidades generales, parciales o regionales. Color de piel y mucosas (palidez. Cianosis, ictericia. Manchas.
          Estado de nutrición e hidratación. Presion arterial. Pulso y frecuencia de pulso. Temperatura.
        </div>
      </div>
      <div class="row" style="margin:0">
        <div id="notas-historial-consultorio" class="mt-3">

        </div>
      </div>
    </section>
    <section id="card-anamnesis-aparatos" class="card mt-3">
      <h4 class="m-3">ANAMNESIS POR APARATOS</h4>
      <hr class="dropdown-divider m-2">
        <form class="m-4" id="formAntecedentes">
          <?php include '../../../include/acordion/anamnesis-aparatos.php' ?>
        </form>
    </section>


    <!-- <section id="card-motivo-consulta" class="card mt-3">
      <h4 class="m-3">Motivo de consulta</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" id="motivo-consultaas" placeholder="Escriba aquí sus notas"></textarea>
    </section> -->


    <!-- <section id="card-terapeutico" class="card mt-3">
      <h4 class="m-3">Manejo terapéutico</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" id="manejo-terapeuticoos" placeholder="Escriba aquí sus notas"></textarea>
    </section> -->


    <section id="card-receta" class="card mt-3">
      <h4 class="m-3">Receta</h4>
      <hr class="dropdown-divider m-2">
      <p class="none-p m-3">Receta de médicamento(s)</p>
      <div id="recetas-medicamentos"> </div>
      <div class="d-flex justify-content-start" style = "margin-left: 20px; margin-top:20px; margin-bottom:20px">
        <button type="button" class="btn btn-confirmar" style="margin-bottom:4px" id="btn-agregar-medicamento-receta">
          <i class="bi bi-clipboard-plus"></i> Agregar
        </button>
      </div>

    </section>


    <!-- <section id="card-solicitud-estudios" class="card mt-3">
      <h4 class="m-3">Solicitud de estudios y valoraciones complementarios</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" id="solicitud-estudios-valoraciones" placeholder="Escriba aquí sus notas"></textarea>
    </section> -->
  </div>
</div>

<style>
  #menu-consultorio {
    background-color: rgb(246, 253, 255);
    z-index: 5
  }
</style>