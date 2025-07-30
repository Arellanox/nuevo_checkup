<div class="modal fade" id="modalMaquilaEstudios" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filtrador">
                    <i class="bi bi-file-earmark-break-fill"></i>
                    Seleccionar Laboratorios para Maquilación
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modal-body-maquila-estudios">
                    <label class="form-label">Laboratorios</label>
                    <p style="margin-top: -10px; margin-bottom: 10px">Seleccióne el laboratorio para la maquilación con la que quiere trabajar</p>
                    <select id="select-laboratorios-maquila" class="input-form"></select>
                </div>

                <div id="modal-body-maquila-estudios-grupos">
                    <label class="form-label mt-2">Estudios del Servicio</label>
                    <p style="margin-top: -10px; margin-bottom: 10px; font-weight: normal">Los estudios que esten seleccionados seran enviados para su aprovación</p>

                    <div class="pt-1 pb-3 d-flex justify-content-between align-items-center" >
                        <div style="flex: 1; margin-right: 20px;">
                            <label for="inputBuscarEstudio" class="form-label">Buscar estudio:</label>
                            <input type="text" class="input-form" id="inputBuscarEstudio" placeholder="Buscar estudios" autocomplete="off">
                        </div>
                        <div>
                            <label class="form-check-label" for="checkFullEstudios" data-bs-toggle="tooltip" data-bs-placement="top" title="Haz click para seleccionar todos los estudios" style="user-select: none; cursor: pointer; display: flex; flex-direction: column; align-items: center;">
                                <input class="form-check-input" type="checkbox" checked id="checkFullEstudios" style="margin-bottom: 4px;">Todos los estudios
                            </label>
                        </div>
                    </div>

                    <div id="body-maquila-estudios-grupos-container" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i>
                    Cancelar
                </button>
                <button type="submit" form="btn btn-confirm" class="btn btn-confirmar btn-modal-maquila-confirm">
                  <i class="bi bi-file-earmark-break"></i> Confirmar
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .form-check-lista {
        cursor: pointer ! important;
    }
    .form-check-lista:hover{
        transform: translateY(-1px) !important;
    }

    .form-check-lista-estudios{
        background: #3bc3c0 ! important;
        border-radius: 10px 10px 0 0 ! important;
    }

    .form-check-lista-estudios-details {
        background: white;
        padding: 8px 13px;
        border-radius: 0 0 10px 10px;
        box-shadow: rgba(149, 157, 165, 0.2) 0 8px 24px;
    }

    .form-check-lista-estudios label {
        cursor: pointer;
        color: white !important;
        background: transparent !important;
        padding: 5px 8px 5px 8px ! important;
        width: 100% !important;
    }
</style>