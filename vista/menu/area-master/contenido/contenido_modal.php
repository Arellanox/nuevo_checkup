<?php
$form = $_POST['form'];
$tipovista = $_POST['tipovista'];
$control_turnos = $_POST['control_turnos'];
session_start();

?>
<!-- <div class="col-12 loader" id="loader" style="">
  <div class="preloader" id="preloader"> </div>
</div> -->
<!-- <div class="row">
  <div class="card col-12 col-lg-3 pt-4">
    <div class="" id="panel-informacion">

    </div>
    <div class="" id="panel-resultadosMaster">

    </div>
  </div>
  <div class="card col-12 col-lg-9" style="margin-bottom:5px">
    <div class="text-center" style="margin-top:4px;zoom:95%;margin-bottom:5px;">
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-analisis-pdf">
        <i class="bi bi-clipboard2-plus"></i> Subir interpretación
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-capturas-pdf">
        <i class="bi bi-clipboard2-plus"></i> Guardar capturas
      </button>
      <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-analisis-oftalmo">
        <i class="bi bi-clipboard2-plus"></i> Subir resultados 2
      </button>
    </div>
    <table class="table table-hover display responsive tableContenido" id="TablaContenidoResultados" style="width: 100%">
      <thead class="" style="width: 100%">
        <tr>
          <th scope="col d-flex justify-content-center" class="all">#</th>
          <th scope="col d-flex justify-content-center" class="all">Nombre</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Procedencia</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Edad</th>
          <th scope="col d-flex justify-content-center" class="min-tablet">Sexo</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div> -->

<!-- Precarga -->
<div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"> </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="lightbox">
    <img id="lightbox-img" class="lightbox-img" src="" alt="">
</div>


<!-- Navegacion movil -->
<div id="tab-button">
</div>

