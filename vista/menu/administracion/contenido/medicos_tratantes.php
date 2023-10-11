<div class="row">
    <div class="col-12 col-xl-3 col-xxl-3">
        <div class="shadow p-3 my-3">
            <h5>Agregar médico tratante</h5>
            <form id="form-medicoTratante">
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
                        <input type="email" class="form-control input-form" name="email" id="email-medicoTratante">
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
                        <button type="button" class="btn btn-pantone-3165" id="btn-subir-medico-tratante" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los Médicos tratantes">
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