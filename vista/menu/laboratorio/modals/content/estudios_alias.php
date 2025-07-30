<div class="modal fade" id="modalAsociarEstudio" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Registro de Alias de Estudio
                </h5>
            </div>
            <div class="modal-body">
                <div>
                    <label class="form-label">Estudio</label>
                    <select id="servicio_estudio_id" class="input-form">
                        <option value="" hidden>-- Seleccionar estudio --</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <div style="margin-right: 5px">
                        <label class="form-label">Clave del Estudio</label>
                        <input id="asociar_clave_estudio" type="text" class="form-control input-form" placeholder="Ingresa la clave del estudio">
                    </div>
                    <div style="margin-left: 5px">
                        <label class="form-label">Precio (No obligatorio)</label>
                        <div class="input-group">
                            <span class="input-span">$</span>
                            <input id="asociar_precio_estudio" type="number" class="form-control input-form total" placeholder="" value="0.00">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btn_cancel_alias" type="button" class="btn btn-cancelar">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button id="btn_confirm_alias" type="button" class="btn btn-confirmar">
                    <i class="bi bi-pencil"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>
