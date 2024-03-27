<?php


function text_bold($string)
{
    $nombre_bold = ['Mycobacterium'];

    $new_string = $string;

    // return $new_string;

    foreach ($nombre_bold as $string_search) {
        $valor_ct = strpos($string, $string_search) !== false;
        if ($valor_ct)
            return $new_string = str_replace($string_search, "<span style=' font-style: italic'>$string_search</span>", $string);
    }

    return $new_string;
}
?>


<br>
<br>
<br>
<br>
<!-- <p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[9]->resultado ?></strong> </p> -->
<table style="width: 100%;font-size: 13.4px">
    <tr style="background-color: darkgrey;">
        <td style="font-size: 14px; padding: 3px;"><strong>Prueba</strong></td>
        <td style="font-size: 14px; padding: 3px;"><strong>Resultado</strong></td>
        <td style="font-size: 14px; padding: 3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <tr>
        <td style="font-size: 16.4px"><strong> </strong></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
    <?php

    // $kit = $body[7]->resultado;
    // $NoLote = $body[8]->resultado;

    $muestra = $body[2]->resultado;
    // $NoLote = 'Numero de lote';

    $body = array_slice($body, 0, count($body) - 1);
    foreach ($body as $key => $value) {
        if (isset($value->resultado)) {
    ?>
            <tr>
                <td class="italic" style="font-size: 14px; "><?php echo text_bold($value->nombre) ?></td>
                <td class="italic" style="font-size: 14px; text-align:center;"><?php
                                                                                if ($value->resultado == 'POSITIVO') {
                                                                                    echo "<span style='font-weight:bold'>$value->resultado</span>";
                                                                                } else {
                                                                                    echo $value->resultado;
                                                                                }
                                                                                ?></td>
                <td class="italic" style="font-size: 14px; text-align:center;">NEGATIVO</td>
            </tr>
    <?php
        }
    }

    ?>
</table>
<br>
<br>
<br>
<br>
<!-- <p style="text-align:justify;"><strong>Comentarios: </strong>Esta prueba identifica en tiempo real la presencia de 9 tipos de Patógenos causantes de ETS (Enfermedades de Transmisión Sexual); el médico tratante es quien realiza la interpretación de este resultado considerando los datos clínicos del paciente.</p> -->
<br>
<p style="text-align:justify;font-size: 14px"><strong style="font-size: 14px">Método: </strong> PCR Tiempo Real<br>
    <strong style="font-size: 14px">Tipo de muestra: </strong><?php echo $muestra; ?>
</p>
<br>