
<div class="modal fade" id="modalMaquilasPendientes" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Maquilas pendientes de aprobación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <table class="table table-hover display" id="TablaMaquilasPendientesAprovacion">
                        <thead>
                            <tr>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Servicio</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Laboratorio</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Abrevitatura</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Paciente</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Solicitado Por</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Estatus</th>
                                <th scope="col d-flex justify-content-center min-w-full" class="all">Fecha de Registro</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i>
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>