<div class="row">
    <div class="col-12 col-xl-4 tab-first" id="tab-paciente" style="margin-right: -5px !important;">
        <div class="rounded p-3 shadow my-2" id="lista-pacientes">
            <h4>Lista de pacientes</h4>

            <?php if ($control_turnos) : ?>
                <!-- Control de turnos -->
                <div id="turnos_panel"></div>
            <?php endif; ?>


            <!-- <div class="text-center">

                <label for="inputBuscarTableListaNuevos">Buscar:</label>
                <input type="text" class="form-control input-color" style="display: unset !important;width:auto !important" name="inputBuscarTableListaPacientes" value="" style="width:80%" autocomplete="off" id="inputBuscarTableListaPacientes">
            </div> -->
            <table class="table display responsive" id="TablaContenidoResultados" style="width: 100%">
                <thead class="" style="width: 100%">
                    <tr>
                        <th scope="col d-flex justify-content-center" class="all">#</th>
                        <th scope="col d-flex justify-content-center" class="all">Nombre</th>
                        <th scope="col d-flex justify-content-center" class="min-tablet">Prefolio</th>
                        <th scope="col d-flex justify-content-center" class="tablet">Cliente</th>
                        <th scope="col d-flex justify-content-center" class="none">Segmento</th>
                        <th scope="col d-flex justify-content-center" class="tablet">Turno</th>
                        <th scope="col d-flex justify-content-center" class="none">Sexo</th>
                        <th scope="col d-flex justify-content-center" class="none">Expendiente</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col-12 col-xl-4 tab-second" id="tab-informacion" style="margin-right: -5px !important;display:none">
        <div class="rounded p-3 shadow my-2" id="panel-informacion"> </div>

        <div class="rounded p-3 shadow my-2" id="signos-vitales">
            <!-- Signos vitales -->
        </div>
        <!-- <div class="card m-3 p-4">
      <h4>Estudios anteriores</h4>
      <div class="accordion" id="accordionResultadosAnteriores">
      </div>
    </div> -->
    </div>


    <div class="col-12 col-xl-4 tab-second" id="tab-reporte" style="margin-right: -5px !important;display:none">
        <div class="rounded p-3 shadow my-2" id="panel">
            <div class="" id="
            ">
                <div class="row">
                    <div class="col-12">
                        <h4>Resultados</h4>
                        <?php
                        if ($tipovista == 'tomaCapturas') {
                            echo '<p class="none-p">Capture las imagenes del paciente</p>';
                        } else {
                            echo '<p class="none-p">Interprete o visualice el reporte del paciente</p>';
                        } ?>
                    </div>
                    <div class="row">
                        <?php if ($tipovista != 'tomaCapturas') : ?>
                            <div class="col-12 mb-2 d-flex row justify-content-between" style="margin-top:4px; margin-bottom:5px;">

                                <div class="col-auto btn-capturas-pdf" style="display:none">
                                    <button type="button" class="btn btn-primary me-2 btnResultados btn-capturas-pdf" style="margin-bottom:4px" id="btn-capturas-pdf">
                                        <i class="bi bi-plus-lg"></i> Imágenes
                                    </button>
                                </div>

                                <!-- Espirometria -->
                                <div class="col-auto btn-resultados-espiro-pdf" style="display:none">
                                    <button type="button" class="btn btn-primary me-2" style="margin-bottom:4px; display:none" id="btn-resultados-espiro-pdf">
                                        <i class="bi bi-plus-lg"></i> EASYONE
                                    </button>
                                </div>


                                <!-- Captura de audio -->
                                <div class="col-auto btn_reporte_audiometria" style="display:none">
                                    <button type="button" class="btn btn-primary me-2 btn_reporte_audiometria" style="margin-bottom:4px; display:none" id="btn-resultados-audi-pdf">
                                        <i class="bi bi-plus-lg"></i> Subir reporte
                                    </button>
                                </div>
                                <!-- <div class="col-auto btn_reporte_audiometria" style="display:none">
                                    <button type="button" class="btn btn-primary me-2 btn_reporte_audiometria" style="margin-bottom:4px; display:none" data-bs-toggle="modal" data-bs-target="#modalCapturaOidos">
                                        <i class="bi bi-ear"></i> Captura de Oidos
                                    </button>
                                </div> -->

                                <!-- <div class="col-auto btn_reporte_audiometria" style="display:none">
                                    <button type="button" class="btn btn-primary me-2 btn_reporte_audiometria" style="margin-bottom:4px; display:none" data-bs-toggle="modal" data-bs-target="#modalCapturaTablas">
                                        <i class="bi bi-table"></i> Captura de Tabla
                                    </button>
                                </div> -->

                                <!-- Button para interpretaciones de las areas -->
                                <div class="col-auto">
                                    <button type="button" id="abrirModalResultados" class="btn btn-confirmar me-2" style="margin-bottom:4px">
                                        <i class="bi bi-clipboard2-plus"></i> Interpretación
                                    </button>
                                </div>
                            </div>

                            <!-- <div class="col text-end" style="margin-top:4px;margin-bottom:5px;">

                            </div> -->
                        <?php endif; ?>
                    </div>
                </div>
                <?php if ($tipovista == 'tomaCapturas') { ?>
                    <!-- Visualizar imagenes por vista -->
                    <div class="vistaImagenesCargo5 mt-4 m-3" id="vistaCapturasAreas">
                        <ol class="list-group list-group-numbered" id="vistaEstudiosImagenes">
                            <!-- Lista de estudios a subir -->

                        </ol>
                    </div>
                <?php } else { ?>
                    <div id="spamResultado">

                    </div>
                    <div id="mostrarResultado" style="display: none;">

                        <h5>Resultados del paciente:</h5>
                        <div class="accordion" id="resultadosServicios-areas">

                        </div>
                    </div>


                    <div class="mt-4" id="sintomasPaciente">

                    </div>
                <?php } ?>


            </div>
        </div>
    </div>

    <!-- Tercera Columna visual -->
    <div id="reload-selectable"> </div>

</div>


