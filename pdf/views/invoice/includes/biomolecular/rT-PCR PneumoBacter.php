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
    .cursive {
        font-style: italic;
    }
</style>

<br>
<br>
<br>
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[7]->resultado ?></strong> </p>
<table style="width: 100%;">
    <tr style="background-color: darkgrey;">
        <td style=" padding:3px;"><strong>rT-PCR PneumoBacter </strong></td>
        <td style="text-align:center; padding:3px;"><strong>Resultado</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <tr>
        <td><strong>PneumoBacter</strong></td>
        <td></td>
        <td></td>
    </tr>
    <?php

    $body = array_slice($body, 0, count($body) - 1);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class="cursive"><?php echo $value->nombre ?></td>
                <td class="<?php echo $value->resultado == 'POSITIVO' ? "bold rojo" : "bold";  ?>" style="text-align:center;"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td style="text-align:center;"><?php if ($value->resultado != 'N/A') echo "NO DETECTADO"; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="12">&nbsp;</td>
            </tr>
            <tr class="bold">
                <td colspan="12" style="text-align: left;" class="cursive"><i><?php echo $value->nombre ?></i></td>
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
    El Kit Allplex™ PneumoBacter es un ensayo de PCR multiplex en tiempo real que permite la amplificación simultánea y la detección de ácidos nucléicos de destino de Chlamydophila pneumoniae, Mycoplasma pneumoniae, Legionella pneumophila, Bordetella pertussis, Bordetella parapertussis y Streptococcus pneumoniae. Y el Médico tratante es quien realiza la interpretación de este resultado de acuerdo a los datos clínicos que el paciente presente.
</p>
<br>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;">
    <tr>
        <td><strong>Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
        <!-- <td><strong>No. lote: </strong>TBD106L-222923</td> -->
    </tr>
    <tr>
        <td> <strong>Kit Diagnóstico: </strong>Allplex™ PneumoBacter Assay </td>
    </tr>
</table>