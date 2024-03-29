<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de interpretación de Oftalmologia</title>
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
            top: -165px;
            left: 25px;
            right: 25px;
            height: 235px;
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
            width: 42%;
            max-width: 42%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-center {
            width: 41%;
            max-width: 41%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 17%;
            max-width: 17%;
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

        .table {
            margin-top: 1px !important;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
        }

        .table>tr,
        .table>tr>td {
            text-align: left;
            padding: 5px !important;
            border-bottom: 1px solid #ddd;

        }

        .table>tr {
            background-color: #f2f2f2;
        }

        .pregunta-row {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 3px;
            text-align: left;
            font-size: 10px;
        }

        .respuesta-row,
        .comentario-row {
            background-color: #fff;
            padding: 2px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 9px;
        }

        .respuesta2-row {
            background-color: #fff;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 11px;
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
    <div class="header">
        <br>
        <table>
            <tbody>
                <tr>
                    <td class="col-der" style="border-bottom: none">
                        <h4>
                            DIAGNÓSTICO BIOMOLECULAR S.A.de C.V. <br>
                            Checkup Clínica y Prevención<br>
                            Reporte de Oftalmologia
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
                            Datos del paciente
                        </h3>
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="col-left" style="border-bottom: none">
                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO_OFTALMO; ?> </strong>
                    </td>
                    <td class="col-center" style="border-bottom: none">
                        Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD; ?></strong>
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
                        Pasaporte: <strong style='font-size:12px'> <?php echo (isset($encabezado->PASAPORTE) && !empty($encabezado->PASAPORTE)) ? $encabezado->PASAPORTE : "SD"; ?>
                    </td>
                </tr>
                <tr>
                    <td class="col-left" style="border-bottom: none">
                        Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $encabezado->FECHA_RESULTADO_OFTALMO; ?> </strong>
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
                    <td class="col-center" style="border-bottom: none">
                    </td>
                    <td class="col-right" style="border-bottom: none">
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
            <?php echo (isset($encabezado->MEDICO_TRATANTE) || !empty($encabezado->MEDICO_TRATANTE)) ? "Médico Tratante: <strong style='font-size: 10px;'>" . $encabezado->MEDICO_TRATANTE . "</strong>" : ""; ?> </strong>
        </p>
        <!-- <p>Aqui va el encabezado y es el espacio disponible hasta donde llegue el titulo siguiente.</p> -->

    </div>

    <!-- Oftalmologia se necesita volverlo hacer -->
    <div class="footer">
        <table>
            <tbody>
                <tr class="col-foot-one">
                    <td colspan="12" style="text-align: right; padding-right: 0;"><strong style="font-size: 12px;">Atentamente</strong></td>
                </tr>
                <tr class="col-foot-two">
                    <td colspan="10">
                    </td>
                    <td colspan="2" style="text-align: left;">
                        <?php
                        if ($preview == 0) {
                            echo "<img style='position:absolute; right:5px; margin-top: -48px ' src='data:image/png;base64, " . $encode_firma . "' height='137px'> ";
                        }
                        ?>
                    </td>
                </tr>
                <tr class="col-foot-three" style="font-size: 13px;">
                    <td colspan="6" style="text-align: center; width: 50%">
                        <?php
                        if ($preview == 0) {           # $qr[0]
                            echo "<a target='_blank' href='" . $validacion . "'> <img src='" . $qr[1] . "' alt='QR Code' width='110' height='110'> </a>";
                        }
                        ?>
                    </td>
                    <td colspan="6" style="text-align: right; width: 50%; padding-top: 30px; margin-bottom: -25px">
                        <strong style="font-size: 10px;">
                            <?php
                            echo $pie['datos_medicos'][0]['NOMBRE_COMPLETO'] . '<br>' . $pie['datos_medicos'][0]['CARRERA'] . ' - ' . $pie['datos_medicos'][0]['UNIVERSIDAD'] . ' - ' . $pie['datos_medicos'][0]['CEDULA'];
                            $indice = 1;
                            foreach ($pie['datos_medicos'][0]['ESPECIALIDADES'] as $key => $value) {
                                $indice++;
                                echo '<br>' . $value['CARRERA'] . ' / ' . $value['UNIVERSIDAD'] . ' / '  . $value['CEDULA'] . '<br>';
                                echo 'Certificado por: ' . $value['CERTIFICADO_POR'];
                            }
                            ?>

                            <?php
                            // echo $pie['datos_medicos'];
                            ?>
                            <!-- Dra. Zoila Aideé Quiroz Colorado <br> 
                            Universidad - Cedula <br>
                            Radiologia / Universidad / Cedula <br>
                            Certificado por: Quien certifica <br>
                            Subespecialista en radiología pediátrica / Universidad / Cedula<br>
                            Certificado por: escuela de doctores <br> -->
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="height: 0.5px; background-color: black ;">
        <p style="text-align: center;"><small>
                <strong style="font-size: 11px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong> <br>
                <strong style="font-size: 11px;">Teléfonos: </strong>
                <strong style="font-size: 11px;">993 634 0250, 993 634 6245</strong>
                <strong style="font-size: 11px;">Correo electrónico:</strong>
                <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">resultados@</strong>
                <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">bimo-lab</strong>
                <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">.com</strong>
            </small></p>
    </div>

    <!-- body -->
    <div class="invoice-content">

        <p>
            <strong>
                ANTECEDENTES PERSONALES
            </strong>
            <br>

            <?php echo $resultados->ANTECEDENTES_PERSONALES; ?> <br>
        </p>

        <p><strong>ANTECEDENTES OFTALMOLÓGICOS</strong>
            <br>
            <?php echo $resultados->ANTECEDENTE_OFTALMOLOGICOS; ?>
        </p>

        <p>
            <strong>
                PADECIMIENTO ACTUAL.
            </strong>
            <br>
            <?php echo $resultados->PADECIMIENTO_ACTUAL; ?><br>

        </p>


        <p>
            <strong>
                AGUDEZA VISUAL SIN CORRECCIÓN TABLA DE SNELLEN
            </strong>
            <?php //echo $resultados->AGUDEZA_VISUAL; //_CON 
            ?> <br>
            <strong>
                OD:
            </strong>
            <?php echo $resultados->OD; ?><br>
            <strong>
                OI:
            </strong>
            <?php echo $resultados->OI; ?> <br>
            <strong>
                VISIÓN CERCANA SIN CORRECCIÓN TARJETA DE RESENBAUM:
            </strong>
            <?php echo $resultados->JAEGER; ?> <br>
        </p>


        <p>
            <strong>
                AGUDEZA VISUAL CON CORRECCIÓN TABLA DE SNELLEN
            </strong>
            <?php //echo $resultados->AGUDEZA_VISUAL_CON_CORRECCION; //_CON 
            ?> <br>
            <strong>
                OD:
            </strong>
            <?php echo $resultados->CON_OD; ?><br>
            <strong>
                OI:
            </strong>
            <?php echo $resultados->CON_OI; ?> <br>
            <strong>
                VISIÓN CERCANA CON CORRECCIÓN TARJETA DE RESENBAUM:
            </strong>
            <?php echo $resultados->CON_JAEGER; ?> <br>
        </p>


        <p>
            <strong>
                REFRACCIÓN:
            </strong>
            <?php echo "$resultados->REFRACCION"; ?>
        </p>


        <p>
            <strong>
                PRUEBA ISHIHARA:
            </strong>
            <?php echo $resultados->PRUEBA; ?>

        </p>


        <p>
            <strong>
                EXPLORACIÓN OFTALMOLÓGICA:
            </strong>
            <br>
            <?php echo $resultados->EXPLORACION_OFTALMOLOGICA; ?>
        </p>


        <p>
            <strong>
                FORIAS:
            </strong>
            <?php echo $resultados->FORIAS; ?>

        </p>

        <p>
            <strong>
                CAMPIMETRÍA POR CONFRONTACIÓN:
            </strong>
            <?php echo $resultados->CAMPIMETRIA; ?>
        </p>

        </table>
        <p>
            <strong>
                PRESIÓN INTRAOCULAR
            </strong>
            <br>
            <strong>
                OD:
            </strong>
            <?php echo $resultados->PRESION_INTRAOCULAR_OD ?>
            <strong>
                OI:
            </strong>
            <?php echo $resultados->PRESION_INTRAOCULAR_OI ?>
        </p>


        <p>
            <strong>
                DIAGNÓSTICO.
            </strong>
            <br>
            <?php echo $resultados->DIAGNOSTICO ?>
        </p>


        <p>
            <strong>
                PLAN:
            </strong>
            <?php echo " $resultados->PLAN" ?>
        </p>

        <p>
            <?php if ($resultados->OBSERVACIONES) { ?>
                <strong>
                    OBSERVACIONES:
                </strong>
            <?php echo " $resultados->OBSERVACIONES";
            } ?>
        </p>
    </div>
</body>

<?php
$altura = 200;

for ($i = 2; $i < $indice; $i++) {
    $altura = $altura + 50;
}
?>
<style>
    .footer {
        position: fixed;
        bottom: -165px;
        left: 25px;
        right: 25px;
        height: <?php echo $altura . 'px' ?>;
        /* background-color: pink; */
    }

    a {
        position: fixed;
        padding: 0px;
        top: -15px;
        left: 40px
    }
</style>

</html>