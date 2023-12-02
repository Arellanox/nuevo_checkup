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

<table style="width: 100%;">
    <tr style="background-color: darkgrey;">
        <td style=" padding:3px;"><strong>rT-PCR Panel Meningitis </strong></td>
        <td style="text-align:center; padding:3px;"><strong>Resultado</strong></td>
        <td style="text-align:center; padding:3px;"><strong>Valor de Normalidad</strong></td>
    </tr>
    <?php

    # $body = array_slice($body, 0, count($body) - 4);
    foreach ($body as $key => $value) {
        if ($value->resultado != 'LABEL_BIOMOLECULAR') {
    ?>
            <tr>
                <td style="text-align: left;" class=""><?php echo $value->nombre ?></td>
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

</table>

<!-- Comentario -->
<p style=" text-align: justify;">
    <strong>Comentarios:</strong>
    Los Kit Allplex Meningitis-V1, Meningitis-V2 y Meningitis-B son ensayos PCR Multiplex en tiempo real que permiten la
    amplificación simultánea y la detección de secuencias diana de Herpes simplex virus 1 (HSV1), Herpes simplex virus 2
    (HSV2), Varicella zoster virus (VZV), Epstein-Barr virus (EBV), Cytomegalovirus (CMV), Human herpes virus 6 (HHV6), Human
    herpes virus 7 (HHV7), Parvovirus B19 (B19V), Human adenovirus (AdV), Mumps virus (MV), Human enterovirus (HEV), Human parechovirus
    (HPeV), Haemophilus influenzae (HI), Neisseria meningitidis (NM), Streptococcus pneumoniae (SP), Streptococcus agalactiae Grupo B
    (GBS) ,Listeria monocytogenes (LM), Escherichia coli K1 (EC K1). Y el Médico tratante es quien realiza la interpretación de este
    resultado de acuerdo a los datos clínicos que el paciente presente.
</p>
<br>

<!-- Tabla con la información del equipo utilzado, kit de diagnostico y lote -->
<table style="width:100%;">
    <tr>
        <td><strong>Equipo utilizado: </strong>CFX96™ Real-Time System BIO-RAD</td>
        <!-- <td><strong>No. lote: </strong>TBD106L-222923</td> -->
    </tr>
    <tr>
        <td> <strong>Kit Diagnóstico: </strong>Allplex™ Meningitis Panel Assays</td>
    </tr>
</table>