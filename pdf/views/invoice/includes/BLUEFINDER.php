<style>
    .bold {
        font-weight: bold;
    }

    .cursive {
        font-style: italic;
    }

    .rojo {
        color: red;
    }

    .resultados_resp td {
        width: 33.3%;
    }
</style>


<?php

$lote = $body[count($body) - 1];
$muestra = $body[count($body) - 2];
$autorizacion = $body[count($body) - 3];
$kit = $body[count($body) - 4];

?>

<!-- <p style="background-color: darkgrey; padding: 5px;text-align: center;"><strong>INFORMACIÓN CLÍNICA</strong></p> -->
<br>
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $body[7]->resultado ?></strong> </p>

<table class="resultados_resp" style="width: 100%; border-collapse: collapse; text-align: center;">
    <tr style="background-color: darkgrey;" class="bold">
        <td style="text-align: left;">Prueba BlueFinder 22</td>
        <td>Resultado</td>
        <td>Valor de Normalidad</td>
    </tr>

    <?php

    $body = array_slice($body, 0, count($body) - 3);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class="cursive"><?php echo $value->nombre ?></td>
                <td class="<?php echo $value->resultado == 'POSITIVO' ? "bold rojo" : "bold";  ?>"><?php if ($value->resultado != 'N/A') echo $value->resultado ?></td>
                <td><?php if ($value->resultado != 'N/A') echo "NEGATIVO"; ?></td>
            </tr>
        <?php
        } else {
        ?>
            <tr>
                <td colspan="12"></td>
            </tr>
            <tr class="bold">
                <td colspan="12" style="text-align: left;"><?php echo $value->nombre ?></td>
            </tr>
    <?php
        }
    }

    ?>

</table>
<p style="text-align: justify"><strong>Comentarios:</strong>La prueba está concebida como una ayuda en el diagnóstico de
    infecciones de las vías respiratorias causadas por el bocavirus humano (HBoV), el enterovirus humano (EV),
    el rinovirus humano (HRV), el adenovirus humano (HAdV), la bordetella parapertussis (B. parapertussis),
    la bordetella pertussis/holmessi (B. pertussis/B. holmessi), el virus de la gripe A subtipo H3N2,
    el virus de la gripe B (linaje Victoria), el virus de la gripe A subtipo H1N1 (pdm09), el virus de la gripe B
    (linaje Yamagata), los virus respiratorios sincitiales humanos (HRSV) A y B, el metaneumovirus humano (HMPV),
    el virus SARS-CoV-2, los virus paragripales humanos (HPIV 1, HPIV 3, HPIV 2/HPIV 4) y los coronavirus humanos
    (HCoV) OC43, HKU1, 229E/NL63. Y el médico tratante es quien realiza la interpretación de este resultado de
    acuerdo a los datos clínicos que el paciente presente.

</p>
<table style="width: 100%;">
    <tr>
        <td colspan="6" style="width: 15% ;"><strong>Equipo Utilizado:</strong> CFX96™ Real-Time System BIO-RAD </td>
        <td colspan="6" style="width: 0% ;"><strong>No. Lote:</strong> <?php echo $lote->resultado; ?> </td>
    </tr>
    <tr>
        <td colspan="6" style="width: 15% ;"><strong>Kit Diagnóstico:</strong> <?php echo $kit->resultado ?> </td>
        <!-- <td colspan="6" style="width: 0% ;"><strong>Registro Sanitario:</strong> <?php echo $autorizacion->resultado ?> </td> -->
    </tr>
</table>