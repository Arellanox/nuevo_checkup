<div class="modal fade" id="ModalCuestionarioRiesgo" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body">
                <form id="formCuestionarioRiesgo">
                    <?php include "formCuestionarioRiesgo.php"; ?>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
                <button type="submit" form="formCuestionarioRiesgo" class="btn btn-confirmar btn-formregistrar-agenda">
                    <i class="bi bi-send-plus"></i> Registrar
                </button>
            </div>
        </div>
    </div>
</div>