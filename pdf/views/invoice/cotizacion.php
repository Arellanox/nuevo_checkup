<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de cotización</title>
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
            height: 220px;
            margin-top: 0;
        }

        /* .footer {
            position: fixed;
            bottom: -165px;
            left: 25px;
            right: 25px;
            height: 200px;
            /* background-color: pink; 
        } */

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
$ruta_firma = file_get_contents('../pdf/public/assets/firma_quiroz.png'); //FIRMA_URL
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

                        No. Identificación: <strong style="font-size: 12px;"> <?php echo $encabezado->FOLIO_ELECTRO; ?> </strong>
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
                    </td>
                </tr>
                <tr>
                    <td class="col-left" style="border-bottom: none">
                        <?php echo (isset($encabezado->PASAPORTE)) ? "Pasaporte: <strong>" . $encabezado->PASAPORTE . "</strong>" : ""; ?>
                    </td>
                    <td class="col-center" style="border-bottom: none">
                        Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $encabezado->FECHA_RESULTADO_ELECTRO; ?> </strong>
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
        <!-- <p>Aqui va el encabezado y es el espacio disponible hasta donde llegue el titulo siguiente.</p> -->
    </div>

    <!-- Footer 2 dinamico   -->
    .
    <!-- <div class="footer">
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
                        // if ($preview == 0) {

                        //     echo "<img style='position:absolute; right:25px; margin-top: -48px ' src='data:image/png;base64, " . $encode_firma . "' height='137px'> ";
                        // }
                        ?>
                    </td>
                </tr>
                <tr class="col-foot-three" style="font-size: 13px;">
                    <td colspan="6" style="text-align: center; width: 50%">
                        <?php
                        // if ($preview == 0) {
                        //     echo "<a target='_blank' href='#'> <img src='" . $qr[1] . "' alt='QR Code' width='110' height='110'> </a>";
                        // }
                        ?>
                    </td>
                    <td colspan="6" style="text-align: right; width: 50%; padding-top: 30px; margin-bottom: -25px">
                        <strong style="font-size: 12px;">
                            <?php
                            // echo $pie['datos_medicos'][0]['NOMBRE_COMPLETO'] . '<br> Médico Radiódiologo - ' . $pie['datos_medicos'][0]['UNIVERSIDAD'] . ' - ' . $pie['datos_medicos'][0]['CEDULA'];
                            // $indice = 1;
                            // foreach ($pie['datos_medicos'][0]['ESPECIALIDADES'] as $key => $value) {
                            //     // $contador = count($value);
                            //     $indice++;
                            //     echo '<br>' . $value['CARRERA'] . ' / ' . $value['UNIVERSIDAD'] . ' / '  . $value['CEDULA'] . '<br>';
                            //     echo 'Certificado por: ' . $value['CERTIFICADO_POR'];
                            // }
                            ?>
                             Dra. Zoila Aideé Quiroz Colorado <br>
                            Cédula profesional <br>
                            Radiologia e imagen <br>
                            Subespecialista en radiología pediátrica
                        </strong>
                    </td>
                </tr>
            </tbody>
        </table>
        <hr style="height: 0.5px; background-color: black ;">
        <p style="text-align: center;"><small>
                <strong style="font-size: 11px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong> <br>
                <strong style="font-size: 11px;">Teléfonos: </strong>
                <strong style="font-size: 11px;">993 634 1483, 993 634 0250, 993 634 1469, 993 634 6245</strong>
                <strong style="font-size: 11px;">Correo electrónico:</strong>
                <strong style="font-size: 11px;color: rgb(000, 175, 170); margin-left: -1.5px; margin-right: -1.5px">resultados@</strong>
                <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">bimo-lab</strong>
                <strong style="font-size: 11px;color: rgb(247, 190, 000); margin-left: -1.5px; margin-right: -1.5px">.com</strong>
            </small></p>
    </div> -->


    <!-- body -->
    <!-- <?php ?> -->
    <div class="invoice-content">
        <?php
        $count = 0;
        $conteo = count($resultados->ESTUDIOS);


        echo "<h2 style='padding-bottom: 6px; padding-top: 6px;'>" . $resultados->PRODUCTO . "</h2>";

        echo "<p style='margin-bottom: 0;'><strong>Técnica: </strong>" . $resultados->TECNICA . "</p><br>";
        echo "<h5 style='line-height: 1.5;'>Hallazgos</h5>";
        echo "<p style='line-height: 1.5; margin-top: 1px;'>" . $resultados->HALLAZGO . "</p>";
        echo "<p style='line-height: 1.5'><strong>Interpretación: </strong>" . $resultados->INTERPRETACION . "<br>";
        if ($resultados->COMENTARIO != "" || $resultados->COMENTARIO != null) {
            echo "<strong>Comentario: </strong>" . $resultados->COMENTARIO . "</p><br>";
        }
        $count++;
        if ($count % 2 == 0 && $count < $conteo) {
        ?>
            <div class="break"></div>
        <?php
        }

        ?>
    </div>
</body>
<?php
$altura = 220;

for ($i = 2; $i < $indice; $i++) {
    $altura = $altura + 50;
}
// echo $altura;
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
</style>

</html>