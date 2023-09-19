<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de interpretación de Historia Clinica</title>
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
        bottom: -195px;
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
        font-size: 12px;
        line-height: 1;
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
        /* Elimina el espacio entre celdas */
    }

    .img-audiometria th,
    .img-audiometria td {
        border: 1px solid black;
        /* Borde para celdas */
        padding: 8px;
        text-align: center;
    }

    .img-audiometria th {
        background-color: #e1e6ea;
        /* Color de fondo de los encabezados */
        color: black;
        /* Color de texto de los encabezados */
    }

    .img-audiometria img {
        max-width: 100%;
        height: auto;
    }
    </style>
</head>

<?php

// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
$encode_firma = base64_encode($ruta_firma);


?>

<body>
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Información del paciente';
        $subtitulo = 'Audiometría Tonal Aérea';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
        include 'includes/header.php';
        ?>
    </div>

    <div class="footer">
        <?php
        $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';

        include 'includes/footer.php';
        ?>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <!-- ANTECEDENTES  -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES </h2>
        <table class="table-ant">
            <tr>
                <th class="th"><?php echo $resultados->ANTECEDENTES[0]->ANTECEDENTE;  ?></th>
                <th class="th"><?php echo $resultados->ANTECEDENTES[1]->ANTECEDENTE;  ?></th>
            </tr>
            <tr>
                <td class="td"><?php echo imprimirAntecedentes($resultados->ANTECEDENTES[0]); ?></td>
                <td class="td"><?php echo imprimirAntecedentes($resultados->ANTECEDENTES[1]); ?></td>
            </tr>
            <tr>
                <th class="th"><?php echo $resultados->ANTECEDENTES[2]->ANTECEDENTE;  ?></th>
                <th class="th"><?php echo $resultados->ANTECEDENTES[3]->ANTECEDENTE;  ?></th>
            </tr>
            <tr>
                <td class="td"><?php echo imprimirAntecedentes($resultados->ANTECEDENTES[2]); ?></td>
                <td class="td"><?php echo imprimirAntecedentes($resultados->ANTECEDENTES[3]); ?></td>
            </tr>
        </table>

        <!-- TABLA DE AUDIOMETRIA TONAL -->
        <div class="tonal">
            <h2 style="padding-bottom: 6px; padding-top: 6px;">AUDIOMETRÍA</h2>
            <p>
                Se realiza audiometría aérea, con los siguientes datos:
            </p>
            <?php
            $columnas = obtenerColumnas($resultados->AUDIOMETRIA->OD);
            $audiometria = json_decode(json_encode($resultados->AUDIOMETRIA));
            // order las frecuencias de menor a mayor
            usort($columnas, 'compararFrecuencias');

            echo '<table class="table-tonal">';
            echo '<tr>';
            echo '<th class="th-tonal">Oído</th>';
            foreach ($columnas as $frecuencia) {
                echo '<th class="th-tonal">' . $frecuencia . '</th>';
            }
            echo '</tr>';

            foreach ($audiometria as $oido => $datos) {
                echo '<tr>';
                echo '<td class="td-tonal">' . $oido . '*</td>';
                // Ordenar los datos según las frecuencias ordenadas
                foreach ($columnas as $frecuencia) {
                    echo '<td class="td-tonal">' . ((array)$datos)[$frecuencia] . '</td>';
                }
                echo '</tr>';
            }

            echo '</table>';
            ?>
            <p style="margin: 5px 0px 0px 0px;">*Valores en decibeles (dB)</p>

        </div>

        <!-- GRAFIA  -->
        <div class="div-grafica" style="text-align: center;">

            <?php
            // var_dump( $resultados );
            echo "<img src='data:image/png;base64, " . file_get_contents($resultados->GRAFICA) . "' height='300' >";
            // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
            ?>
            <br>
        </div>

        <!-- Nueva hoja -->
        <!-- <div class="break"></div> -->
        <?php
        $ruta = file_get_contents($resultados->CAPTURA_OIDOS[0]->CAPTURA_DER);
        $encode = base64_encode($ruta);
        $ruta = file_get_contents($resultados->CAPTURA_OIDOS[0]->CAPTURA_IZQ);
        $encode2 = base64_encode($ruta);
        ?>

        <!-- Otoscopía -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">Otoscopía </h2>
        <p> <?php echo $resultados->OTOSCOPIA; ?> </p>

        <!-- Capturas de oidos -->
        <table class="img-audiometria" style="margin: 0 auto; border-collapse: collapse;">
            <tr>
                <th>Oído Derecho</th>
                <th>Oído Izquierdo</th>
            </tr>
            <tr>
                <td><img src="data:image/jpg;base64,<?php echo $encode; ?>" alt="Oído Derecho" width='190' height='190'>
                </td>
                <td><img src="data:image/jpg;base64,<?php echo $encode2; ?>" alt="Oído Izquierdo" width=' 190'
                        height='190'></td>
            </tr>
            <tr>
                <td><?php echo $resultados->RESULTADO_OD; ?></td>
                <td><?php echo $resultados->RESULTADO_OI; ?></td>
            </tr>
        </table>

        <br>

        <table style="margin: 0 auto; border-collapse: collapse; border: 1px solid #000; width: 60%;">
            <tr>
                <td colspan="2" align="center" style="background-color: #e1e6ea; border: 1px solid #000;">
                    <strong>Comentario</strong>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center" style="border: 1px solid #000;"><?php echo $resultados->COMENTARIOS; ?>
                </td>
            </tr>
            <tr>
                <td style="background-color: #e1e6ea; text-align: center; border: 1px solid #000; width: 50%;">Oído
                    derecho</td>
                <td style="background-color: #e1e6ea; text-align: center; border: 1px solid #000; width: 50%;">Oído
                    izquierdo</td>
            </tr>
            <tr>
                <td style="border: 1px solid #000; text-align: center;"><?php echo $resultados->COMENTARIOS_OD; ?></td>
                <td style="border: 1px solid #000; text-align: center;"><?php echo $resultados->COMENTARIOS_OI; ?></td>
            </tr>
        </table>











        <p><strong>Recomendaciones:</strong></p>
        <p> <?php echo $resultados->RECOMENDACIONES; ?></p>

    </div>

</body>



</html>

<?php
function imprimirAntecedentes($item)
{
    return ($item->RESPUESTA == "No" ? $item->RESPUESTA : $item->RESPUESTA . ", " . $item->COMENTARIO) . ".";
}

function compararFrecuencias($a, $b)
{
    $frecuenciaA = (int) filter_var($a, FILTER_SANITIZE_NUMBER_INT);
    $frecuenciaB = (int) filter_var($b, FILTER_SANITIZE_NUMBER_INT);
    return $frecuenciaA - $frecuenciaB;
}

function obtenerColumnas($array)
{
    $x = [];
    foreach ($array as $frecuencia => $valor) {
        array_push($x, $frecuencia);
    }

    return $x;
}



?>