<div class="row m-3">
  <div class="col-3">
    <div class="info-detalle card" id="panel-informacion">

    </div>
    <div class="card mt-2" id="signos-vitales">

    </div>
  </div>
  <div class="col-6" >
    <div id="antecedentes-paciente">

    </div>
    <div id="crear-notas" class="card mt-3">
      <h4 class="m-3">Notas de historial clinica</h4>
      <hr class="dropdown-divider m-2">
      <textarea name="name" rows="10" cols="90" class="form-textarea-content" placeholder="Escriba aqui sus notas"></textarea>
    </div>
    <div id="notas-historial" class="card mt-3">
      <h4 class="m-3">@Usuario actual <p style="font-size: 14px;margin-left: 5px;">xx:xx Septiembre dia, año</p></h4>
      <div style="margin: -1px 30px 20px 30px;">
        <p class="none-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
  </div>
  <div class="col-3">
    <div class="card">
      <button type="button" class="btn btn-hover me-2" style="margin: 15px 60px 10px 60px !important;font-size: 21px;" data-bs-toggle="modal" data-bs-target="#ModalRegistrarUsuario">
        <i class="bi bi-person-plus-fill"></i> Iniciar Consulta
      </button>
      <div class="accordion-item bg-acordion" style="margin: 10px">
        <h2 class="accordion-header" id="collappAgendarConsulta">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAgendarConsultaTarget" aria-expanded="false" aria-controls="accordionEstudios">
            Agendar consulta
          </button>
        </h2>
        <div id="collapseAgendarConsultaTarget" class="accordion-collapse collapse" aria-labelledby="collappAgendarConsulta">
          <div class="accordion-body">
            <input type="date" name="date" value="" class="form-control input-form m-3" style="margin-left: 2px !important;">
            <input type="text" name="materno" value="" class="form-control input-form m-3" placeholder="Motivo de la consulta" style="margin-left: 2px !important;">
            <select name="metodo" id="citas-subsecuente" required class="m-3">
            </select>
          </div>
        </div>
      </div>
      <div class="card m-3">
        <h4 class="m-3">Historial de consultas</h4>
        <!-- <hr class="dropdown-divider"> -->
        <div class="row line-top" style="margin:0px">
          <div class="col-3 line-right">
            01 Sep 2022
          </div>
          <div class="col-9">
            <p>Nombre medico</p>
            <p>motivo consulta</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
