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
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[8]->resultado ?></strong> </p>

<table style="width: 100%;" cellspacing="0">
    <tr style="background-color: #d3d3d3;">
        <th style="font-size: 12px;text-align:left;padding: 6px 5px; background-color: #d3d3d3;"><strong style="font-size:12px">Prueba <?php echo $body[9]->resultado ?></strong></th>
        <th style="font-size: 12px;text-align:center; padding: 6px 12px; background-color: #d3d3d3;"><strong style="font-size:12px">Resultado</strong></th>
        <th style="font-size: 12px;text-align:center; padding: 6px 12px; background-color: #d3d3d3;"> <strong style="font-size:12px">Valor de Normalidad</strong></th>
    </tr>
    <tr>
        <td style="height: 10px"></td>
        <td style="height: 10px"></td>
        <td style="height: 10px"></td>
    </tr>
    <?php

    $body = array_slice($body, 0, count($body) - 1);
    foreach ($body as $key => $value) {
        $valor_ct = strpos($value->nombre, 'Valor CT') !== false;
        if ($valor_ct) {
    ?>
            <tr>
                <td style="padding-bottom: 15px;font-size: 12px;text-align: left;" class="bold">Valor CT</td>
                <td class="" style="padding-bottom: 15px;font-size: 12px;text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="padding-bottom: 15px;font-size: 12px;text-align:center;"></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td style="font-size: 12px;text-align: left;" class="">
                    <p style="padding: 0px; margin:0px">
                        <?php echo text_bold($value->nombre) ?>
                    </p>
                </td>
                <td class="<?php echo $value->resultado == 'POSITIVO' ? "bold" : "";  ?>" style="font-size: 12px;text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="font-size: 12px;text-align:center;"><?php if ($value->resultado != 'N/A') echo "NEGATIVO"; ?></td>
            </tr>
    <?php
        }
    }


    function text_bold($string)
    {
        $nombre_bold = ['Virus Sincitial Respiratorio', 'SARS-CoV-2', 'Influenza A', 'Influenza B'];

        foreach ($nombre_bold as $string_search) {
            $valor_ct = strpos($string, $string_search) !== false;
            if ($valor_ct)
                return $nombre_formt = str_replace($string_search, "<strong style='font-size: 12px;'>$string_search</strong>", $string);
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
<p style=" text-align: justify; font-size:14px">
    <strong style="font-size:14px">Comentarios:</strong>
    Esta prueba identifica en tiempo real la presencia de Virus Sincitial Respiratorio (VSR, incluidos los tipos A y B), SARS-CoV-2, Influenza A (incluidos los subtipos A (H3) y A (H1N1), Influenza B (incluidos los linajes Victoria y Yamagata), el resultado negativo de la prueba no significa inmunidad y el médico tratante es quien realiza la interpretación de este resultado de acuerdo a los datos clínicos que el paciente presente.
</p>
<br>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;font-size:14px">
    <tr>
        <td><strong style="font-size:14px">Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
    </tr>
    <tr>
        <td> <strong style="font-size:14px">Kit Diagnóstico: </strong>RSV - CoviFlu </td>
    </tr>
</table>