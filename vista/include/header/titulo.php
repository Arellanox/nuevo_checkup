<?php
    $menu = $_POST['menu'];
    $tipo = $_POST['tipo'] ?? 0;
?>
<div class="px-3 pt-2 border-bottom portada_imag" id="Titulo-Contenido">
    <div class="container d-flex flex-wrap mb-1">
        <div class="col-12 col-lg-auto mb-lg-0 me-lg-auto">
            <div class="row">
                <?php
                    if ($tipo == 'btn-regresar-vista') {
                        echo '<div class="col-auto d-flex justify-content-center align-items-center">
                        <a href="" id="btn-regresar-vista" onclick="event.preventDefault()"><i class="bi bi-chevron-bar-left"></i> Regresar</a>
                      </div>';
                    }
                ?>

                <div class="col-auto d-flex justify-content-start">
                    <h2 class="text-center" style="margin: 0px;" id="titulo_area"><?php echo $menu; ?>
                        <!--
                        <?php if($menu == "Resultados de Laboratorio Clinico"){ ?> <?php } ?> -->
                    </h2>
                </div>

            </div>
        </div>
        <div class="col-12 col-lg-auto text-center" id="botones-menu-js">
            <?php include "botones.php" ?>
        </div>
    </div>
</div>

<style>
    .portada_imag {
        background-image: linear-gradient(rgb(246 253 255 / 90%), rgba(246, 253, 255, 90%)), url(https://bimo-lab.com/nuevo_checkup/archivos/sistema/ilustraciones/recuadro_2.jpg);
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 100%;
        z-index: -1;
        box-shadow: 0 -4px 5px 4.5px rgb(33 37 41 / 43%) !important;
        margin-bottom: 4px;
    }
</style>