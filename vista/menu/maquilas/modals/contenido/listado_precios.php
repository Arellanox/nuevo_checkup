
<div class="modal fade" id="modalListaPreciosEstLab" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Lista de Precios de Estudios por Laboratorios
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-body-maquila-estudios">
                    <label class="form-label">Laboratorios</label>
                    <p style="margin-top: -10px; margin-bottom: 10px">Seleccióne el laboratorio para ver/actualizar sus precios.</p>
                    <div class="d-flex items-content-center gap-2">
                        <select id="select-laboratorios-maquila-by-list" class="input-form" ></select>
                        <button type="button" id="btn-confirm-laboratorio" class="btn-confirmar-laboratorios">Confirmar</button>
                    </div>
                </div>

                <div id="modal-body-maquila-estudios-table">
                    <!--- ---->
                    <table class="table table-hover display responsive w-full bg-white" id="TablaListadoPreciosEstudiosLab">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Servicio</th>
                                <th>Estudio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="background: white">
                                <td colspan="3">
                                    <div id="empty_message">
                                        <p style="margin-top: -10px; margin-bottom: 10px; max-width: 300px; text-align: center; color: gray">
                                            Seleccióna el laboratorio deseado y haz clic en confirmar para actualizar la información de los servicos.
                                        </p>
                                        <i class="bi bi-clock-history" style="font-size: 45px; color: gray"></i>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--- ---->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-refresh btn-confirmar" data-bs-toggle="tooltip"
                        data-bs-title="Recarga la tabla para visualizar cambios realizados. (Usar cuando sea necesario)">
                    Actualizar Tabla
                    <i class="bi bi-update"></i>
                </button>
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    Salir
                    <i class="bi bi-arrow-right-short"></i>
                </button>
            </div>
        </div>
    </div>
</div>
