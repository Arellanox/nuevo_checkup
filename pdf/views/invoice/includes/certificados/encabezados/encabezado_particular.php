<style>
    .header {
        position: fixed;
        top: -35px;
        left: 45px;
        right: 45px;
        height: 80px;
        margin-top: 0;
        padding-top: 25px;
        /* background-color: pink; */
    }
    .container{
        position: absolute;
        left: 470px;
        top: 30px;
    }
</style>

<?php

//logo bimo
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode_bimo = base64_encode($ruta);
?>

<div class="container">
<?php
    echo "<img src='data:image/png;base64, " . $encode_bimo . "' height='100' alt='Left Image' class='left-image'>";
    ?>
</div>