<div class="modal fade" id="modalSubirInterpretacion" data-bs-keyboard="false" tabindex="-1" aria-labelledby="resultados" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_aceptar">Reporte de interpretación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="row">
                    <div class="col-12">
                        <?php
                        switch ($form) {
                                //<!-- Resultados de oftalmologia -->
                            case 'formSubirInterpretacionOftalmo':
                                echo '<form id="formSubirInterpretacionOftalmo">';
                                include 'forms/oftalmo.html';
                                echo '</form>';
                                break;

                                //<!-- Resultados de oftalmologia -->
                            case 'formSubirInterpretacionElectro':
                                echo '<form id="formSubirInterpretacionElectro">';
                                include 'forms/electro.html';
                                echo '</form>';
                                break;

                                //<!-- Formulario general -->
                            case 'formSubirInterpretacion':
                                echo '<form id="formSubirInterpretacion">';
                                include 'forms/form_general.html';
                                echo '</form>';
                                break;
                            case 'formSubirInterpretacionCitologia':
                                echo '<form id="formSubirInterpretacionCitologia">';
                                include 'forms/form_citologia.html';
                                echo '</form>';
                                break;
                                //<!--Formulario de Espirometria -->
                            case 'formAreadeEspirometria':
                                // echo '<form id="formAreadeEspirometria">';
                                include 'forms/form_espiro.html';
                                // echo '</form>';
                                break;
                                //<!--Formulario de Audiometria -->
                            case 'formSubirInterpretacionPRUEBA':
                                // echo '<form id="formSubirInterpretacionPRUEBA">';
                                include 'forms/audiome.html';
                                // echo '</form>';
                                break;
                        }

                        ?>
                    </div>
                </div>
                <!-- <img id="full" class="hideimg" src="http://localhost/nuevo_checkup/archivos/sistema/temp/transparent.png" border="0" onclick="this.className='hideimg'"> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cerrar</button>

                <!-- Paginacion del formulario -->
                <div id="panel-paginacion" style="display: none;">
                    <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="back">
                        <i class="bi bi-arrow-left"></i>
                        Regresar</button>
                    <button type="button" class="btn control-pagina-interpretacion btn-cancelar" target="next">
                        <i class="bi bi-arrow-right"></i>
                        Siguiente</button>
                </div>
                <!-- /////// -->

                <!-- <button type="button" class="btn btn-cancelar" id="siguienteForm"><i class="bi bi-arrow-right-circle"></i> Siguiente</button> -->

                <div class="">
                    <button type="button" class="btn btn-borrar btnResultados" id="btn-ver-reporte" data-bs-toggle="tooltip" data-bs-placement="top" title="La vista previa del reporte una vez guardado los cambios">
                        <i class="bi bi-file-earmark-pdf"></i> Vista previa
                    </button>
                    <!-- BTN oftalmo -->
                    <button type="submit" form="formSubirInterpretacionOftalmo" class="btn btn-confirmar btnResultados" id="btn-inter-oftal" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los cambios del reporte si desea ver la vista previa">
                        <i class="bi bi-clipboard2-plus"></i> Guardar Interpretación
                    </button>
                    <!-- BTN GLOBAL -->
                    <button type="submit" form="<?php echo $form; ?>" class="btn btn-confirmar btnResultados" id="btn-inter-areas" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los cambios del reporte si desea ver la vista previa">
                        <i class="bi bi-clipboard2-plus"></i> Guardar Interpretación
                    </button>

                    <button type="button" class="btn btn-confirmar btnResultados" id="btn-confirmar-reporte" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirme el reporte una vez guardado los cambios">
                        <i class="bi bi-file-earmark-pdf"></i> Confirmar reporte
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>



<!--MODAL PARA SUBIR RESULTADOS DE ESPIROMETRIA-->

