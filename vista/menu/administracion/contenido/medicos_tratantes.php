<div class="row">
    <div class="col-12 col-xl-3 col-xxl-3">
        <div class="shadow p-3 my-3">
            <h5>Agregar médico tratante</h5>
            <form id=">">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label>Nombre:</label>
                        <input type="text" class="form-control input-form" name="nombre_medico" id="nombre-medicoTrarante">
                        <div id="suggestionsBox" class="d-none">
                            <span>Médicos Existentes:</span>
                            <div id="suggestionsList"></div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label>Correo:</label>
                        <input type="email" class="form-control input-form email-medicoTratante" data-collapse-name="collapseConfirmacion" data-pair-id="ingreso_medico" data-email-order="1" name="email" id="email-medicoTratante">
                    </div>

                    <div class="collapse email-collapse" id="collapseConfirmacion">
                        <div class="col-12 mb-3">
                            <label>Confirma el correo:</label>
                            <input type="email" class="form-control input-form email-medicoTratante" data-pair-id="ingreso_medico" data-email-order="2">
                            <small class="error-message" style="color: red; display: none;">Los correos no coinciden</small>
                        </div>
                    </div>



                    <div class="col-12 mb-3">
                        <label>Teléfono:</label>
                        <input type="number" class="form-control input-form" name="telefono" id="telefono-medicoTratante">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Especialidad:</label>
                        <input type="text" class="form-control input-form" name="especialidad" id="especialidad-medicoTratante">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Usuario:</label>
                        <select id="select-usuarios-medicos-tratantes" name="usuario_id" class="form-control input-form">
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="usuario_check_g">
                        <label class="form-check-label" for="usuario_check_g" data-bs-toggle="tooltip" data-bs-placement="top" title="Si esta activo el nombre sera remplazado por el nombre del usuario que seleccione">
                            Adjuntar con usuario
                        </label>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-pantone-3165 btn_confirmar_correo" data-pair-id="ingreso_medico" id="btn-subir-medico-tratante" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los Médicos tratantes">
                            <i class="bi bi-person-plus"></i> Agregar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-xl-9 col-xxl-9">
        <div class="shadow my-3 p-3">
            <h5>Lista de Médico tratantes</h5>
            <table class="table table-hover display responsive tableContenido" id="TablaVistaMedicosTratantes" style="width: 100%">
            </table>
        </div>
    </div>
</div>


<style>
    .chip {
        display: inline-block;
        padding: 4px 8px;
        border-radius: 16px;
        margin-right: 5px;
        margin-bottom: 5px;
        /* background-color: #f1f1f1; */
        font-size: 13px;
    }

    .chip:hover {
        /* background-color: #ddd; */
    }
</style>


<script>
    $('.email-medicoTratante').on('input', function(event) {
        event.preventDefault();
        // Obtiene el ID del collapse asociado desde el atributo data-collapse-name
        var collapseId = $(this).data('collapse-name');
        var collapseElement = $('#' + collapseId);
        var inputConfirmacion = collapseElement.find('input[type=email]');

        if ($(this).val() !== '') {
            collapseElement.collapse('show');
            inputConfirmacion.prop('required', true);
        } else {
            collapseElement.collapse('hide');
            inputConfirmacion.prop('required', false);
        }


        // Comparar los correos en tiempo real y mostrar mensaje de error si no coinciden
        var pairId = $(this).data('pair-id');
        var emailOrder = $(this).data('email-order');

        if (emailOrder === 1) {
            var collapseId = $(this).data('collapse-name');
            $('#' + collapseId).collapse('show');
        }

        var primaryEmail = $('[data-pair-id="' + pairId + '"][data-email-order="1"]').val();
        var confirmationEmail = $('[data-pair-id="' + pairId + '"][data-email-order="2"]').val();
        var errorMessage = $('[data-pair-id="' + pairId + '"][data-email-order="2"]').siblings('.error-message');
        var confirmButton = $('.btn_confirmar_correo[data-pair-id="' + pairId + '"]');


        if (primaryEmail !== '' && confirmationEmail !== '' && primaryEmail !== confirmationEmail) {
            errorMessage.hide();
            confirmButton.prop('disabled', false);
        } else {
            errorMessage.show();
            confirmButton.prop('disabled', true);
        }
    });
</script>