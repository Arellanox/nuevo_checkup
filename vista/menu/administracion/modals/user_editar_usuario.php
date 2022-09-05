<div class="modal fade" id="ModalEditarRegistroUsuario" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title" id="filtrador">Editar información</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="" id="formEditarUsuario">
          <p class="text-center">Actualice la información del usuario</p>
          <div class="row">
            <?php include "../../../include/modal/formRegistroUsuario.php"; ?>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formEditarUsuario" class="btn btn-confirmar">
          <i class="bi bi-list-columns-reverse"></i> filtrar
        </button>
      </div>
    </div>
  </div>
</div>
