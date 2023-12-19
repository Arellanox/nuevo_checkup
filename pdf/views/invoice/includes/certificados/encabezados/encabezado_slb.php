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
    .logo_sos img{
            position: fixed;
            top: -10px;
            left: 50px;
            right: 25px;
            height: 80px;
            margin-top: 0;
            /* background-color: blue; */
        }

        .logo_schlumberger img{
            position: fixed;
            top: -20px;
            left: 500px;
            right: 25px;
            height: 110px;
            margin-top: 0;
            /* background-color: blue; */
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
    <table style="margin: 0 auto;">
        <tbody>
            <tr class="col-foot-two">
                <td colspan="10" style="text-align: center" class="logo_sos">
                <?php
                        echo "<img src='data:image/png;base64, " . $encode_sos . "' height='85' >";
                    ?>
                </td>

                <td colspan="2" style="text-align: center;" class="logo_schlumberger">
                    <?php
                        echo "<img src='data:image/png;base64, " . $encode_schlumberger . "' height='85' >";
                    ?>
                </td>
            </tr>
        </tbody>
    </table>


    