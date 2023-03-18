<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Somatometría y Signos Vitales</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Somatometria</title>

    <style>
        .header {
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            height: 220px;
            margin-top: 0;
            /* background-color: cadetblue; */
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
        }

        h5 {
            font-size: 12.5px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        p {
            font-size: 12px;
        }

        strong {
            font-size: 12px;
        }

        .align-center {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: nowrap;
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
            width: 35%;
            max-width: 35%;
            text-align: left;
            font-size: 12px;
        }

        .col-center {
            width: 35%;
            max-width: 35%;
            text-align: left;
            font-size: 12px;
        }

        .col-right {
            width: 30%;
            max-width: 30%;
            text-align: left;
            font-size: 12px;
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
            text-align: left;
        }

        .col-der {
            width: 70%;
            max-width: 70%;
            text-align: center;
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

        body {
            font-size: 11px;
        }

        .cuartos {
            width: 25%;
        }

        .venticinco {
            width: 25%;
        }

        .setentaycinco {
            width: 75%;
        }

        .footer {
            position: fixed;
            bottom: -40px;
            left: 0px;
            right: 0px;
        }

        .bold {
            font-weight: bold;
        }

        .cursive {
            font-style: italic;
        }

        .rojo {
            color: red;
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
// Verifica si mandan firma o si existe en el arreglo
if (isset($pie['datos_medicos'][0]['FIRMA_URL'])) {
    $ruta_firma = file_get_contents($pie['datos_medicos'][0]['FIRMA_URL']); //AQUI DEBO RECIBIR LA RUTA DE LA FIRMA
    $encode_firma = base64_encode($ruta_firma);
} else {
    $ruta_firma = file_get_contents('../pdf/public/assets/firma_adrian.png'); //AQUI DEBO RECIBIR LA RUTA DE LA FIRMA
    $encode_firma = base64_encode($ruta_firma); #IMPORTANTE RECIBIRLO 
}
// $ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png'); //AQUI DEBO RECIBIR LA RUTA DE LA FIRMA

if (!isset($qr)) {
    $qr = null;
}

?>

<body>
    <div class="container-fluid">
        <div class="container-fluid">
            <table>
                <tbody>
                    <tr>
                        <td class="col-der" style="border-bottom: none">
                            <h4>
                                DIAGNOSTICO BIOMOLECULAR S.A.de C.V. <br>
                                Checkup Clínica y Prevención<br>
                                Reporte de Somatometría
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
            <hr style="height: 3px; background-color: black ;">
            <p style="text-align: center; margin: -4px;"><strong>Biología Molecular</strong></p>
            <hr style="height: 3px; background-color: black ;">
            <br>
            <table style="width: 100%;">
                <tbody>
                    <tr>
                        <td class="col-left" style="border-bottom: none">
                            No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO_OFTALMO; ?> </strong>
                        </td>
                        <td class="col-center" style="border-bottom: none">
                            Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD; ?> años</strong>
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
                            Fecha de Nacimiento: <strong style="font-size: 12px;"> <?php echo $encabezado->NACIMIENTO; ?> </strong>
                        </td>
                        <td class="col-right" style="border-bottom: none">
                        </td>
                    </tr>
                    <tr>
                        <td class="col-left" style="border-bottom: none">
                            <?php echo (isset($encabezado->PASAPORTE)) ? "Pasaporte: <strong>" . $encabezado->PASAPORTE . "</strong>" : ""; ?>
                        </td>
                        <td class="col-center" style="border-bottom: none">
                            Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $encabezado->FECHA_RESULTADO_OFTALMO; ?> </strong>
                        </td>
                        <td class="col-right" style="border-bottom: none">
                            <!-- Tipo de Muestra: <strong>Sangre</strong> -->
                        </td>
                    </tr>
                    <tr>
                        <td class="col-left" style="border-bottom: none">
                            Procedencia: <strong style="font-size: 12px;"><?php echo $encabezado->PROCEDENCIA; ?> </strong>
                        </td>
                        <td class="col-center" style="border-bottom: none">
                            <?php echo isset($encabezado->MEDICO_TRATANTE) ? "Médico Tratante: <strong style='font-size: 12px;'>" . $encabezado->MEDICO_TRATANTE . "</strong>" : ""; ?>
                        </td>
                        <td class="col-right" style="border-bottom: none">
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- <p style="background-color: darkgrey; padding: 5px;text-align: center;"><strong>INFORMACIÓN CLÍNICA</strong></p> -->
            <br>
            <div>
                <table style="width: 100%; border-collapse: collapse; text-align: center;">
                    <tr style="background-color: darkgrey;" class="bold">
                        <td colspan="12" style="text-justify: left;">SOMATOMETRíA Y SIGNOS VITALES</td>
                    </tr>
                    <tr>
                        <td colspan="12">&nbsp;</td>
                    </tr>
                    <tr style="background-color: darkgrey;" class="bold">
                        <td colspan="12" style="text-align: left;">SOMATOMETRíA</td>
                    </tr>
                    <!--Somatometría-->
                    <table style="width: 100%; border-collapse: collapse; text-align: center;">
                        <tr>
                            <td colspan="12">&nbsp;</td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive"> Estatura </td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->ESTATURA; ?> </strong>
                            </td>
                            <td colspan="3" style="text-align: left;" class="cursive">Metabolismo</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->METABOLISMO; ?> </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive">Peso</td>
                            <td colspan="1" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->PESO; ?> </strong>
                            </td>
                            <td colspan="2"></td>
                            <td colspan="3" style="text-align: left;" class="cursive">Edad del cuerpo</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->EDAD_DEL_CUERPO; ?> </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive">Masa corporal</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->MASA_CORPORAL; ?> kg/m2</strong>
                            </td>
                            <td colspan="3" style="text-align: left;" class="cursive">Perímetro cefálico</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->PERIMETRO_CEFALICO; ?> cm</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive">Masa muscular</td>
                            <td colspan="1" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->MASA_MUSCULAR; ?> ms</strong>
                            </td>
                            <td colspan="2"></td>
                            <td colspan="3" style="text-align: left;" class="cursive">Porcentaje de proteínas</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->PORCENTAJE_PROTEINAS; ?> %</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive">Porcentaje de grasa viseral</td>
                            <td colspan="1" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->PORCENTAJE_GRASA_VISERAL; ?> %</strong>
                            </td>
                            <td colspan="2"></td>
                            <td colspan="3" style="text-align: left;" class="cursive">Porcentaje de agua</td>
                            <td colspan="3" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->PORCENTAJE_AGUA; ?> %</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: left;" class="cursive">Huesos</td>
                            <td colspan="1" style="text-align: left;">
                                <strong style="font-size: 12px;"><?php echo $resultados->HUESOS; ?> hs</strong>
                            </td>
                            <td colspan="12">&nbsp;</td>
                        </tr>
                        <!--signos vitales-->
                        <tr style="background-color: darkgrey;" class="bold">
                            <td colspan="12" style="text-align: left;">SIGNOS VITALES</td>
                        </tr>
                        <tr>
                            <td colspan="12">&nbsp;</td>
                        </tr>
                    </table>

</body>

</html>