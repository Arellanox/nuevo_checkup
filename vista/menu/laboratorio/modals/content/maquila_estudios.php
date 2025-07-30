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
                    <select id="select-laboratorios-maquila" class="input-form"></select>
                </div>

                <div class="modal-body-maquila-aliases">
                    <label class="form-label">Alias del estudio</label>
                    <br/>
                    <span>Verifique que los alias sean correctos en caso de que no, elimine el alias y agregue uno nuevo</span>
                    <select class="form-control input-form" id="select-aliases-estudio" multiple="multiple"></select>
                </div>

                <div id="modal-body-maquila-estudios-grupos">
                    <label class="form-label">Desmarque los estudios que no desea maquilar</label>
                    <br/>
                    <span>Los estudios seleccionados seran maquilados</span>
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
    .form-check-lista-estudios{
        background: #3bc3c0 ! important;
        border-radius: 10px ! important;
        cursor: pointer ! important;
    }
    .form-check-lista-estudios:hover{
        transform: translateY(-1px) !important;
    }

    .form-check-lista-estudios label {
        cursor: pointer;
        color: white !important;
        background: transparent !important;
        padding: 5px 8px 5px 8px ! important;
        width: 100% !important;
    }
</style>