<!-- <div class="row">
    <div class="col-4 p-2 shadow-sm my-2">
        <p>Agregue un medico tratante si lo necesita</p>
        <form id="form-medicoTratante">
            <div class="row p-2">
                <div class="col-6">
                    <label>Nombre del Médico tratante</label>
                    <input type="text" class="form-control input-form" id="nombre-medicoTrarante">

                    <label>Nombre de Usuario</label>
                    <select id="select-usuarios-medicos-tratantes" class="form-control input-form">
                    </select>
                </div>

                <div class="col-6 d-flex flex-column">
                    <label>Correo del Médico tratante</label>
                    <input type="email" class="form-control input-form" id="email-medicoTratante">

                    <div class="mt-auto d-flex justify-content-end">
                        <button type="button" class="btn btn-confirmar" id="btn-subir-medico-tratante" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los Médicos tratantes">
                            <i class="bi bi-person-plus"></i> Guardar
                        </button>
                    </div>
                </div>


            </div>
        </form>
    </div>

    <div class="col-8 p-2 shadow-sm my-2">
        <table class="table table-hover display responsive tableContenido" id="TablaVistaMedicosTratantes" style="width: 100%">
        </table>
    </div>
</div> -->


<div class="row">
    <div class="col-12 col-xl-12 col-xxl-12">
        <div class="card shadow-sm p-3 m-2">
            <h5>Agregar medico tratante</h5>
            <form id="form-medicoTratante">
                <div class="row">
                    <div class="col-12 col-xxl col-xl mb-3">
                        <label>Nombre:</label>
                        <input type="text" class="form-control input-form" id="nombre-medicoTrarante">
                    </div>
                    <div class="col-12 col-xxl col-xl mb-3">
                        <label>Usuario:</label>
                        <select id="select-usuarios-medicos-tratantes" class="form-control input-form">
                        </select>
                    </div>

                    <div class="col-12 col-xxl col-xl mb-3">
                        <label>Correo:</label>
                        <input type="email" class="form-control input-form" id="email-medicoTratante">
                    </div>
                    <div class="col-12 col-xxl col-xl border">
                        <button type="button" class="btn btn-sm btn-confirmar" id="btn-subir-medico-tratante" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los Médicos tratantes">
                            <i class="bi bi-person-plus"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-12 col-xl-12 col-xxl-12">
        <div class="card shadow-sm m-2 p-3">
            <h5>Lista de Médico tratantes</h5>
            <table class="table table-hover display responsive tableContenido" id="TablaVistaMedicosTratantes" style="width: 100%">
            </table>
        </div>
    </div>
</div>