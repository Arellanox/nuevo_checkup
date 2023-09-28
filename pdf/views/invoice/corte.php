<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Corte de caja</title>

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
    </style>
</head>
<?php
// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

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

// echo "<pre>";
// var_dump($array[10]);
// echo "</pre>";
?>

<body>
    <div class="container-fluid">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 6%">
                    <?php
                    echo "<img src='data:image/png;base64, " . $encode . "' height='65' >";
                    ?>
                </td>
                <td style="width: 70%;text-align: center;">
                    <p>
                        <b>DIAGNOSTICO BIOMOLECULAR</b><br>
                        RFC DBI2012084N2<br>
                        Calle AV. RUIZ CORTINES, 1344, TABASCO 2000, CENTRO,<br>
                        VILLAHERMOSA, TABASCO, 86060, MEX<br>
                        9936340250<br>
                        hola@bimo.com.mx
                    </p>
                </td>
            </tr>
        </table>
        <!--CORTE DE CAJA-->
        <!--INICIO DE TABLA INFORMACIÓN-->
        <!-- <hr style="height: 1px; background-color: black ;">
        <p style="text-align: center; margin: -4px; font-size: 16px;"><strong>CORTE DE CAJA</strong></p>
        <hr style="height: 1px; background-color: black ;"> -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">CORTE DE CAJA </h2>

        <br>
        <div>
            <table style="width: 100%;">
                <tr>
                    <td style="width: 50%">
                        <p>Fecha Inicio:<strong> <?php echo $array[7] ?></strong></p>
                        <p>Fecha Final:<strong> <?php echo $array[8] ?></strong></p>
                        <p>Folio:<b> <?php echo $array[6] ?> </b></p>
                    </td>
                    <td style="width: 50%;">
                        <p>Realizado por:<strong> <?php echo $array[9] ?></strong></p>
                        <p style="opacity:0 ">Fecha Final:<strong> <?php echo $array[8] ?></strong></p>
                        <p style="opacity:0">Folio:<b> <?php echo $array[6] ?> </b></p>
                    </td>
                </tr>
            </table>

        </div>
        <!--FIN DE TABLA INFORMACIÓN-->
        <p style="line-height: .5"></p>
        <!---INICIO DE LA TABLA DE PRODUCTOS--->
        <table style="text-align: center; width: 100%;" class="rounded2">
            <thead style="text-align: center; background-color: darkgrey; font-size: 10px;">
                <tr>
                    <th style="width: 10%;">Prefolio</th>
                    <th style="width: 15%;">Nombre</th>
                    <th style="width: 15%;">Subtotal</th>
                    <th style="width: 15%;">IVA (16%)</th>
                    <th style="width: 15%;">Total</th>
                    <th style="width: 15%;">Forma de pago</th>
                    <th style="width: 15%;">Factura</th>
                </tr>
            </thead>
            <tbody style="height: 420px">

                <?php
                $c = 0;
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
                        <td class="my" style="width: 15%; text-align: center;"> <?php echo $e['FORMA_PAGO'] ?> </td>
                        <td class="my" style="width: 11%; text-align: right;"> <?php echo $e['FACTURA'] ?></td>
                    </tr>
                <?php
                    $c += 1;
                }

                ?>
                <!-- <tr>
                    <td style="width: 11%; text-align: center;"> 001</td>
                    <td style="width: 30%; text-align: left;">E48 -Unidad de servicio</td>
                    <td style="width: 11%; text-align: right;">$ 100</td>
                    <td style="width: 11%; text-align: center;">16 %</td>
                    <td style="width: 11%; text-align: right;">$ 116</td>
                    <td style="width: 15%; text-align: center;">Crédito </td>
                    <td style="width: 11%; text-align: right;">002</td>
                </tr> -->
            </tbody>
        </table>
        <?php
        if ($c >= 27) {
            echo '<div class="break"></div>';
        }
        ?>
        <!--Inicio tabla totales -->
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
                                $<?php echo ifnull(number_format($array[3], 2)) ?> </b></td>
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
        if ($c >= 15) {
            echo '<div class="break"></div>';
        }
        ?>
        <div style="width: 100%;">
            <!--INICIO DE TABLA INFORMACIÓN-->
            <!-- <hr style="height: 1px; background-color: black ;"> -->
            <!-- <p style="text-align: center; margin: -4px; font-size: 16px;"><strong>RESUMEN</strong></p> -->
            <!-- <hr style="height: 1px; background-color: black ;"> -->


            <!-- Otoscopía -->
            <!-- <h2 style="padding-bottom: 6px; padding-top: 6px;">RESUMEN </h2> -->
        </div>

        <!-- Desglose de los precios de contado -->
        <!-- <div class="break"></div> -->
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
            table {
                width: 50%;
                margin: 0 auto;
                border-collapse: collapse;
                font-size: 10px;
            }

            th,
            td {
                text-align: left;
                padding: 8px;
            }

            th {
                background-color: darkgrey;
                font-weight: bold;
                text-align: center;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            .total {
                font-weight: bold;
                text-align: right;
            }

            .desglose {
                font-size: 10px;
                font-weight: normal;
            }
        </style>
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
                        echo '<tr>';
                        echo '<td class="desglose">' . $value1['DESCRIPCION'] . '</td>';
                        echo '<td class="desglose" style="text-align:center;">$' . number_format($value1['MONTO'], 2) . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!---FIN DE LA TABLA DE PRODUCTOS--->
        <div style="float: left;width: 70%;">
            <table style="width: 100%; padding-top: 6%; border-collapse: collapse;" align="left">

                <td><b></p><?php $counteo = json_decode($resultados->ESTUDIOS_DETALLE, true);
                            ?></b></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>