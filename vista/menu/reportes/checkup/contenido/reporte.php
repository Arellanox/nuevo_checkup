<?php
$data = $_POST['area'] ?? $_GET['area'] ?? null;

if ($data['valida'] == 1): ?>
    <div class="col-12 loader" id="loader">
        <div class="preloader" id="preloader"> </div>
    </div>
    <div class="row">
        <div class="col-12" style="margin-right: -5px !important;">
            <div class="rounded p-2 shadow-sm my-2 d-flex flex-column" id="lista-pacientes">
                <h5>Lista de pacientes - <?php echo $data['normalizada']; ?> </h5>

                <table class="table display responsive" id="tablaPrincipal" style="width: 100%">
                </table>
            </div>
        </div>
    </div>

    <style media="screen">
        #TablaMuestras_filter {
            display: none
        }

        .background-group {
            background-color: rgb(098, 203, 201) !important;
            color: white;
        }

        .group-hidden {
            background-color: rgb(62, 128, 126) !important;
            /* Ajusta el valor de la opacidad según tus necesidades */
        }
    </style>
<?php else: ?>
    <?php
        include "../../validator.php";
        echo AreaValidator::generarHtmlError($data);
    ?>
<?php endif; ?>
