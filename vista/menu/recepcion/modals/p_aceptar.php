<div class="modal fade" id="modalPacienteAceptar" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="title-paciente_aceptar">Nombre paciente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-8">
            <p>Escanea la identificación del paciente y espere a que se guarde</p>
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-confirmar" id="btn-obtenerID">
              <i class="bi bi-person-badge"></i> Obtener ID
            </button>
          </div>
        </div>
        <p style="margin-top:20px"> <strong>Verifique los siguientes datos</strong> </p>
        <div class="row">
          <div class="col-12 col-lg-6">
            <p class="text-center" >Estudios del paciente</p>
            <div class="overflow-auto" style="max-width: 100%; max-height: 220px;margin-bottom:10px;">
              <ul class="list-group" id="list-estudiosPaciente">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
              </ul>
            </div>
          </div>
          <div class="col-12 col-lg-6">
            <p class="text-center" >Identificación</p>
            <div class="overflow-hidden" style="max-width: 100%; max-height: 235px;">
              <img src="https://mdbootstrap.com/img/Others/documentation/img%20(131)-mini.jpg" class="img-fluid" alt="Responsive image" id="image-perfil">
            </div>
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" class="btn btn-confirmar" id="btn-confirmar-paciente">
          <i class="bi bi-check2-square"></i> Aceptar paciente
        </button>
      </div>
    </div>
  </div>
</div>
