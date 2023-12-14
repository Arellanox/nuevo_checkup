<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Valoración Prequirúrgica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 165px 10px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin-top: 60px;
            margin-bottom: 40px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: -175px;
            left: 25px;
            right: 25px;
            height: 220px;
            margin-top: 0;
        }

        .footer {
            position: fixed;
            bottom: -200px;
            left: 25px;
            right: 25px;
            height: 220px;
            /* background-color: pink; */
        }

        a {
            position: fixed;
            padding: 0px;
            top: -15px;
            left: 40px
        }

        .footer .page:after {
            content: counter(page);
        }

        /* Saltar a nueva pagina */
        .break {
            page-break-after: always;
        }

        /* Content */
        .invoice-content {
            border-radius: 4px;
            padding-bottom: 10px;
            padding-right: 30px;
            padding-left: 30px;
            text-align: justify;
            text-justify: inter-word;
            /* background-color: pink; */
        }


        h1 {
            font-size: 22px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h2 {
            font-size: 15px;
            margin-top: 18px;
            /* margin-bottom: 10px; */
            text-align: center;
            background-color: rgba(215, 222, 228, 0.748);
            /* padding-top: 10px; */
        }

        h3 {
            font-size: 16px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h4 {
            font-size: 14px;
            margin-top: 2px;
            margin-bottom: 2px;
            line-height: 1;
        }

        h5 {
            font-size: 12.5px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        p {
            font-size: 12px !important;
            line-height: 1.5 !important;
        }

        label {
            font-size: 12px !important;
            line-height: 1.5 !important;
        }

        strong {
            font-size: 12px;
            /* line-height: 1.3; */
            margin-top: 0.5em;
            margin-bottom: 0.5em;

        }

        .align-center {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
            /* table-layout:fixed; */
        }

        th,
        td {
            width: 100%;
            max-width: 100%;
            word-break: break-all;
        }

        /* Para divisiones de 3 encabezado*/
        .col-left {
            width: 44%;
            max-width: 44%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-center {
            width: 32%;
            max-width: 32%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 24%;
            max-width: 24%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        /* divisiones de 3 footer */
        .col-foot-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
            font-size: 12px;
        }

        .col-foot-two {
            width: 40%;
            max-width: 40%;
            text-align: center;
            font-size: 12px;
        }

        .col-foot-three {
            width: 30%;
            max-width: 30%;
            text-align: right;
            font-size: 12px;
        }

        /* Para divisiones de 4 */
        .result {
            font-size: 12px
        }

        /* diviciones de 2 */
        .col-izq {
            width: 30%;
            max-width: 30%;
            text-align: center;
        }

        .col-der {
            width: 70%;
            max-width: 70%;
            text-align: left;
        }

        /* Fivisiones de cinco */
        .col-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
        }

        .col-two {
            width: 20%;
            max-width: 20%;
            text-align: right;
        }

        .col-three {
            width: 25%;
            max-width: 25%;
            text-align: center;

        }

        .col-four {
            width: 25%;
            max-width: 25%;
            text-align: center;
        }

        .invoice-content>.table-ant {
            border-collapse: collapse;
            width: 100%;
        }


        .invoice-content>.table-ant>.th,
        .td {
            padding: 4px;
            text-align: center !important;
            border-bottom: 1px solid #ddd;
        }

        .invoice-content>.table-ant>.th {
            background-color: #f2f2f2;
            font-weight: bold;
        }


        /* Estilos para la tabla de audiometria tonal */
        .tonal>.table-tonal {
            border-collapse: collapse;
            width: 70%;
        }

        .tonal>.table-tonal>.th-tonal,
        .td-tonal {
            border: 2px solid black;
            padding: 2px;
            text-align: center;
        }

        .tonal>.table-tonal>.th-tonal {
            background-color: #f2f2f2;
        }

        /* termina estilos para tabla de audiometria tonal */


        /* Estilos de tabla de audiometria */
        .img-audiometria table {
            width: 100%;
            border-collapse: collapse;
        }

        .img-audiometria th,
        .img-audiometria td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .img-audiometria th {
            background-color: #e1e6ea;
            color: black;
        }

        .img-audiometria img {
            max-width: 100%;
            height: auto;
        }

        /* Fin de estilos de audiometria */
    </style>
</head>

<?php



function convertirObjetoAArray($objeto)
{
    if (is_object($objeto)) {
        $objeto = (array)$objeto;
    }
    if (is_array($objeto)) {
        return array_map('convertirObjetoAArray', $objeto);
    }
    return $objeto;
}



function ifnull($variable, $msj = "Sin datos")
{
    if ($variable == '') {
        return $msj;
    } else {
        return $variable;
    }
}


$array1 = convertirObjetoAArray($resultados);
// echo '<pre>';
// var_dump($array1[0]);
// echo '</pre>';
// exit;
$array = $array1[0]['JSON_ANTECENDENTES'];



// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('../pdf/public/assets/firma_audio.png');
$encode_firma = base64_encode($ruta_firma);


?>

<body>
    <!-- header -->
    <div class="header">
        <br><br>

        <table>
            <tbody>
                <tr>
                    <td class="col-der" style="border-bottom: none">
                        <h4>
                            DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                            Checkup Clínica y Prevención<br>
                            <?php echo $encabezado->TITULO ?>
                        </h4>
                    </td>
                    <td class="col-izq" style="border-bottom: none; text-align:center;">
                        <?php
                        echo "<img src='data:image/png;base64, " . $encode . "' height='75' >";
                        // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                        ?>

                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td style="text-align: center; border-style: solid none solid none; ">
                        <h3>
                            <?php echo $encabezado->SUBTITULO ?>
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="col-left" style="border-bottom: none">

                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO_IMAGEN; ?>
                        </strong>
                    </td>
                    <td class="col-center" style="border-bottom: none">
                        Edad: <strong style="font-size: 12px;">
                            <?php echo $encabezado->EDAD; ?></strong>
                    </td>
                    <td class="col-right" style="border-bottom: none">
                        Sexo: <strong style="font-size: 12px;"><?php echo $encabezado->SEXO; ?> </strong>
                    </td>
                </tr>
                <tr>
                    <td class="col-left" style="border-bottom: none">
                        Nombre: <strong style="font-size: 12px;"> <?php echo $encabezado->NOMBRE; ?> </strong>
                    </td>
                    <td class="col-center" style="border-bottom: none">
                        Fecha de Nacimiento: <strong style="font-size: 12px;"> <?php echo $encabezado->NACIMIENTO; ?>
                        </strong>
                    </td>
                    <td class="col-right" style="border-bottom: none">
                        Pasaporte: <strong style='font-size:12px'>
                            <?php echo (isset($encabezado->PASAPORTE) && !empty($encabezado->PASAPORTE)) ? $encabezado->PASAPORTE : "SD"; ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-left" style="border-bottom: none">
                        Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $encabezado->FECHA_RESULTADO_IMAGEN; ?> </strong>
                    </td>
                    <td class="col-center" style="border-bottom: none">
                    </td>
                    <td class="col-right" style="border-bottom: none">
                        <!-- Tipo de Muestra: <strong>Sangre</strong> -->
                    </td>
                </tr>
                <tr>
                    <td class="col-left" style="border-bottom: none">

                    </td>
                    <td class="col-center" style="border-bottom:none">
                    </td>
                </tr>
            </tbody>
        </table>
        <p style="font-size: 12px; padding-left: 3.5px; margin: -1px;">
            <?php echo "Procedencia: <strong style='font-size: 12px;'> $encabezado->PROCEDENCIA"; ?> </strong>

            <?php if ($encabezado->PAQUETE_CARGADO) { ?>
                <span style="margin-left: 20px;">
                    <!-- Tipo de muestra  -->
                    <?php echo "Paquete: <strong style='font-size: 12px;'> $encabezado->PAQUETE_CARGADO"; ?> </strong>
                </span>
            <?php } ?>

            <?php if ($encabezado->CATEGORIA) { ?>
                <span style="margin-left: 20px;">
                    <!-- Tipo de muestra  -->
                    <?php echo "Categoría: <strong style='font-size: 12px;'> $encabezado->CATEGORIA"; ?> </strong>
                </span>
            <?php } ?>
        </p>
        <p style="font-size: 12px; padding-left: 3.5px; margin: -1px; margin-top: 5px">
            <?php echo (isset($encabezado->MEDICO_TRATANTE) || !empty($encabezado->MEDICO_TRATANTE)) ? "Médico Tratante: <strong style='font-size: 10px;'> " . $encabezado->MEDICO_TRATANTE . "</strong>" : ""; ?>
            </strong>
        </p>
        <!-- <p>Aqui va el encabezado y es el espacio disponible hasta donde llegue el titulo siguiente.</p> -->
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        $footerDoctor = 'Dra. Elsa Guadalupe Calderón Valencia <br>UJAT - Cédula profesional: 584962 
                        <br>Certified Occupational Hearing Conservationist <br>CAOHC ID NUMBER: 516334';

        include 'includes/footer.php';
        ?>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <!-- Antecedentes del paciente -->
        <div id="antecedentes">
            <h2 style="padding:5px !important">Antecedentes</h2>
            <div class="content">
                <table class="" style="max-width:10px !important; font-size:9;">
                    <tbody class="">
                        <tr class="">
                            <td class="" style='max-width:190px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES PERSONALES PATOLÓGICOS:</label>
                                    <label class=""> <?php echo $array[0]['comentario'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES QURÚRGICOS:</label>
                                    <label class=""> <?php echo $array[1]['respuesta'] ?> <?php echo $array[1]['comentario'] ?> </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES DE FRACTURAS:</label>
                                    <label class=""> <?php echo $array[2]['respuesta'] ?> <?php echo $array[2]['comentario'] ?> </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> HOSPITALIZACIONES PREVIAS:</label>
                                    <label class=""> <?php echo $array[3]['respuesta'] ?> <?php echo $array[3]['comentario'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ALERGIAS:</label>
                                    <label class=""> <?php echo $array[4]['respuesta'] ?> <?php echo $array[4]['comentario'] ?></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> TABAQUISMO:</label>
                                    <label class=""> <?php echo $array[5]['respuesta'] ?> <?php echo $array[5]['comentario'] ?> </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ALCOHOLISMO:</label>
                                    <label class=""> <?php echo $array[6]['respuesta'] ?> <?php echo $array[6]['comentario'] ?> </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> TOXICOMANIAS:</label>
                                    <label class=""> <?php echo $array[7]['respuesta'] ?> <?php echo $array[7]['comentario'] ?> </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Cirugia programada -->
        <div class="cirugia">
            <p style="padding:5px !important;">Cirugía Programada: <?php echo $array1[0]['CIRUGIA_PROGRAMADA'] ?></p>

            <div class="content">
                <p id="back_cirugia">
                    <?php
                    echo $array1[0]['SIGNOS_VITALES_REPORTE']
                    ?>
                </p>
            </div>
        </div>
        <!-- Exploracion fisiica -->
        <div class="exploracion_fisica">
            <h2 style="padding:5px !important;">Exploracion Fisica</h2>
            <p id="exploracion_fisica">
                <?php echo $array1[0]['EXPLORACION_FISICA'] ?>
            </p>
        </div>
        <div class="break"></div>
        <!-- Laboratorios -->
        <div class="laboratorios">
            <h2 style="padding:5px !important;">Laboratorios</h2>
            <p>
                <?php echo $array1[0]['LABORATORIOS_REPORTE'] ?>
            </p>
            <br>
            <div class="content">
                <table class="" style="max-width:10px !important; font-size:9;">
                    <tbody class="">
                        <tr class="">
                            <td class="" style='max-width:190px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ELECTROCARDIOFRAMA 12 DERIVACIONES :</label>
                                    <label class="">
                                        <?php echo $array1[0]['ELECTROCARDIOGRAMA_DERIVACIONES'] ?>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> RADIOGRAFÍA DE TORAX:</label>
                                    <label class="">
                                        <?php echo  $array1[0]['RADIOGRAFIA_TORAX'] ?>
                                    </label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Riesgos quirurgico -->
        <div class="riesgos_quirurgicos">
            <h2 style="padding:5px !important;">Riesgos Quirúrgico</h2>
            <div class="content">
                <div class="content">
                    <table class="" style="max-width:10px !important; font-size:9;">
                        <tbody class="">
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">ASA:</label>
                                        <label class=""> <?php echo  $array1[0]['ASA'] ?></label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GOLDMAN:</label>
                                        <label class=""> <?php echo  $array1[0]['GOLDMAN'] ?> </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA RESPIRATORIO :</label>
                                        <label class="">
                                            <?php echo  $array1[0]['GUPTA_RESPIRATORIO'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA NEUMONIA:</label>
                                        <label class="">
                                            <?php echo  $array1[0]['GUPTA_NEUMONIA'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA CARDIOVASCULAR:</label>
                                        <label class="">
                                            <?php echo  $array1[0]['GUPTA_CARDIOVASCULAR'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GENEVA:</label>
                                        <label class="">
                                            <?php echo  $array1[0]['GEVENA'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">CAPRINI :</label>
                                        <label class="">
                                            <?php echo  $array1[0]['CAPRINI'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">STOP- BANG :</label>
                                        <label class="">
                                            <?php echo  $array1[0]['STOP_BANG'] ?>
                                        </label>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="break"></div>
        <!-- Recomendaciones -->
        <div class="recomendaciones">
            <h2 style="padding:5px !important;">Recomendaciones</h2>
            <div class="content">
                <div class="recomendacion_general">
                    <p>
                        <?php echo  $array1[0]['RECOMENDACIONES_TEXTO'] ?>
                    </p>
                </div>
                <div class="list">
                    <p>
                        <?php
                        foreach ($array1[0]['RECOMENDACIONES_JSON'] as $key => $e) {
                            $key = $key + 1;
                            $i = '<strong>' . $key . '. </strong>';
                            $recomendacion = $e['recomendacion'];

                            echo $i . $recomendacion;
                            echo "<br>";
                            echo "<br>";
                        }

                        ?>
                        <!-- <strong>1.</strong> AYUNO 8 HRS PREVIAS A LA CIRUGIA
                        <br> <br>
                        <strong>2.</strong> EVITAR SOBRECARGA HIDRICA, SE RECOMIENDA CANALIZAR CON SOL. HARTMANN DURANTE EL PROCEDIMIENTO, GUIAR REANIMACION POR METAS (MANTENER PAM >65MMHG, DIURESIS > 0.5 A 1.5ML/KG/HRA, BALANCES NEUTROS O DISCRETAMENTE NEGATIVOS.)
                        <br> <br>
                        <strong>3.</strong> ENOXAPARINA 40MG SC CADA 24 HRS, INICIAR 24 HRS POSTERIOR A LA CIRUGIA
                        <br> <br>
                        <strong>4.</strong> MEDIAS DE COMPRESION INTERMEDIA 20 A 30MMHG
                        <br> <br>
                        <strong>5.</strong> DEAMBULACION TEMPRANA
                        <br> <br>
                        <strong>6.</strong> MANTENER 1 PG EN RESERVA PARA QUIROFANO
                        <br> <br>
                        <strong>7.</strong> ANALGESIA DE ACUERDO A LA OMS, INICIAR CON PARACETAMOL 1GR IV CADA 8 HRS
                        <br> <br>
                        <strong>8.</strong> GRACIAS -->
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>



</html>