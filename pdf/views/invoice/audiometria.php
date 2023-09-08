<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe audiometría</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Somatometria</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 10px;
        }

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

        .td-border-vertical {
            border-right: 1px solid black;
            border-left: 1px solid black;
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

        .content {
            border-radius: 3px;
            background-color: #f7be16;
        }

        .rojo {
            color: red;
        }

        .rounded {
            border-radius: 5px;
            /*border: 1px solid transparent;*/
            /*border-bottom: 1px solid transparent;*/
            /*border-bottom: none;*/
            border-spacing: 0;
        }

        .rounded2 {
            border-radius: 5px;
            border: 1px solid darkgrey;
            /*border-bottom: 1px solid darkgrey;*/
            border-spacing: 0;
        }

        .colored-cell {
            border-top: 0px solid darkgrey;
            border-right: 0px solid darkgrey;
            border-bottom: 1px solid darkgrey;
            border-left: 1px solid darkgrey;
        }

        .cell {
            border-top: 0px solid darkgrey;
            border-right: 0px solid darkgrey;
            border-bottom: 1px solid white;
            border-left: 1px solid darkgrey;
        }

        .esquina-inferior {
            border-radius: 5px;
            border: 0px solid darkgrey;
            border-bottom: 0px solid darkgrey;
            border-spacing: 0;

        }

        .bordes-detalle {
            border-width: 6px 6px 6px 6px;
            border-color: red green blue yellow;
            border-style: solid;
        }

        .bordes-detalle2 {
            border-width: 1px 1px 1px 1px;
            border-color: transparent darkgrey darkgrey transparent;
            border-style: solid;
        }

        .bordes-detalle3 {
            border-width: 3px 3px 3px 3px;
            border-color: red blue green pink;
            border-style: solid;
        }

        .vertical-line {
            border-left: 1px solid black;
            height: 100px;
        }

        .header {
            color: black;
            padding: 2px;
            text-align: center;
            position: fixed;
            top: 0;
            width: 93%;
        }

        .foot {
            color: black;
            padding: 30px;
            text-align: center;
            position: fixed;
            top: 645;
            width: 93%;
        }

        .footer {
            position: fixed;
            bottom: -100px;
            left: 25px;
            right: 25px;
            height: 200px
        }

        .margen {
            background-color: #f7be16;
            bottom: -100px;
            left: 25px;
            right: 25px;
            height: 200px
        }

        .espacio {
            margin-top: 2px;
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
    $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png'); //AQUI DEBO RECIBIR LA RUTA DE LA FIRMA
    $encode_firma = base64_encode($ruta_firma); #IMPORTANTE RECIBIRLO 
}
// $ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png'); //AQUI DEBO RECIBIR LA RUTA DE LA FIRMA

if (!isset($qr)) {
    $qr = null;
}

?>

<body>
    <div style=" font-size: 9;" class="header">
        <table>
            <tbody>
                <tr>
                    <td class="col-der" style="border-bottom: none; text-align: left;">
                        <h1>INFORME AUDIOMETRÍA</h1>
                    </td>
                    <td class="col-izq" style="border-bottom: none; text-align:center;">
                        <?php
                        echo "<img src='data:image/png;base64, " . $encode . "' height='80' >";
                        // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                        ?>

                    </td>
                </tr>

            </tbody>
        </table>
        <div>
            <table style="width: 100%; border-collapse: collapse; text-align: left; align-items: center;" border="2" colspan="4">
                <tbody>
                    <tr>
                        <td style="width: 100%; text-align: center; background-color: #d8e0e2;" colspan="4"><b>INFORMACIÓN DEL PACIENTE</b></td>
                    </tr>
                    <tr>
                        <td style="width: 20%;" colspan="1"><b>Nombre:</b></td>
                        <td style="width: 80%;" colspan="3"><b><?php echo $encabezado->NOMBRE; ?></b></td>
                    </tr>
                    <tr>
                        <td style="width: 40%;" colspan="2"><b>Fecha de nacimiento:</b></td>
                        <td style="width: 30%;" colspan="1"><b>Edad:</b> <?php echo $encabezado->EDAD < 1 ? ($encabezado->EDAD * 10) . " meses" : $encabezado->EDAD . " años"; ?></td>
                        <td style="width: 30%;" colspan="1"><b>Género:</b> <?php echo $encabezado->SEXO; ?></td>

                    </tr>
                    <tr>
                        <td style="width:50%;" colspan="2"><b>Fecha de realización del estudio:</b></td>
                        <td style="width:50%;" colspan="2"><b>Fecha de resultado:</b> <?php echo $encabezado->FECHA_RESULTADO_MESO; ?></td>
                    </tr>
                    <tr>
                        <td style="width:30%" colspan="1"><b>Checkup:</b></td>
                        <td style="width:70%" colspan="3"><b>Tipo estudio:</b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--<p style="font-size: 12px; padding-left: 3.5px; margin: -1px
        ; margin-top: 5px">
            <?php // echo (isset($encabezado->MEDICO_TRATANTE) || !empty($encabezado->MEDICO_TRATANTE)) ? "Médico Tratante: <strong style='font-size: 10px;'>" . $encabezado->MEDICO_TRATANTE . "</strong>" : ""; 
            ?> </strong>
        </p>
         COMENTAR ESTA LINEA<p style="background-color: darkgrey; padding: 5px;text-align: center;"><strong>INFORMACIÓN CLÍNICA</strong></p> 
        <br>-->
    </div>

    <div class="espacio">
        <div style="width: 93%;padding-top: 200px; border-top-width: 80px; font-size: 10;margin: 0px 0px 10px 28px">
            <div>
                <table>
                    <tr>
                        <td><b>Antecedentes:</b></td>
                    </tr>
                    <tr>
                        <td>Niega tabaquismo, refiere exposición laboral a ruido y a solventes, niega antecedentes traumáticos<br></td>
                    </tr>
                    <tr style="line-height: 2;">
                        <td><b>Audiometría:</b></td>
                    </tr>
                    <tr>
                        <td>Se realiza audiometría aérea, con los siguientes datos:<br></td>
                    </tr>
                </table>
            </div>
            <br>
            <strong>
                <table style="width: 100%; text-align: center;border-collapse: collapse; margin: 0px 0px 0px 2px;" border="2">
                    <tr style="background-color: #f7be16;">
                        <td> Oído </td>
                        <td>500 Hz</td>
                        <td>1 000 Hz </td>
                        <td>2 000 Hz </td>
                        <td>3 000 Hz </td>
                        <td>4 000 Hz </td>
                        <td>6 000 Hz </td>
                        <td>8 000 Hz </td>
                    </tr>
                    <tr>
                        <td style="background-color: #d8e0e2;"> OD* </td>
                        <td>5 </td>
                        <td>5 </td>
                        <td>5 </td>
                        <td>5 </td>
                        <td>5 </td>
                        <td>5 </td>
                        <td>5 </td>
                    </tr>
                    <tr>
                        <td style="background-color: #d8e0e2;"> Oi* </td>
                        <td>10 </td>
                        <td>10 </td>
                        <td>10 </td>
                        <td>10 </td>
                        <td>10 </td>
                        <td>10 </td>
                        <td>10 </td>
                    </tr>
                </table>
            </strong>
            <p style="margin: -1px 0px 0px 50px;">*Valores en decibeles (dB)</p>
        </div>
        <div style="width: 93%;padding-top: 20px; border-top-width: 80px; font-size: 10;margin: 0px 0px 10px 28px; font-size: 10;">

            <table>
                <tbody>
                    <tr>
                        <td><strong>Otoscopia:</strong></td>
                    </tr>
                    <tr>
                        <td>Ambos pabellones auriculares sin alteraciones.</td>
                    </tr>
                    <tr style="line-height: 2; color: white;">
                        <td>.</td>
                    </tr>
                    <tr>
                        <td>
                            <table style="width: 99%; text-align: center;border-collapse: collapse; margin: 0px 0px 0px 2px;" border="2">
                                <tr style="background-color: #78cece;">
                                    <td><strong> Oído derecho </strong></td>
                                    <td><strong> Oído izquierdo </strong></td>
                                </tr>
                                <tr>
                                    <td>Conducto auditivo externo normal. Membrana timpánica sin alteraciones Otoscopia norma</td>
                                    <td>Conducto auditivo externo normal Tapón de cerumen </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr style="line-height: 2; color: white;">
                        <td>.</td>
                    </tr>
                    <tr style="line-height: 2;">
                        <td><strong>Comentarios:</strong> Audiometría tonal </td>
                    </tr>
                    <tr style="line-height: 2;">
                        <td><strong>Oido derecho:</strong> Audición normal</td>
                    </tr>
                    <tr style="line-height: 2;">
                        <td><strong>Oido izquierdo:</strong> </td>
                    </tr>
                    <tr>
                        <td><strong> Recomendaciones:</strong></td>
                    </tr>
                    <tr>
                        <td>Uso de protección auditiva, evitar inhalación de solventes y evitar medicamentos que dañen la
                            audición (ototóxicos): amikacina, garamicina, gentamicina. </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div style="display: flex; justify-content: space-between; flex-basis: auto; align-content: center;" border="2" class="foot">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <table style="width: 110%; border-collapse: collapse; text-align: left; margin: -1px 0px 0px 0px;font-size: 9;">
                                <tbody>
                                    <tr>
                                        <td><strong>Diagnóstico Biomolecular S.A de C.V</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Administración</strong></td>
                                        <td><strong>Laboratorio-Clinica checkups</strong></td>
                                    </tr>
                                    <tr>
                                        <td>Blvd Adolfo Ruíz Cortines 1344, Piso 2 Suite 245 Col. Tabasco 2000</td>
                                        <td>Av. Jóse Pagés Llergo #150. Col. Arboledas</td>
                                    </tr>
                                    <tr>
                                        <td>C.P.86079 Villahermosa, Centro Tabasco.</td>
                                        <td>C.P 86035 Villahermosa, Centro Tabasco.</td>
                                    </tr>
                                    <tr>
                                        <td><strong>hola</strong>@bimo.com.mx | Tel: <strong>993 500029</strong></td>
                                        <td><strong>hola</strong>@bimo.com.mx | Tel: <strong>9936 340250</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <hr style="width: 300px;align-items:flex-start;">
            Dra. LeonorAlvarado-Cortés
            Médico- UJA 5849462
            Certified Occupational Hearing Conservationist
            CAOHC ID NUMBER: 516334
        </div>
    </div>
</body>
</body>

<?php
$altura = 200;

?>

</html>