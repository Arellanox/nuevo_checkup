<div class="modal fade" id="UsuarioMedicoTratante" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usuarioMedicoTitle">Agregar o actualizar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form_medicos_tratantes_a">
                    <div class="row p-2">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Nombre:</label>
                                    <input type="text" name="nombre_medico" class="form-control input-form" id="nombre-medicoTrarante-a">
                                </div>


                                <div class="col-12 mb-3">
                                    <label>Correo:</label>
                                    <input type="email" class="form-control input-form email-medicoTratante" data-collapse-name="collapseConfirmacion_edit" data-pair-id="input_actualizar_edit" data-email-order="1" name="email" id="email-medicoTratante-a">
                                </div>

                                <div class="collapse email-collapse" id="collapseConfirmacion_edit">
                                    <div class="col-12 mb-3">
                                        <label>Confirma el correo:</label>
                                        <input type="email" class="form-control input-form email-medicoTratante" data-pair-id="input_actualizar_edit" data-email-order="2">
                                        <small class="error-message" style="color: red; display: none;">Los correos no coinciden</small>
                                    </div>
                                </div>


                                <div class="col-12 mb-3">
                                    <label>Teléfono:</label>
                                    <input type="text" name="telefono" class="form-control input-form" id="telefono-medicoTratante-a">
                                </div>
                                <div class="col-12 mb-3">
                                    <label>Especialidad:</label>
                                    <input type="text" name="especialidad" class="form-control input-form" id="especialidad-medicoTratante-a">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label>Usuario:</label>
                                    <select id="usuarios_medicos" name="usuario_id" class="form-control input-form">
                                    </select>
                                </div>
                                <div class="col-12 mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="usuario_medico_check">
                                    <label class="form-check-label" for="usuario_medico_check" data-bs-toggle="tooltip" data-bs-placement="top" title="Si esta activo el nombre sera remplazado por el nombre del usuario que seleccione">
                                        Adjuntar con usuario
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>
                    Cancelar</button>
                <button type="submit" form="form_medicos_tratantes_a" class="btn btn-confirmar btn_confirmar_correo" data-pair-id="input_actualizar_edit" id="btn--medicoTratante--a">
                    <i class="bi bi-arrow-up-square"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>