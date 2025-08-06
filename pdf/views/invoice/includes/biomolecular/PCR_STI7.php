<br>
<br>
<br>
<br>
<!-- <p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[7]->resultado ?></strong> </p> -->
<table style="width: 100%;font-size: 13.4px">
    <tr style="background-color: darkgrey;">
        <td style="font-size: 13.4px"><strong>Prueba</strong></td>
        <td style="font-size: 13.4px"><strong>Resultado</strong></td>
        <td style="font-size: 13.4px"><strong>Valor de Normalidad</strong></td>
    </tr>
    <tr>
        <td style="font-size: 16.4px"><strong>PCR Infecciones de transmisión sexual (STI7)</strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <?php

    $kit = $body[7]->resultado;
    $NoLote = $body[8]->resultado;

    $body = array_slice($body, 0, count($body) -1);
    foreach ($body as $key => $value) {
        if (isset($value->resultado)) {
    ?>
            <tr>
                <td class="italic" style="font-size: 13.4px; font-style: italic"><?php echo $value->nombre ?></td>
                <td class="italic" style="font-size: 13.4px; font-style: italic"><?php
                                                                                    if ($value->resultado == 'POSITIVO') {
                                                                                        echo "<span style='font-weight:bold'>$value->resultado</span>";
                                                                                    } else {
                                                                                        echo $value->resultado;
                                                                                    }
                                                                                    ?></td>
                <td class="italic" style="font-size: 13.4px; font-style: italic">NEGATIVO</td>
            </tr>
    <?php
        }
    }

    ?>
    <tr>
        <td colspan="3"><p style="text-align:justify;"><strong>Tipo de muestra: </strong> <?php echo $kit;  ?>  <br></td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<p style="text-align:justify;"><strong>Comentarios: </strong>Esta prueba identifica en tiempo real la presencia de 7 tipos de Patógenos causantes de ETS (Enfermedades deTransmisión Sexual); el médico tratante es quien realiza la interpretación de este resultado considerando los datos clínicos del paciente.</p>
<br>
<p style="text-align:justify;"><strong>Método: </strong>rT-PCR en Tiempo Real. <br>
    <!-- <strong>Kit Diagnóstico: </strong><?php echo $kit; ?> <br>
    <strong>No. Lote: </strong><?php echo $NoLote; ?> <br> -->
</p>
<br>