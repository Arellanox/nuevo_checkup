<?php

// $comentario = $body[count($body) - 1];
// $lote = $body[count($body) - 1];
$muestra = $body[count($body) - 2];
$obs = $body[count($body) - 1];

// // $autorizacion = $body[count($body) - 3];
$kit = $body[count($body) - 3];

?>


<br>
<br>
<p style="position:absolute;top:2px;left:548px;white-space:nowrap" class="ft00">Muestra: <strong style="font-size: 11px"><?php echo $muestra->resultado; ?></strong> </p>
<table style="width: 100%; font-size: 13px">
    <tr style="background-color: #BFBFBF;padding: 5px 8px">
        <td style="padding: 3px 5px"><strong>rT-PCR para <span class="cursive">Mycobacterium tuberculosis</span> MDR y XDR</strong></td>
        <td style="padding: 3px 5px"><strong>Resultado</strong></td>
        <!-- <td style="padding: 3px 5px"><strong>Valor de Ct</strong></td> -->
        <td style="padding: 3px 5px"><strong>Valor de Normalidad</strong></td>
    </tr>

    <tr>

    </tr>

    <?php

    $resultados = array_slice($body, 0, count($body) - 3);



    foreach ($resultados as $key => $value) {
        if ($value->resultado == 'LABEL_BIOMOLECULAR') {
            echo "<br>";
            echo '<tr>
                    <td style="text-align: center;">
                        <strong>' . $value->nombre . '</strong>
                    </td>
                    <td></td>
                   
                    <td></td>
                </tr>';
        } else {
            $estudio = $value->nombre;
            $respuesta = $value->resultado === 'NO DETECTADO' ? 'NO DETECTADO' : 'DETECTADO';
            $valor_ct = $respuesta === 'DETECTADO' ? $value->resultado : '';


            echo '<tr>
                    <td class="">';
                
                    if($estudio === 'Mycobacterium tuberculosis '){
                        echo "<span class="cursive">$estudio</span>";
                    }else{
echo $estudio;
                    }
                    
            echo '</td>
                    <td>';

            if($respuesta === 'DETECTADO'){
                echo '<strong> ' . $respuesta . ' </strong>';
            }else{
                echo $respuesta;
            }         
            
            
            echo '</td>
     
                    <td>
                        NO DETECTADO
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
<p style="text-align:justify;">
    <strong>Observaciones: </strong> <?php echo $obs->resultado; ?>
</p>

<p style="text-align:justify;">
    <strong>Comentarios: </strong> El Kit Anyplex II MTB / MDR / XDR es una prueba Multiplex de PCR en tiempo real que permite la amplificación simultánea y la detección de secuencias diana de <span class="cursive">Mycobacterium tuberculosis</span> (MTB), 7 mutaciones que causan resistencia isoniacida (INH) [katG S315i, S315N, S315T, S315T, inhA promotor -15 (T), -8 (A), -8 (C)], 18 mutaciones que causan resistencia a rifampicina (RIF) [rpoB L511P, Q513K, Q513L, Q513P, 3 aminoácidos supresión en 513 ~ 516, D516V, D516Y, S522L, S522Q, H526C, H526D, H526L, H526N, H526R, H526Y, S531L, S531W, L533P, 7 mutaciones que causan resistencia a fluoroquinolonas (FQ)[gyrA A90V, S91P, D94A, D94G, D94H, D94N, D94Y], y 6 mutaciones que causan resistencia a drogas inyectables [RR 1401, 1402, 1484, promotor eis -37, -14, -10]. Y el Médico tratante es quien realiza la interpretación de este resultado de acuerdo a los datos clínicos que el paciente presente.

</p>
<br>
<p style="text-align:justify;">
    <strong>Equipo utilizado:</strong> CFX96™ Real-Time System BIO-RAD <br>
    <strong>Kit Diagnóstico:</strong> <?php echo $kit->resultado; ?>
</p>


<style>
    .cursive {
        font-style: italic;
    }
</style>