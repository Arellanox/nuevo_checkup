<div class="modal fade" id="modal-select-fechas" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Seleccionar rango de fechas de requisición de maquilación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="display: flex; flex-direction: column; gap: 10px">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" class="form-control input-form" name="fecha_inicio" required id="fecha_inicio">
                    <label class="form-label">Fecha de final</label>
                    <input type="date" class="form-control input-form" name="fecha_final" required id="fecha_inicio">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    Cancelar
                    <i class="bi bi-arrow-left-short"></i>
                </button>
                <button id="btn-confirmar-seleccion-fechas" type="submit" form="btn btn-confirm" class="btn btn-confirmar">
                    Seleccionar
                    <i class="bi bi-file-earmark-break"></i>
                </button>
            </div>
        </div>
    </div>
</div>