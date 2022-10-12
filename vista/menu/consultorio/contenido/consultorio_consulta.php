<div class="container-fluid" style="z-index:5">
  <div class="row" id="menu-consultorio">
    <div class="col-8 row">
      <div class="col-auto">
        <h3 class="m-3">Nombre del paciente</h3>
      </div>
      <div class="col-auto row d-flex align-items-center justify-content-start" style="zoom:150%">
        <div class="col-auto">
          <span class="badge rounded-pill bg-primary">MOTIVO CONSULTA</span>
        </div>
        <div class="col-auto">
          <span class="badge rounded-pill bg-danger">FECHA CONSULTA</span>
        </div>
      </div>
      <div class="col-12 row" style="margin-left:10px">
        <div class="col-auto">
          <p class="info-detalle-p">fecha nacimiento</p>
        </div>
        <div class="col-auto">
          <p class="info-detalle-p">años</p>
        </div>
        <div class="col-auto">
          <p class="info-detalle-p">sexo</p>
        </div>
        <div class="col-auto">
          <p class="info-detalle-p">correo</p>
        </div>
        <div class="col-auto">
          <p class="info-detalle-p">numero CURP</p>
        </div>
      </div>
    </div>
    <div class="col-4 d-flex justify-content-end">
      <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" data-bs-toggle="modal" data-bs-target="#modalMotivoConsulta">
        <i class="bi bi-clipboard2-check"></i> Terminar consulta
      </button>
    </div>
    <div class="col-12 d-flex justify-content-center">
      <nav id="navbar-menu-consultorio" class="navbar navbar-light bg-light px-3">
        <ul class="nav nav-tabs nav-pills">
          <li class="nav-item">
            <a class="nav-link" href="#notas-padecimiento">Notas de padecimiento</a> <!-- active -->
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-nutricion">Nutrición</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-exploracion-clinica">EXPLORACIÓN CLINICA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-motivo-consulta">MOTIVO DE CONSULTA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-diagnostico">DIAGNÓSTICO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-terapeutico">MANEJO TERAPEUTICO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-receta">RECETA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#card-solicitud-estudios">SOLICITUD DE ESTUDIOS</a>
          </li>
        </ul>
      </nav>

    </div>
  </div>
</div>

<div class="overflow-auto" style="max-height:70vh;">
  <div class="container">
    <section id="notas-padecimiento" class="card mt-3">
      <h4 class="m-3">Notas de padecimiento</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name-notas-padecimiento" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas" id="nota-notas-padecimiento"></textarea>
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
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
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
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
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
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
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
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row d-flex align-items-center">
                <div class="col-6 col-lg-8">
                  <p>
                    <i class="bi bi-heart-half"></i>
                    Musculo
                  </p>
                </div>
                <div class="col-6 col-lg-4">
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
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
                  <input type="number" class="form-control input-form" name="" placeholder="" required >
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
            <option value="1">Habito Constitucionales</option>
            <option value="2">Cabeza</option>
            <option value="3">Cavidad Bucal</option>
            <option value="4">Cuello</option>
            <option value="5">Tórax</option>
            <option value="6">Aparato Respiratorio</option>
            <option value="7">Cardiovascular</option>
            <option value="8">Abdomen y pélvis</option>
            <option value="9">Ingles</option>
            <option value="10">Aparato Genito-urinario</option>
            <option value="11">Gineco-obstetrico</option>
            <option value="12">Piel y faneras</option>
            <option value="13">Sistema Hemolinfopoyético</option>
            <option value="14">Aparato Osteomuscular</option>
            <option value="15">Sistema Nervioso Central</option>
          </select>
          <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas" style="width:95%" id="text-exploracion-clinica"></textarea>
          <div class=" d-flex justify-content-end">
            <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-agregar-exploracion-clinina">
              <i class="bi bi-clipboard-plus"></i> Agregar
            </button>
          </div>
        </div>
        <div class="col-6 card m-3">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </div>
      </div>
      <div class="row" style="margin:0">
        <div id="notas-historial" class="mt-3">
          <h4 class="m-3">INGLES: </h4>
          <div style="margin: -1px 30px 20px 30px;">
            <p class="none-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
          </div>
        </div>
      </div>
    </section>
    <section id="card-motivo-consulta" class="card mt-3">
      <h4 class="m-3">Motivo de consulta</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </section>
    <section id="card-diagnostico" class="card mt-3">
      <h4 class="m-3">Diagnóstico</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </section>
    <section id="card-terapeutico" class="card mt-3">
      <h4 class="m-3">Manejo terapeutico</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </section>
    <section id="card-receta" class="card mt-3">
      <h4 class="m-3">Receta</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </section>
    <section id="card-solicitud-estudios" class="card mt-3">
      <h4 class="m-3">Solicitud de estudios y valoraciones complementarios</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </section>
  </div>
</div>

<style>


#menu-consultorio {
  background-color: rgb(246, 253, 255);
  z-index: 5
}
</style>

<script type="text/javascript">
$("#nota-notas-padecimiento").on("change", function(e) {
  alert("khjabsdkbhj")
})
</script>
