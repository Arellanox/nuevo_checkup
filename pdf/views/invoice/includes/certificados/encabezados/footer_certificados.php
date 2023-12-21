<style>
    .footer-padre {
        /* margin-top: 100px !important; */
        text-align: center;
        /* Centra el contenido horizontalmente */
    }

    .footer-padre .parrafo-izquierdo {
        font-size: 11px;
        margin-bottom: -10px;
        margin-right: -99px !important;
        color: #12828f;
    }

    .footer-padre .parrafo-derecho {
        font-size: 11px;
        margin-bottom: -10px;
        margin-left: 410px !important;
        color: #12828f;
    }

    .footer-padre .cuadro-intermedio a {
        /* margin-top: 70px; */
        position: absolute;
        top: 0px;
        left: 340px;
    }

    .footer {
        position: fixed;
        bottom: -60px;
        left: 25px;
        right: 25px;
        /* height: 100px; */
        /* background-color: pink; */
    }
</style>

<?php


?>

<div class="footer-padre">
    <p style="color: #054d60; text-align: left !important;"><strong>Diagnostico Biomolecular S.A. de C.V.</strong></p>
    <table style="margin: 0 auto;"> <!-- Añade este estilo para centrar la tabla -->
        <tbody>
            <tr class="col-foot-two">
                <td colspan="10" style="text-align: left !important;">
                    <p class="parrafo-izquierdo" style="margin-top: -10px; "><strong>Administración</strong></p>
                    <p class="parrafo-izquierdo">Blvd Adolfo RuizCortines 1344, Piso 2</p>
                    <p class="parrafo-izquierdo">Suite 245, Col.Tabasco2000,</p>
                    <p class="parrafo-izquierdo">C.P. 86035 Villahermosa,CentroTabasco.</p>
                    <p class="parrafo-izquierdo"><strong>hola</strong>@bimo.com.mx | Tel: <strong>993 500029</strong></p>
                </td>
                <td class="cuadro-intermedio" colspan="10">
                    <a target="_blank" href="<?= $qr[0] ?>"> <img src='<?= $qr[1] ?>' alt='QR Code' width='100' height='100'> </a>
                </td>

                <td colspan="2" style="text-align: right;">
                    <p class="parrafo-derecho" style="margin-top: -20px;"><strong>Laboratorio-Clínica checkups</strong></p>
                    <p class="parrafo-derecho">Av. JoséPagés Llergo #150, Col. Arboledas</p>
                    <p class="parrafo-derecho">C.P. 86079 Villahermosa, Centro, Tabasco.</p>
                    <p class="parrafo-derecho"><strong>hola</strong>@bimo.com.mx|Tel: <strong>9936 340250</strong></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>