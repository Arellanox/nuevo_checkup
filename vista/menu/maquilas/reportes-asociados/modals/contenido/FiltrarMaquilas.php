<div class="modal fade" id="modalFiltrarReporte" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Filtrar Reporte
                </h5>
            </div>
            <div class="modal-body">
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <label class="form-label">Laboratorios</label>
                    <select class="form-control" name="laboratorios" id="select_laboratorios" required>
                        <option value="null" selected>Todos</option>
                    </select>

                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control input-form" name="fecha_inicio" required id="fecha_inicio">

                    <label class="form-label">Fecha de final</label>
                    <input type="date" class="form-control input-form" name="fecha_final" required id="fecha_inicio">
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_cancelar" type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button id="btn_filtrar" type="button" class="btn btn-confirmar">
                    <i class="bi bi-pencil"></i> Filtrar
                </button>
            </div>
        </div>
    </div>
</div>
