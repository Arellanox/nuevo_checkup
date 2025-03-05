<!DOCTYPE html>
<html lang="en">

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
            /* margin-top: 80px; */
            margin-bottom: 40px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            height: auto;
            margin-top: 0;
        }

        .footer {
            position: fixed;
            bottom: -300px;
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
    </style>
</head>

<?php
    $ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
    $encode = base64_encode($ruta);

    $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
    $encode_firma = base64_encode($ruta_firma);

    $REPOSICION = $resultados[0];
    $DETALLES = $resultados[1];
?>

<body>
    <div class="header">
        <?php
            $titulo = 'DIAGNOSTICO BIOMOLECULAR';
            $tituloPersonales = 'Laboratorio de Biología Molecular';
            $subtitulo = 'Requisición Maquilas';
            $encabezado->CREACION = $REPOSICION[0]->FECHA_REQUISICION;
            $encabezado->FOLIO = $REPOSICION[0]->FOLIO;
            $encabezado->ESTADO = $REPOSICION[0]->ESTADO;
            $encabezado->RESPONSABLE = $REPOSICION[0]->RESPONSABLE;

            include 'includes/header_requisicion.php';
        ?>
    </div>
    
    <div class="invoice-content">
        <?php if (isset($DETALLES) && !empty($DETALLES)): ?>
            <table class="result" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
                <thead>
                    <tr style="text-align: left; border-top: 1.7px solid #000 ; border-bottom: 1.7px solid #000;">
                        <th style="padding: 8px; text-align: left;">Paciente</th>
                        <th style="padding: 8px; text-align: left">Servicio</th>
                        <th style="padding: 8px; text-align: left">Laboratorio</th>
                        <th style="padding: 8px; text-align: left">Motivo de Rechazo</th>
                        <th style="padding: 8px; text-align: left">Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($DETALLES as $item): ?>
                        <tr style="border-bottom: .2px solid #000;">
                            <td style="padding: 10px;"><?= htmlspecialchars($item->PACIENTE) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($item->SERVICIO) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($item->LABORATORIO) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($item->MOTIVO_RECHAZO) ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($item->RESPONSABLE) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p style="text-align: center; color: #000;">No hay detalles disponibles.</p>
        <?php endif; ?>
    </div>

    <div class="footer">
        <?php include 'includes/footer_simple.php'; ?>
    </div>
</body>

</html>