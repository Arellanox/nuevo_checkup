<html>
<?php


?>
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
            top: -180px;
            left: 30px;
            right: 25px;
            height: 230px;
            margin-top: 0;
            /* background-color: red; */
        }

        .header p {
            font-size: 14px !important;
        }

        .footer {
            position: fixed;
            bottom: -210px;
            left: 20px;
            right: 20px;
            height: 220px;
            padding-top: 30px;
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

        /* Para divisiones de 2 encabezado*/
        .col-two-left {
            width: 50%;
            max-width: 50%;
            text-align: left;
            font-size: 11px;
            float: left;
            margin-right: 1px;
        }

        .col-two-right {
            width: 50%;
            max-width: 50%;
            text-align: left;
            font-size: 11px;
            float: right;
            margin-left: 1px;
        }

        .col-two-left p {
            margin-top: 0;
            margin-bottom: 0;
        }

        .col-two-right p {
            margin-top: 0;
            margin-bottom: 0;
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

        .content-table{
            width: 100%;
        }

        .table-pacientes {
            border-collapse: collapse;
            color: #215868;
        }

        .table-pacientes th,
        .table-pacientes td {
            border: 1px solid black;
            padding: 1px;
            text-align: center;
            font-size: 11.5px;
        }

        .table-pacientes thead th {
            background-color: #f2f2f2;
        }

        .table-pacientes tbody td {
            
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .small-width {
            width: 12px;
            max-width: 50px;
            text-align: center;
        }

        .big-width {
            width: 250px;
            max-width: 300px;
        }

        .muestra-width {
            width: 100px;
            max-width: 200px;
        }

        .prefolio-width{
            width: 0px;
            max-width: 150px;
        }

        .edad-width{
            width: 40px;
            max-width: 200px;
        }

        .estudio-width{
            width: 180px;
            max-width: 200px;
        }

        .sin-dato {
            color: #18343e;
            font-style: italic;
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
        <?php include 'includes/header_envioMuestras.php'; ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        // $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';

        include 'includes/footer_envioMuestras.php';

        ?>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <div class="content-table">
            <table class="table-pacientes">
                <thead>
                    <tr>
                        <th class="small-width">No.</th>
                        <th class="prefolio-width">Prefolio</th>
                        <th class="big-width">Nombre del Paciente</th>
                        <th class="muestra-width">Fecha de Nacimiento</th>
                        <th class="edad-width">Edad</th>
                        <th>Sexo</th>
                        <th class="muestra-width">Tipo de Muestra</th>
                        <th>Fecha de Toma</th>
                        <th class="estudio-width">Estudio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ((array)$resultados->DETALLE as $item): ?>
                        <tr>
                            <td class="small-width"><?php echo $item->COUNT ?></td>
                            <td class="prefolio-width"><?php echo $item->PREFOLIO ?></td>
                            <td><?php echo $item->PACIENTE; ?></td>
                            <td class="muestra-width"><?php echo $item->NACIMIENTO; ?></td>
                            <td class="edad-width"><?php echo $item->EDAD; ?></td>
                            <td><?php echo $item->SEXO; ?></td>
                            <td class="muestra-width <?= empty($item->MUESTRA) ? 'sin-dato' : '' ?>">
                                <?= !empty($item->MUESTRA) ? $item->MUESTRA : '---' ?>
                            </td>
                            <td class="<?= empty($item->MUESTRA) ? 'sin-dato' : '' ?>">
                                <?= !empty($item->FECHA_TOMA) ? $item->FECHA_TOMA : '---' ?>
                            </td>
                            <td class="estudio-width <?= empty($item->MUESTRA) ? 'sin-dato' : '' ?>">
                                <?= !empty($item->ESTUDIOS) ? $item->ESTUDIOS : '---' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>


    </div>
</body>



</html>