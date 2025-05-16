<div class="modal fade" id="ModalEditarPaquete" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title">Editar la información del paquete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="formEditarPaquete">
                    <p class="text-center">Estás editando este paquete.</p>
                    <br>
                    <div class="row">
                        <div class="col-12">
                            <label for="descripcion" class="form-label">Nombre</label>
                            <input type="text" name="descripcion" class="form-control input-form" id="nombrePaqEditar"
                                   required>
                        </div>
                        <div class="col-12">
                            <label for="tipo_paquete" class="form-label">Tipo de Paquete</label>
                            <input type="text" name="tipo_paquete" class="form-control input-form" id="tipoPaqEditar"
                                   required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i
                            class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="submit" form="formEditarPaquete" class="btn btn-confirmar">
                    <i class="bi bi-person-plus"></i>
                    Editar paquete
                </button>
                <button type="button" class="btn btn-danger" id="btnInhabilitarPaquete">
                    <i class="bi bi-exclamation-triangle-fill"></i> Inhabilitar
                </button>
            </div>
        </div>
    </div>
</div>