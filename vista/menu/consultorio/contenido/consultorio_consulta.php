<div class="container-fluid">
  <div class="row" id="menu-consultorio">
    <div class="col-8 row">
      <div class="col-6">
        <h3 class="m-3">Nombre del paciente</h3>
      </div>
      <div class="col-6 row d-flex align-items-center justify-content-center" style="zoom:150%">
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
            <a class="nav-link" href="#">DIAGNÓSTICO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">MANEJO TERAPEUTICO</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">RECETA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">SOLICITUD DE ESTUDIOS</a>
          </li>
        </ul>
      </nav>

    </div>
  </div>
</div>

<div class="container content scrollspy-example" id="container-consulta" data-bs-spy="scroll" data-bs-target="#navbar-menu-consultorio" data-bs-offset="0" tabindex="0">

  <div id="notas-padecimiento" class="card mt-3">
    <h4 class="m-3">Notas de padecimiento</h4>
    <hr class="dropdown-divider m-2">
    <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
  </div>
  <div id="card-nutricion" class="card mt-3">
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
  </div>
  <div id="card-exploracion-clinica" class="card mt-3">
    <h4 class="m-3">Exploración clinica</h4>
    <hr class="dropdown-divider m-2">
    <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
  </div>
  <div id="card-motivo-consulta" class="card mt-3">
    <h4 class="m-3">Motivo de consulta</h4>
    <hr class="dropdown-divider m-2">
    <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
  </div>

</div>

<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("menu-consultorio");
var content = document.getElementById("container-consulta");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
    // content.classList.add("content-top")
  } else {
    navbar.classList.remove("sticky");
    // content.classList.remove("content-top")
  }
}
</script>

<style>


#menu-consultorio {
  overflow: hidden;
  background-color: rgb(246, 253, 255);
}


.content {
  padding: 16px;
  z-index: 5
}

.sticky {
  position: absolute;
  top: 0;
  width: 100%;
  z-index: 5
}



.content-top{
  margin-top:180px
}
</style>
