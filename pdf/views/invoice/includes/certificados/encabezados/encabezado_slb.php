<style>
    /* .parrafo-izquierdo {
        font-size: 11px;
        margin-bottom: -10px;
        margin-right: -155px !important;
        color: #12828f;
    }

    .parrafo-derecho {
        font-size: 11px;
        margin-bottom: -10px;
        margin-left: -78px;
        color: #12828f;
    }

    .cuadro-intermedio a {
        margin-top: 70px;
        position: absolute;
        top: 38px;
        left: 340px;
    }

 */

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

    .left-image {
        float: left;
        /* width: 50%; */
        /* Adjust the width as needed */
        /* background-color: black; */
        margin: 0px;
    }

    .right-image {
        float: right;
        /* width: 50%; */
        /* Adjust the width as needed */
        /* background-color: black; */
        margin: 0px;
    }

    .container_encabezado {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* text-align: center; */

    }
</style>
<?php
//logo schlumberger
$ruta = file_get_contents('../pdf/public/assets/logo_schlumberger.png');
$encode_schlumberger = base64_encode($ruta);

//logo sos
$ruta = file_get_contents('../pdf/public/assets/logo_sos.png');
$encode_sos = base64_encode($ruta);

?>

<div class="container_encabezado">
    <?php
    echo "<img src='data:image/png;base64, " . $encode_sos . "' height='50' alt='Left Image' class='left-image'>";
    echo "<img src='data:image/png;base64, " . $encode_schlumberger . "' height='50'  alt='Right Image' class='right-image'>";
    ?>
</div>

<!-- <table style="margin: 0 auto;">
    <tbody>
        <tr class="col-foot-two">
            <td colspan="6" class="logo_sos">

            </td>

            <td colspan="6" class="logo_schlumberger">

            </td>
        </tr>
    </tbody>
</table> -->