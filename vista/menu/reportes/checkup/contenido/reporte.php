<?php
$data = $_POST['area'] ?? $_GET['area'] ?? null;

if ($data['valida'] == 1): ?>
    <div class="col-12 loader" id="loader">
        <div class="preloader" id="preloader"> </div>
    </div>

    <div class="rounded p-3 shadow-sm my-2 table-responsive bg-white mx-4 my-4" id="lista-pacientes">
        <table class="table table-hover display responsive" id="tablaPrincipal" style="width: 100% !important">
        </table>
    </div>

    <style media="screen">
       #tablaPrincipal_wrapper{
           width: 100% !important
       }
    </style>
<?php else: ?>
    <?php
        include "../../validator.php";
        echo AreaValidator::generarHtmlError($data);
    ?>
<?php endif; ?>
