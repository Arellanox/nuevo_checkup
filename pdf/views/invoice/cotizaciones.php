<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Cotización</title>

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
            border: 1px solid darkgrey;
            border-bottom: 0px solid darkgrey;
            border-spacing: 0;
        }

        .colored-cell {
            border-top: 0px solid black;
            border-right: 0px solid black;
            border-bottom: 1px solid darkgrey;
            border-left: 1px solid black;
        }

        .cell {
            border-top: 0px solid black;
            border-right: 0px solid black;
            border-bottom: 1px solid red;
            border-left: 1px solid black;
        }
    </style>
</head>
<?php
// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);
?>

<body>
    <div class="container-fluid">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 25%">
                    <?php
                    echo "<img src='data:image/png;base64, " . $encode . "' height='65' >";
                    ?>
                </td>
                <td style="width: 50%;text-align: center;">
                    <p>
                        <b>DIAGNOSTICO BIOMOLECULAR</b><br>
                        RFC DBI2012084N2<br>
                        Calle AV. RUIZ CORTINES, 1344, TABASCO 2000, CENTRO,<br>
                        VILLAHERMOSA, TABASCO, 86060, MEX<br>
                        9936340250<br>
                        hola@bimo.com.mx
                    </p>
                </td>
                <td style="width: 25%;text-align: center;">
                    <p>Cotización<br>
                        <b>No. 75</b>
                    </p>
                </td>
            </tr>
        </table>
        <!--COTIZACIONES-->
        <!--INICIO DE TABLA INFORMACIÓN-->
        <table style="width: 100%; text-align: center; text-align: right;" class="rounded" border=".5" ;>
            <tr>
                <td style="background-color: darkgrey;border-radius: 6px 0px 0px 0px; width: 15%;"><b>RAZÓN SOCIAL</b></td>
                <td style="width: 55%; text-align: left;" colspan="3"><?php echo $encabezado->RAZON_SOCIAL; ?></td>
                <td style="background-color: darkgrey;border-radius: 0px 6px 0px 0px; width: 30%;text-align: center;"><b>FECHA DE EXPEDICIÓN (DD/MM/AA)</td>
                </td>
            </tr>
            <tr style=" border-collapse: collapse; border-bottom: transparent;">
                <td style="background-color: darkgrey; width: 15%;"><b>DOMICILIO FISCAL</b></td>
                <td style="width: 55%;text-align: left;" colspan="3" rowspan="2" class="cell">País: MEX</td>
                <td style="width: 30%;text-align: left;"><?php echo $encabezado->FECHA_CREACION; ?></td>
            </tr>
            <tr style="border-bottom: transparent;">
                <td style="background-color: darkgrey; width: 15%;" class="colored-cell"></td>
                <td style="width: 55%;border-bottom: transparent;" class="colored-cell" colspan="3"></td>
                <td style="background-color: darkgrey; width: 30%; text-align: center;"><b>FECHA DE VENCIMIENTO (DD/MM/AA)</td>
                </td>
            </tr>
            <tr>
                <td style="background-color: darkgrey;border-radius: 0px 0px 0px 6px; width: 15%;"><b>TELÉFONO</td>
                </td>
                <td style="width: 20%; text-align: left;"><?php echo $encabezado->TELEFONO; ?></td>
                <td style="background-color: darkgrey; width: 10%; "><b>RFC</td>
                </td>
                <td style="width: 20%;text-align: left;"><?php echo $encabezado->RFC; ?></td>
                <td style="border-radius: 0px 0px 6px 0px; width: 30%;"><?php echo $encabezado->FECHA_VENCIMIENTO; ?></td>
            </tr>

        </table>
        <!--FIN DE TABLA INFORMACIÓN-->
        <p style="line-height: .5"></p>
        <!---INICIO DE LA TABLA DE PRODUCTOS--->
        <table style=" text-align: center;width: 100%; height: 550px;" class="rounded">
            <thead style="text-align: center; background-color: darkgrey; font-size: 9px;">
                <tr>
                    <th style="width: 34%;">Producto</th>
                    <th style="width: 11%;">Unidad de Medida</th>
                    <th style="width: 11%;">Precio unitario</th>
                    <th style="width: 11%;">Cantidad</th>
                    <th style="width: 11%;">Descuento</th>
                    <th style="width: 11%;">Impuesto</th>
                    <th style="width: 11%;">Total</th>
                </tr>
            </thead>
            <tbody style=" border-bottom: transparent;line-height: 1;">
                <tr>
                    <td style="width: 34%;">Ag. Carcinoembrionario (LABORATORIO)</td>
                    <td style="width: 11%;">E48 -Unidad de servicio</td>
                    <td style="width: 11%;">$418.00 </td>
                    <td style="width: 11%;">1.00</td>
                    <td style="width: 11%;">0.00%</td>
                    <td style="width: 11%;">16%</td>
                    <td style="width: 11%;">$418.00</td>
                </tr>
                <?php
                $count = count($resultados->ESTUDIOS);
                $i = 0;

                $estudios = $resultados;
                foreach ($estudios->CONTENEDORES as $a => $estudios) {
                    echo "  <tr>
                                                <td style=\"width: 34%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                <td style=\"width: 11%;\">" . $recipiente->CONTENEDOR . "</td>
                                                </tr>";
                }

                $i++;
                ?>
                <tr style="min-height: 550px; background-color: green">
                    <td style="width: 34%;">hola
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                </tr>
                <tr style="min-height: 550px; background-color: green">
                    <td style="width: 34%;">hola
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                    <td style="width: 11%;">
                    </td>
                </tr>
            </tbody>
            <tfoot style="text-align: center; background-color: darkgrey; text-align: left;">
                <tr>
                    <td colspan="12">
                </tr>
            </tfoot>
        </table>
        <!--Inicio tabla totales -->
        <p style="line-height: 2.5""></p>
        <div style=" float: right;width: 20%;">
        <table style=" width: 150px; text-align: right; border-bottom: transparent; align-items:right;">
            <tbody>
                <tr>
                    <td>Subtotal</td>
                    <td><?php echo $encabezado->SUBTOTAL; ?></td>
                </tr>
                <tr>
                    <td>IVA (16.00%)</td>
                    <td><?php echo $encabezado->IVA; ?></td>
                </tr>
                <tr style="background-color: darkgrey;">
                    <td>Total</td>
                    <td><?php echo $encabezado->TOTAL; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!---FIN DE LA TABLA DE PRODUCTOS--->
    <div style="float: left;width: 30%;">
        <table style="width: 100%; padding-top: 11%;" align="left">
            <td style="text-align: center;">
                <p style="width: 5%; text-align: center;">
                    <hr style="height: 1px; background-color: black ; " align="center"><br>
                    ELABORADO POR
                </p>
            </td>
        </table>
    </div>
    </div>
</body>

</html>