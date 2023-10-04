<div class="row">
    <div class="col-12 col-xl-3 col-xxl-3">
        <div class="rounded-1 shadow-sm p-3 my-3">
            <h5>Agregar medico tratante</h5>
            <form id="form-medicoTratante">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label>Nombre:</label>
                        <input type="text" class="form-control input-form" id="nombre-medicoTrarante">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Correo:</label>
                        <input type="email" class="form-control input-form" id="email-medicoTratante">
                    </div>
                    <div class="col-12 mb-3">
                        <label>Usuario:</label>
                        <select id="select-usuarios-medicos-tratantes" class="form-control input-form">
                        </select>
                    </div>
                    <div class="col-12 mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="usuario_check_g">
                        <label class="form-check-label" for="usuario_check_g">
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
        <div class="rounded-1 shadow-sm my-3 p-3">
            <h5>Lista de Médico tratantes</h5>
            <table class="table table-hover display responsive tableContenido" id="TablaVistaMedicosTratantes" style="width: 100%">
            </table>
        </div>
    </div>
</div>