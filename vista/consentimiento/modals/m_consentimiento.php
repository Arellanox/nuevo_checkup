<div class="modal fade" id="consentimiento_paciente_modal" tabindex="-1" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Vista previa de los reportes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- <h5 class="modal-title fw-bold text-center" id="temperaturaPdfTitle">Vista previa</h5>
                <hr> -->
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner"></div>
                    <!-- <button>
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class ="visually-hidden">Previous</span>
                    </button>
                    <button>
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button> -->
                </div>
            </div>
            <div class="modal-footer">
                <!-- Paginacion del formulario -->
                <div>
                    <button class="btn btn-confirmar btn-modal-paginacion" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <i class="bi bi-arrow-left"></i>
                        Regresar</button>
                    <button class="btn btn-confirmar btn-modal-paginacion" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <i class="bi bi-arrow-right"></i>
                        Siguiente</button>
                </div>
                <!-- /////// -->
                <div>
                    <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <!--  <button type="submit" class="btn btn-confirmar" data-bs-toggle='tooltip' data-bs-placement='top' title="Se enviara mi reporte y doy mi consentimiento" id="btn-enviar-consentimiento">
                        <i class="bi bi-box-arrow-down"></i> Guardar
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>