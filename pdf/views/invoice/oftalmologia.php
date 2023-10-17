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
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Informacón del paciente';
        $subtitulo = 'Reporte de Oftalmologia';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
        include 'includes/header.php';
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        // $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';
        $nombre_doctor = $pie['datos_medicos']['0']['NOMBRE_COMPLETO'];
        $uni = $pie['datos_medicos']['0']['UNIVERSIDAD'];
        $cedula = $pie['datos_medicos']['0']['CEDULA'];

        $footerDoctor = "$nombre_doctor <br>$uni - Cédula profesional: $cedula";




        include 'includes/footer.php';
        ?>
    </div>

    <!-- body -->
    <div class="invoice-content">
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">ANTECEDENTES PERSONALES:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->ANTECEDENTES_PERSONALES; ?> </td>
                </tr>
            </tbody>
        </table>


        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">ANTECEDENTES OFTALMOLÓGICOS:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="respuesta-row"> <?php echo $resultados->ANTECEDENTE_OFTALMOLOGICOS; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">PADECIMIENTO ACTUAL:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="respuesta-row"> <?php echo $resultados->PADECIMIENTO_ACTUAL; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <tr>
                <th class="pregunta-row" style="text-align: center;" colspan="2">AGUDEZA VISUAL SIN CORRECCIÓN TABLA DE SNELLEN</th>
            </tr>
            <tr>
                <td class="respuesta-row" style="text-align: center;">OD</td>
                <td class=" respuesta-row" style="text-align: center;">OI</td>
            </tr>
            <tr>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->OD; ?></td>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->OI; ?></td>
            </tr>
            <tr>
                <td class=" respuesta-row" style="text-align: center;" colspan="2">VISIÓN CERCANA SIN CORRECCIÓN TARJETA DE RESENBAUM: <?php echo $resultados->JAEGER; ?></td>
            </tr>
        </table>

        <table class="table">
            <tr>
                <th class="pregunta-row" style="text-align: center;" colspan="2">AGUDEZA VISUAL CON CORRECCIÓN TABLA DE SNELLEN</th>
            </tr>
            <tr>
                <td class="respuesta-row" style="text-align: center;">OD</td>
                <td class=" respuesta-row" style="text-align: center;">OI</td>
            </tr>
            <tr>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->CON_OD; ?></td>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->CON_OI; ?></td>
            </tr>
            <tr>
                <td class=" respuesta-row" style="text-align: center;" colspan="2">VISIÓN CERCANA CON CORRECCIÓN TARJETA DE RESENBAUM: <?php echo $resultados->CON_JAEGER; ?></td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">REFRACCIÓN:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->REFRACCION; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">PRUEBA ISHIHARA:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->PRUEBA; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">EXPLORACIÓN OFTALMOLÓGICA:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->EXPLORACION_OFTALMOLOGICA; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">FORIAS:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->FORIAS; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">CAMPIMETRÍA POR CONFRONTACIÓN:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->CAMPIMETRIA; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <tr>
                <th class="pregunta-row" style="text-align: center;" colspan="2">PRESIÓN INTRAOCULAR</th>
            </tr>
            <tr>
                <td class="respuesta-row" style="text-align: center;">OD</td>
                <td class=" respuesta-row" style="text-align: center;">OI</td>
            </tr>
            <tr>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->PRESION_INTRAOCULAR_OD; ?></td>
                <td class=" respuesta-row" style="text-align: center;"><?php echo $resultados->PRESION_INTRAOCULAR_OI; ?></td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">DIAGNÓSTICO:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->DIAGNOSTICO; ?> </td>
                </tr>
            </tbody>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th class="pregunta-row">PLAN:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="comentario-row"> <?php echo $resultados->PLAN; ?> </td>
                </tr>
            </tbody>
        </table>

        <?php if ($resultados->OBSERVACIONES) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th class="pregunta-row">OBSERVACIONES:</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="comentario-row"> <?php echo $resultados->OBSERVACIONES; ?> </td>
                    </tr>
                </tbody>
            </table>
        <?php } ?>

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