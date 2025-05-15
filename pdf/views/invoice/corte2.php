<html>

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Laboratorio Biomolecular</title>
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
            margin-bottom: -100px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            /* background-color: red; */
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            margin-top: 0;
            /* margin-bottom: 600px; */
        }



        #qr a {
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
            /* padding-top: 100px; */
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
            margin: 0px;
            padding: 5px;
            font-size: 12px;
        }


        #invoice-content p {
            padding: 10px !important;

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
            width: 35%;
            max-width: 35%;
            text-align: left;
            font-size: 12px;
        }

        .col-center {
            width: 5%;
            max-width: 5%;
            text-align: left;
            font-size: 12px;
        }

        .col-right {
            width: 60%;
            max-width: 60%;
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
    </style>
    <style>
        #tipos_pagos {
            margin-top: 10px;
        }

        .my {
            padding: 4px;
        }

        .td-border-my {
            /* border-top: 1px solid black !important; */
            border-bottom: 1px solid darkgrey !important;
        }
    </style>
    <style>
        #invoice-content table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 10px;
        }

        #invoice-content th,
        #invoice-content td {
            text-align: left;
            padding: 8px;
        }

        #invoice-content th {
            background-color: darkgrey;
            font-weight: bold;
            text-align: center;
        }

        #invoice-content tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #invoice-content .total {
            font-weight: bold;
            text-align: right;
        }

        #invoice-content .desglose {
            font-size: 10px;
            font-weight: normal;
        }
    </style>
</head>

<?php

// para el path del logo 
// $ruta = file_get_contents('../pdf/public/assets/icono_reporte.png');
// $encode = base64_encode($ruta);

// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/logotipo.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png');
$encode_firma = base64_encode($ruta_firma);


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



function ifnull($variable, $msj = "00.00")
{
    if ($variable == '') {
        return $msj;
    } else {
        return $variable;
    }
}


$array = convertirObjetoAArray($resultados);

//Reportes hechos
// Corte de caja no tiene footer 
?>

