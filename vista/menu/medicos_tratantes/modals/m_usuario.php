<div class="modal fade" id="UsuarioMedicoTratante" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usuarioMedicoTitle">Agregar o actualizar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row p-2">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label>Nombre:</label>
                                <input type="text" class="form-control input-form" id="nombre-medicoTrarante-a">
                            </div>
                            <div class="col-12 mb-3">
                                <label>Correo:</label>
                                <input type="email" class="form-control input-form" id="email-medicoTratante-a">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label>Usuario:</label>
                                <select id="usuarios_medicos" class="form-control input-form">
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="usuario_medico_check">
                                <label class="form-check-label" for="usuario_medico_check">
                                    Adjuntar con usuario
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar</button>
                <button type="submit" class="btn btn-confirmar" form="" id="">
                    <i class="bi bi-arrow-up-square"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>