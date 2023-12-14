<style>
    .bold {
        font-weight: bold;
    }

    .rojo {
        color: red;
    }

    .resultados_resp td {
        width: 33.3%;
    }
</style>

<?php

// $comentario = $body[count($body) - 1];
// $lote = $body[count($body) - 1];
$muestra = $body[count($body) - 1];
// $autorizacion = $body[count($body) - 3];
// $kit = $body[count($body) - 1];

?>

<br>
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $muestra->resultado; ?></strong> </p>
<br><br><br>
<table style="width: 100%; font-size: 12px">
    <tr style="background-color: darkgrey;">
        <td style=" padding:3px;"><strong>rT-PCR Entero-DR </strong></td>
        <td style="text-align:center; padding:3px;"><strong>Resultado</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <?php

    $body = array_slice($body, 0, count($body) - 1);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class=""><?php echo $value->nombre ?></td>
                <td class="<?php echo $value->resultado == 'DETECTADO' ? "bold" : "";  ?>" style="text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="text-align:center;"><?php if ($value->resultado != 'N/A') echo "NO DETECTADO"; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr class="bold">
                <td colspan="12" style="text-align: left;">• <?php echo $value->nombre ?></td>
            </tr>
    <?php
        }
    }
    ?>

</table>
<br><br><br>
<!-- Comentario -->
<p style=" text-align: justify;">
    <strong>Comentarios:</strong>
    El Kit Allplex Entero-DR es una prueba de diagnóstico cualitativa in vitro que utiliza la reacción en cadena de la
    polimerasa múltiplex en tiempo real (múltiplex PCR en tiempo real).
    Esta prueba permite la detección única o múltiple de genes carbapenemasas (NDM, KPC, OXA-48, VIM, IMP), gen (CTX-M) de
    Beta-Lactamasa de espectro extendido (ESBL) y genes de resistencia a la vancomicina (VanA, VanB) en hisopos rectales o
    colonias bacterianas. Y el Médico tratante es quien realiza la interpretación de este resultado de acuerdo a los datos clínicos
    que el paciente presente.
</p>
<br><br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%; font-size:12px">
    <tr>
        <td><strong>Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
        <!-- <td><strong>No. lote: </strong>TBD106L-222923</td> -->
    </tr>
    <tr>
        <td> <strong>Kit Diagnóstico: </strong>Allplex™ Entero-DR Assay</td>
    </tr>
</table>