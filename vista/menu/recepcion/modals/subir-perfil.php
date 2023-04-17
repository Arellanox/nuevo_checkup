<div class="modal fade" id="modalPacientePerfil" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="title-paciente_perfil_imagen">?????</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formPerfilPaciente">
          <div class="col-12 col-md-12 col-lg-12 col-xl-12">
            <label for="segmentosFiltro" class="form-label">Imagen de perfil para la identificación</label>
            <input type="file" name="img" value="" class="form-control input-form" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formPerfilPaciente" class="btn btn-confirmar" id="btn-subir-perfil-paciente">
          <i class="bi bi-person-x"></i> Subir foto
        </button>
      </div>
    </div>
  </div>
</div>