<div class="modal fade" id="ModalSubirResultadosEspiro" tabindex="-1" aria-labelledby="resultados" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_aceptar">Cargue un nuevo estudio de EASYONE</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="subirResultadosEspiro">
                            <h4>Seleccione el estudio de EASYONE a subir</h4>
                            <input type="file" class="form-control input-form mt-3" name="resultado_espiro[]" accept=".pdf" id="resultado_espiro">
                        </form>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-borrar" id="btn-limpiar-resultado-espiro">Limpiar</button>

                <!-- BTN SUBIR RESULTADOS DE ESPIRO -->
                <button type="submit" class="btn btn-confirmar" id="btn-subir-resultados-espiro" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los documentos subidos">
                    <i class="bi bi-clipboard2-plus"></i> Subir resultados
                </button>
            </div>
        </div>
    </div>
</div>


<!--MODAL PARA SUBIR RESULTADOS DE ESPIROMETRIA-->

<div class="modal fade" id="ModalSubirResultadosAudio" tabindex="-1" aria-labelledby="resultados" aria-hidden="true">
    <div class="modal-dialog modal-xl  modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="title-paciente_aceptar">Cargue un nuevo reporte de Audiometría</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <form id="subirResultadosAudio">
                            <h4>Seleccione el estudio que desea subir: </h4>
                            <input type="file" class="form-control input-form mt-3" name="resultado_audio[]" accept=".pdf" id="resultado_audio">
                        </form>
                    </div>


                </div>
            </div>
            <div class="modal-footer">

                <!-- BTN SUBIR RESULTADOS DE ESPIRO -->
                <button type="submit" class="btn btn-confirmar" id="btn-subir-resultados-audio" data-bs-toggle="tooltip" data-bs-placement="top" title="Guarda los documentos subidos">
                    <i class="bi bi-clipboard2-plus"></i> Subir resultados
                </button>
            </div>
        </div>
    </div>
</div>




<script>
    $('#btn-limpiar-resultado-espiro').on('click', function() {
        $('#resultado_espiro').val('');
    })

    $('#resultado_espiro').on('change', function() {
        var fileList = $(this)[0].files || [] //registra todos los archivos
        let aviso = 0;
        for (file of fileList) { //una iteración de toda la vida
            ext = file.name.split('.').pop()
            switch (ext) {
                case 'pdf':
                    break;
                default:
                    aviso = 1;
                    break;
            }
        }
        if (aviso == 1) {
            $(this).val('')
            alertMensaje('error', 'Archivo incorrecto', 'Algunos archivos no son correctos')
        }
    });


    function popimg(URL, DAT) {
        console.log(document.body.clientWidth)

        // if (document.body.clientWidth < 480) return false;
        var full = document.getElementById("full");
        full.className = "showimg";
        full.title = DAT;
        full.src = URL;
        return true;
    }

    var body = $('body');

    // body.on({
    //     click: function() {
    //         var src = $(this).attr('src');
    //         let div = $('<div class="slide" title="Teclea enter para salir de la imagen">');
    //         div.css({
    //             background: 'RGBA(0,0,0,.5) url(' + src + ') no-repeat center',
    //             backgroundSize: 'contain',
    //             width: '100%',
    //             height: '100%',
    //             position: 'fixed',
    //             zIndex: '10000',
    //             top: '0',
    //             left: '0',
    //             cursor: 'pointer'
    //         }).appendTo('body');
    //         body.keyup(function(e) {
    //             if (e.key === "Enter") {
    //                 // img.remove();
    //                 div.remove();
    //             }
    //         })
    //         var scroll_zoom = new ScrollZoom(div, 5, 0.5)
    //     }
    // }, 'img[data-enlargable]')

    // $('img[data-enlargable]').addClass('img-enlargable').click(function() {

    // });
</script>


<style>
    .f-carousel__slide {
        height: 100%;
        /* Puedes ajustar esta altura según tus necesidades */
        display: flex;
        align-items: center;
        /* Centrar verticalmente */
        justify-content: center;
        /* Centrar horizontalmente */
    }

    .f-carousel__slide img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        display: block;
    }

    div.modal-backdrop.fade.show {
        z-index: 99;
    }

    #modalSubirInterpretacion {
        z-index: 100;
    }
</style>