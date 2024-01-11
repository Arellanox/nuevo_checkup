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
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[16]->resultado ?></strong> </p>

<table style="width: 100%;" cellspacing="0">
    <tr style="background-color: #d3d3d3;">
        <th style="width: 40%; font-size: 12px;text-align:left;padding: 6px 5px; background-color: #d3d3d3;">
            <strong style="font-size:12px">Prueba</strong>
        </th>
        <th style="width: 20%; font-size: 12px;text-align:center; padding: 6px 12px; background-color: #d3d3d3;">
            <strong style="font-size:12px">Resultado</strong>
        </th>
        <th style="width: 20%; font-size: 12px;text-align:center; padding: 6px 12px; background-color: #d3d3d3;">
            <strong style="font-size:12px">Alelo</strong>
        </th>
        <th style="width: 20%; font-size: 12px;text-align:center; padding: 6px 12px; background-color: #d3d3d3;">
            <strong style="font-size:12px">Valor de Normalidad</strong>
        </th>
    </tr>
    <tr style="padding-bottom: 0px;margin-bottom:0px">
        <td style="font-size: 12px;text-align: left; margin-top: 10px; margin-bottom: 0px; padding-bottom: 0px">rT-PCR Thrombosis SNP</td>
        <td style="height: 10px"></td>
        <td style="height: 10px"></td>
        <td style="height: 10px"></td>
    </tr>
    <?php
    $Kit_diag = $body[15]->resultado;
    $body = array_slice($body, 0, count($body) - 3);
    foreach ($body as $key => $value) {
        $valor_ct = strpos($value->nombre, 'Valor CT') !== false;
        if ($value->resultado == 'LABEL_BIOMOLECULAR') {

    ?>
            <tr>
                <td>&nbsp;</td>
                <td style="height: 10px"></td>
                <td style="height: 10px"></td>
                <td style="height: 10px"></td>
            </tr>
            <tr class="bold">
                <td style="font-size: 12px;text-align: left;" class=""><?php echo $value->nombre ?></td>
                <td style="height: 10px"></td>
                <td style="height: 10px"></td>
                <td style="height: 10px"></td>
            </tr>
            <?php
        } else {
            if (!text_content("$value->nombre")) {
            ?>
                <tr>
                    <td style="font-size: 12px;text-align: left;" class="">
                        <p style="padding: 0px; margin:0px">
                            <?php
                            echo text_cursive_result($value->nombre)
                            ?>
                        </p>
                    </td>
                    <td class="<?php echo $value->resultado == 'DETECTADO' ? "bold rojo" : ""; ?>" style="font-size: 12px;text-align:center;"><?php if ($value->resultado != 'N/A')
                                                                                                                                                    echo $value->resultado ?></td>
                    <td style="font-size: 12px;text-align:center;height: 10px" class="<?php echo $body[($key + 1)]->resultado === '-' ? "" : "bold rojo"; ?>"><?php echo $body[($key + 1)]->resultado ?></td>
                    <td style="font-size: 12px;text-align:center;">NO DETECTADO</td>
                </tr>
    <?php
                // EndIF
            }
        }
    }


    function text_content($string)
    {
        return stripos($string, 'Alelo') !== false;
    }

    function text_cursive_result($string)
    {
        $nombre_bold = ['G20210A', 'A1298C'];

        foreach ($nombre_bold as $string_search) {
            $valor = stripos($string, $string_search) !== false;
            if ($valor) {
                return str_replace($string_search, "<i style='font-size: 12px;'>$string</i>", $string);
            }
        }

        return $string;
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
    El Kit Anyplex™ II Thrombosis SNP Panel Assays es una prueba cualitativa in vitro para la determinación del
    genotipo de polimorfismos de un solo nucleótido asociado a la trombosis (SNPs): Factor V (R506Q, H1299R, Y1702C), Factor II
    (G20210A) y MTHFR (C677T, A1298C) por PCR en tiempo real. Y el Médico tratante es quien realiza la interpretación de este
    resultado de acuerdo a los datos clínicos que el paciente presente.
</p>
<br>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;font-size:14px">
    <tr>
        <td><strong style="font-size:14px">Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
    </tr>
    <tr>
        <td> <strong style="font-size:14px">Kit Diagnóstico: </strong><?php echo $Kit_diag; ?></td>
    </tr>
</table>