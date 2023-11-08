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

<br>
<br>
<br>

<table style="width: 100%;">
    <tr style="background-color: darkgrey;">
        <td style=" padding:3px;"><strong>Prueba rT-PCR TICK BORNE DISEASES </strong></td>
        <td style="text-align:center; padding:3px;"><strong>Resultado</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <?php

    $body = array_slice($body, 0, count($body) - 4);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class="cursive"><?php echo $value->nombre ?></td>
                <td class="<?php echo $value->resultado == 'POSITIVO' ? "bold rojo" : "bold";  ?>" style="text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="text-align:center;"><?php if ($value->resultado != 'N/A') echo "NEGATIVO"; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr class="bold">
                <td colspan="12" style="text-align: left;">•<?php echo $value->nombre ?></td>
            </tr>
    <?php
        }
    }
    ?>
    <tr>
        <td><br></td>
    </tr>
</table>

<br>
<br>
<br>

<!-- Comentario -->
<p style=" text-align: justify;">
    <strong>Comentarios:</strong>
    La prueba está diseñada para la identificacion y diferenciacion del virus Tick Borne Encefalitis (TBEV), Rickettsia spp., Babesia microti y/o Babesia divergens, Ehrlichia chafeensis y/o Ehrlichia muris, Borrelia burgdorferi sensu, Borrelia miyamotoi y/o Borrelia hermsii, Anaplasma phagocitophylum y/o Coxiella burnetii como una ayuda en el diagnóstico de infecciones de las vías respiratorias causadas por . Y el médico tratante es quien realiza la interpretación de este resultado de acuerdo a los datos clínicos que el paciente presente.
</p>
<br>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;">
    <tr>
        <td><strong>Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
        <td><strong>No. lote: </strong>TBD106L-222923</td>
    </tr>
    <tr>
        <td> <strong>Kit Diagnóstico: </strong>TICK BORNE DISEASES </td>
    </tr>
</table>