<body>
    <!-- header -->
    <div class="header">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 6%">
                    <?php
                    echo "<img src='data:image/png;base64, " . $encode . "' height='65' >";
                    ?>
                </td>
                <td style="width: 70%;text-align: center;">
                    <p>
                        <b>DIAGNOSTICO BIOMOLECULAR</b>
                        <br>
                        RFC DBI2012084N2
                        <br>
                        Avenida José Pagés Llergo No. 150, Colonia Arboledas,
                        <br>
                        Villahermosa Tabasco, C.P. 86079
                        <br>
                        9936340250
                        <br>
                        hola@bimo.com.mx
                    </p>
                </td>
            </tr>
        </table>
        <!--CORTE DE CAJA-->
        <h2 style="padding:0px !important;">CORTE DE CAJA </h2>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%;">
                        <p style="padding: 0px; margin:0px;">Fecha Inicio:<strong> <?php echo $array[7] ?></strong></p>
                        <p style="padding: 0px; margin:0px;">Fecha Final:<strong> <?php echo $array[8] ?></strong></p>
                        <p style="padding: 0px; margin:0px;">Caja: <strong><?php echo $array[11] ?></strong></p>
                    </td>
                    <td style="width: 50%;">
                        <p style="padding: 0px; margin:0px;">Realizado por:<strong> <?php echo $array[9] ?></strong></p>
                        <p style="padding: 0px; margin:0px;">Folio:<b> <?php echo $array[6] ?> </b></p>
                        <p style="padding: 0px; margin:0px;"></p>
                        <p></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <!-- body -->
    <!-- <?php ?> -->
    <div class="invoice-content" id="invoice-content">
        <table style="text-align: center; width: 100%;" class="rounded2">
            <thead style="text-align: center; background-color: darkgrey; font-size: 10px;">
                <tr>
                    <th style="width: 10%;">Prefolio</th>
                    <th style="width: 15%;">Nombre</th>
                    <th style="width: 10%;">Subtotal</th>
                    <th style="width: 10%;">IVA (16%)</th>
                    <th style="width: 10%;">Total</th>
                    <th style="width: 15%;">Forma de pago</th>
                    <th style="width: 15%;">Factura</th>
                    <th style="width: 15%;">Procedencia</th>
                </tr>
            </thead>
            <tbody style="height: 420px">

                <?php
                global $c;
                $c = 1;
                foreach ($array[0] as $key => $e) { ?>
                    <tr>
                        <td class="my" style="width: 6%; text-align: center;"> <?php echo $e['PREFOLIO'] ?></td>
                        <td class="my" style="width: 30%; text-align: left;"> <?php echo $e['NOMBRE_PACIENTE'] ?></td>
                        <td class="my" style="width: 11%; text-align: center;"> $<?php echo ifnull(number_format($e['SUBTOTAL'], 2)) ?>
                        </td>
                        <td class="my" style="width: 16%; text-align: center;"> $<?php echo ifnull(number_format($e['IVA'], 2)) ?>
                        </td>
                        <td class="my" style="width: 11%; text-align: right;"> $<?php echo ifnull(number_format($e['TOTAL'], 2)) ?>
                        </td>
                        <td class="my" style="width: 15%; text-align: center;">
                            <?php echo $e['FORMA_PAGO'] ?>
                            <b><?php echo isset($e['MONTO_PAGO_TIPO']) ? ': $' . $e['MONTO_PAGO_TIPO']  : ""
                                ?></b>
                        </td>
                        <td class="my" style="width: 11%; text-align: right;"> <?php echo $e['FACTURA'] ?></td>
                        <td class="my" style="width: 11%; text-align: center;"><?php echo $e['PROCEDENCIA'] ?></td>
                    </tr>
                <?php
                    if ($c > 19) {
                        $c = 0;
                        echo '<div class="break"></div>';
                    } else {
                        $c = $c + 1;
                    }
                }

                ?>
            </tbody>
        </table>
        <?php
        // echo $c; 
        if ($c === 0) {
            echo '<div class="break"></div>';
        }
        // if ($c >= 20) {
        //     echo '<div class="break"></div>';
        // }


        // si es mayor a 23 -> no lo va hacer 
        ?>

        <!-- <div class="break"></div> -->

        <!--    Desglose de precio -->
        <p style="line-height: 2"></p>
        <div style=" float: right;width: 100%;">
            <table style=" width: 100%; text-align: center; border-bottom: transparent; align-items:right; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">Subtotal</td>
                        <td style="text-align: center;">IVA (16.00%)</td>
                        <td style="background-color: darkgrey;"><b>Total</b></td>
                    </tr>
                    <tr>
                        <td style="text-align: center; background-color:white; ">
                            <p>
                                $<?php echo ifnull(number_format($array[1], 2)) ?>
                            </p>
                        </td>
                        <td style="text-align: center; background-color:white; ">
                            <p>$<?php echo ifnull(number_format($array[2], 2)) ?> </p>
                        </td>
                        <td style="background-color: darkgrey;"><b></p>
                                <p>
                                    <b>
                                        $<?php echo ifnull(number_format($array[3], 2)) ?>
                                    </b>
                                </p>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php
        // if ($c >= 15) {
        //     echo '<div class="break"></div>';
        // }
        ?>
        <div id="tipos_pagos">
            <table class="rounded2">
                <thead>
                    <tr>
                        <th colspan="2">Resumen</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Crédito:</td>
                        <td class="total" style="text-align:center;">$<?php echo number_format($array[4], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Contado:</td>
                        <td class="total" style="text-align:center;">$<?php echo number_format($array[5], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Bimo:</td>
                        <td class="total" style="text-align:center;">$<?php echo number_format($array[13], 2) ?></td>
                    </tr>
                    <tr>
                        <td>Bimo cortesia:</td>
                        <td class="total" style="text-align:center;">$<?php echo number_format($array[12], 2) ?></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <table class="rounded2">
                <thead>
                    <tr>
                        <th>Formas de pago</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($array[10] as $key1 => $value1) {

                        if ($value1['IGNORAR'] == 0) {
                            echo '<tr>';
                            echo '<td class="desglose">' . $value1['DESCRIPCION'] . '</td>';
                            echo '<td class="desglose" style="text-align:center;">$' . number_format($value1['MONTO'], 2) . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- <div class="break"></div> -->
    </div>
</body>


<?php

// function getPDF($name)
// {
//     ob_start();
//     return ob_get_clean();
//     // return $htmlPCR;
// }





?>

</html>