<style>
    .header {
        position: fixed;
        top: -60px;
        left: 45px;
        right: 45px;
        height: 100px;
        margin-top: 0;
        padding-top: 15px;
        /* background-color: pink; */
    }

    .encabezado_container {
        position: absolute;
        left: 470px;
        /* top: 30px; */
    }
    P{
        position: absolute;
        left: -350px;
        font-size: 22px;
        color: #215868;
    }
    
</style>

<?php

//logo bimo
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode_bimo = base64_encode($ruta);
?>

<div class="encabezado_container">
    <p><strong>CERTIFICADO MÉDICO</strong></p>
    <?php
    echo "<img src='data:image/png;base64, " . $encode_bimo . "' height='100' alt='Left Image' class='left-image'>";
    ?>
</div>