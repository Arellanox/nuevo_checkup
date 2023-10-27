<div class="modal fade" id="modalInformacionClinica" tabindex="-1" aria-labelledby="resultados" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <!-- <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_aceptar">Información Clinica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="modal-body">

                <?php
                echo '<form id="formSubirInterpretacionCitologia">';
                include "../contenido/forms/form_citologia.html";
                echo '</form>';
                ?>

                <!-- <img id="full" class="hideimg" src="http://localhost/nuevo_checkup/archivos/sistema/temp/transparent.png" border="0" onclick="this.className='hideimg'"> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cerrar</button>

                <!-- Paginacion del formulario -->
                <!-- /////// -->

                <!-- <button type="button" class="btn btn-cancelar" id="siguienteForm"><i class="bi bi-arrow-right-circle"></i> Siguiente</button> -->

                <div class="">

                </div>

            </div>
        </div>
    </div>
</div>