<?php

// $comentario = $body[count($body) - 1];
// $lote = $body[count($body) - 1];
$muestra = $body[count($body) - 1];

// // $autorizacion = $body[count($body) - 3];
$kit = $body[count($body) - 2];

?>


<br>
<br>
<br>
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $muestra->resultado; ?></strong> </p>
<table style="width: 100%; font-size: 13px">
    <tr style="background-color: darkgrey;padding: 5px 8px">
        <td style="padding: 3px 5px"><strong>rT-PCR para Mycobacterium tuberculosis MDR y XDR</strong></td>
        <td style="padding: 3px 5px"><strong>Resultado</strong></td>
        <td style="padding: 3px 5px"><strong>Valor de Ct</strong></td>
        <td style="padding: 3px 5px"><strong>Valor de Normalidad</strong></td>
    </tr>

    <tr>

    </tr>

    <?php

    $resultados = array_slice($body, 0, count($body) - 2);



    foreach ($resultados as $key => $value) {
        if ($value->resultado == 'LABEL_BIOMOLECULAR') {
            echo "<br>";
            echo '<tr>
                    <td style="text-align: center;">
                        <strong>' . $value->nombre . '</strong>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>';
        } else {
            $estudio = $value->nombre;
            $respuesta = $value->resultado === 'NO DETECTADO' ? 'NO DETECTADO' : 'DETECTADO';
            $valor_ct = $respuesta === 'DETECTADO' ? $value->resultado : '';


            echo '<tr>
                    <td class="cursive">
                        ' . $estudio . '
                    </td>
                    <td>
                        <strong> ' . $respuesta . ' </strong>
                    </td>
                    <td>
                        <strong> ' . $valor_ct . ' </strong>
                    </td>
                    <td>
                        <strong>NO DETECTADO</strong>
                    </td>
                </tr>';
        }
    }

    ?>
    <!-- 
    <tr>
        <td style="text-align: center;">
            <strong>MTB</strong>
        </td>
        <td></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td class="cursive">
            Mycobacterium tuberculosis
        </td>
        <td>
            <strong>DETECTADO</strong>
        </td>
        <td>
            <strong>32.2</strong>
        </td>
        <td>
            <strong>NO DETECTADO</strong>
        </td>
    </tr> -->


</table>
<br>
<br>
<p style="text-align:justify;">
    <strong>Comentarios: </strong>

</p>
<br>
<p style="text-align:justify;">
    <strong>Equipo utilizado:</strong> CFX96™ Real-Time System BIO-RAD <br>
    <strong>Kit Diagnóstico:</strong> <?php echo $kit->resultado; ?>
</p>
<br>


<style>
    .cursive {
        font-style: italic;
    }
</style>