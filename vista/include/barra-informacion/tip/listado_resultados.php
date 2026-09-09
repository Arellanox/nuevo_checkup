<!--<div class="row">
    <h5>Estudios realizados</h5>
    <div class="col-12">
        <p data-bs-toggle="collapse" aria-expanded="false" aria-controls="collapseLabEstudios">Laboratorio</p> 
        <a class="" data-bs-toggle="collapse" href="#collapseLabEstudios" role="button" aria-expanded="false"
            aria-controls="collapseLabEstudios">
            Laboratorio
        </a>
        <div class="collapse" id="collapseLabEstudios">

        </div>

    </div>

</div> -->

<div class="d-grid gap-2 mt-2">
    <button type="button"
        class="btn btn-primary btn-sm rounded-pill shadow-sm border-0 px-3 py-2 fw-semibold"
        style="background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);"
        data-bs-toggle="modal"
        data-bs-target="#modalHistorialResultados">
        <i class="bi bi-clock-history me-2"></i>
        Historial de resultados
    </button>
</div>

<div class="modal fade" id="modalHistorialResultados" tabindex="-1" aria-labelledby="modalHistorialResultadosLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header text-white border-0" style="background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle bg-white bg-opacity-10" style="width: 42px; height: 42px;">
                        <i class="bi bi-file-earmark-medical fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title mb-1" id="modalHistorialResultadosLabel">Historial de resultados</h5>
                        <small class="text-white-50">Consulta rápida por área y abre el reporte directo.</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-3 bg-light-subtle">
                <div class="row g-3 mb-3">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body py-2">
                                <div class="d-flex justify-content-between align-items-center gap-2 flex-wrap">
                                    <div class="input-group input-group-sm w-auto flex-grow-1">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-search text-primary"></i>
                                        </span>
                                        <input id="buscar-resultados-historial" type="text" class="form-control border-start-0" placeholder="Filtrar por área o fecha">
                                    </div>
                                    <span class="badge rounded-pill bg-primary-subtle text-primary-emphasis px-3 py-2">
                                        <span id="contador-historial-resultados">0</span> áreas
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100 bg-primary bg-gradient text-white">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="small text-white-50">Resumen</div>
                                    <div class="fs-5 fw-bold">Resultados</div>
                                </div>
                                <div class="rounded-circle bg-white bg-opacity-10 d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                                    <i class="bi bi-clipboard-check fs-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion" id="accordinSignosSomatometria">
                    <ol class="list-group list-group-numbered" id="append-html-historial-estudios"></ol>
                </div>

                <div id="empty-historial-resultados" class="d-none">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body text-center py-5">
                            <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle" style="width: 72px; height: 72px;">
                                <i class="bi bi-clipboard2-x text-primary fs-3"></i>
                            </div>
                            <h6 class="mt-3 mb-1">No hay resultados disponibles</h6>
                            <p class="text-muted mb-0">Este paciente aún no cuenta con reportes para mostrar en esta sección.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .result-card {
        border: 2px solid rgba(13, 110, 253, 0.18);
        background: linear-gradient(180deg, #ffffff 0%, #f8f9ff 100%);
        box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.4);
    }

    .result-card.recent {
        border-color: rgba(25, 135, 84, 0.55);
        background: linear-gradient(180deg, #ffffff 0%, #f3fff7 100%);
    }

    .result-card.older {
        border-color: rgba(108, 117, 125, 0.22);
    }

    .result-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.75rem 1.5rem rgba(13, 110, 253, 0.12), inset 0 0 0 1px rgba(13, 110, 253, 0.12) !important;
        border-color: rgba(13, 110, 253, 0.3);
    }
</style>
