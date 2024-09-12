<?php
$areas = $resultados->areas;
$count = count($areas);
$i = 0;
$nombre_estudio = '';
foreach ($areas as $key => $area) {
    $a = 0;

    echo "<h2 style='padding-bottom: 5px; padding-top: 5px;'>" . $area->area . "</h2>";

    foreach ($area->estudios as $key => $estudio) {

        echo "<h4 style='padding-top: 9px'>" . $estudio->estudio . "</h4>";
        $nombre_estudio = $estudio->estudio;

?>
        <table class="result" style="padding-top: 1px;">
            <thead>
                <tr>
                    <th class="col-one">Nombre</th>
                    <th class="col-two">Resultado</th>
                    <th class="col-three">Unidad</th>
                    <th class="col-four">Referencia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($estudio->analitos as $key => $analito) {
                    $a++;
                    if (is_array($analito)) {
                ?>
                        <tr>
                            <td class="col-one">
                                <strong>Valores absolutos</strong>
                            </td>
                            <td class="col-two">
                            </td>
                            <td class="col-three">
                            </td>
                            <td class="col-four">
                            </td>
                        </tr>
                        <?php
                        foreach ($analito as $b => $absoluto) {
                        ?>
                            <tr style="text-indent: 5px;">
                                <td class="col-one">
                                    <?php echo ($absoluto->analito != null) ? $absoluto->analito : '';  ?>
                                </td>
                                <td class="col-two">
                                    <?php echo ($absoluto->valor_abosluto != null) ? $absoluto->valor_abosluto : ''; ?>
                                </td>
                                <td class="col-three">
                                    <?php echo ($absoluto->unidad != null) ? $absoluto->unidad : ''; ?>
                                </td>
                                <td class="col-four">
                                    <?php echo ($absoluto->referencia != null) ? $absoluto->referencia : ''; ?>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <?php
                            if ($analito->resultado == 'N/A') {
                            } else {
                            ?>
                                <td class="col-one">
                                    <?php echo ($analito->nombre != null) ? $analito->nombre : '';  ?>
                                </td>
                                <td class="col-two">
                                    <?php echo ($analito->resultado != null) ? $analito->resultado : ''; ?>
                                </td>
                                <td class="col-three">
                                    <?php echo ($analito->unidad != null) ? $analito->unidad : ''; ?>
                                </td>
                                <td class="col-four">
                                    <?php echo ($analito->referencia != null) ? $analito->referencia : ''; ?>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                        <?php
                        if (isset($analito->metodo) && $analito->metodo != null || $analito->metodo != '') {
                        ?>
                            <tr>
                                <td class="col-one" style="font-size: 12px">
                                    <?php echo "<strong style='font-size: 12px'>Método: </strong>" . $analito->metodo ?>
                                </td>
                                <td class="col-two">
                                </td>
                                <td class="col-three">
                                </td>
                                <td class="col-four">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php
                        if (isset($analito->muestra) && $analito->muestra != null || $analito->muestra != '') {
                        ?>
                            <tr>
                                <td class="col-one" style="font-size: 12px">
                                    <?php echo "<strong style='font-size: 12px'>Muestra: </strong>" . $analito->muestra ?>
                                </td>
                                <td class="col-two">
                                </td>
                                <td class="col-three">
                                </td>
                                <td class="col-four">
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        <?php

                        if (isset($analito->equipo) && $analito->equipo != null || $analito->equipo != '') {
                        ?>
                            <tr>
                                <td class="col-one" style="font-size: 12px">
                                    <?php echo "<strong style='font-size: 12px'>Equipo: </strong>" . $analito->equipo ?>
                                </td>
                                <td class="col-two">
                                </td>
                                <td class="col-three">
                                </td>
                                <td class="col-four">
                                </td>
                            </tr>
                        <?php
                        }

                        if (isset($analito->observaciones) && $analito->observaciones != null || $analito->observaciones != '') {
                        ?>
                            <tr>
                                <td class="col-one" style="font-size: 12px">
                                    <?php echo "<strong style='font-size: 12px'>Observaciones:" . $analito->observaciones . " </strong>"; ?>
                                </td>
                                <td class="col-two">
                                </td>
                                <td class="col-three">
                                </td>
                                <td class="col-four">
                                </td>
                            </tr>
                <?php
                        }

                        if ($estudio->estudio == 'OTROS SERVICIOS') {
                            echo "<br>";
                        }
                    }
                }
                ?>


            </tbody>
        </table>
        <div style="font-size: 12px">

            <?php
            if ($estudio->metodo == '' || $estudio->metodo == null) {
            } else {
                echo "<strong style='font-size: 12px'>Método: </strong>" . $estudio->metodo;
            }
            ?>
        </div>
        <div style="font-size: 12px">

            <?php
            if ($estudio->muestra == '' || $estudio->muestra == null) {
            } else {
                echo "<strong style='font-size: 12px'>Muestra: </strong>" . $estudio->muestra;
            }
            ?>
        </div>
        <div style="font-size: 12px">

            <?php
            if ($estudio->equipo == '' || $estudio->equipo == null) {
            } else {
                echo "<strong style='font-size: 12px'>Equipo: </strong>" . $estudio->equipo;
            }
            ?>
        </div>
        <div style="font-size: 12px">

            <?php
            if ($estudio->observaciones == '' || $estudio->observaciones == null) {
            } else {
                echo "<strong style='font-size: 12px'>Observaciones:" . $estudio->observaciones . "</strong>";
            }
            ?>
        </div>
        <?php

    }
    $i++;
    // $color_count % 2 == 0
    // $a < 15
    // if($a < 15){
    // }

    // if ($i < $count) {  
    //     echo '<div class="break"></div>';
    // }

    // echo $a;
    if ($a <= 15) {
    } else {
        if ($i < $count) {

            // echo "salto de linea";
        ?>
            <div class="break"></div>
    <?php
        }
        // echo '<div class="break">';
    }
    ?>

<?php
}
?>

<?php
    if($nombre_estudio == "PCR VIRUS DEL PAPILOMA HUMANO ALTO RIESGO (VPH-RT)"):
?>
    <p style=" text-align: justify;">
    <strong>Comentarios:</strong>
    Los genotipos del VPH incluidos en el “Grupo de alto riesgo” son 31, 33, 35, 39, 45, 51, 52, 56, 58, 59, 66 y 68. Un resultado positivo para este grupopuede significar la detección de las secuencias diana de uno o varios de estos genotipos.
    <br>
    Un resultado Negativo, no descarta la posibilidad de infección por otro(s) genotipo(s) de VPH (de alto o bajo riesgo) no contemplado(s) en esta pruebao por otras ITS.
    La detección de ácidos nucleicos del VPH depende de la adecuada toma de muestra, manipulación, transporte y del almacenamiento correcto de lamisma.
    <br>
    Los resultados de esta prueba deberán correlacionarse con la anamnesis, datos epidemiológicos y otros datos de los que disponga el médico tratante.Esta prueba no sustituye a estudios histopatológicos, citológicos u otros.
</p>
<?php
    endif;
?>