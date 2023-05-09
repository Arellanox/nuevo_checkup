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

        .tabla {

            border-bottom: 1px solid #ccc;
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
            border-radius: 50px
                /* table-layout:fixed; */
        }

        */ th,
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

<body>
    <div class="container-fluid">
        <div class="container-fluid">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 33.3%"><img src="http://bimo-lab.com/pdf/logo/logo_documento.png" alt="" width="" height=""></td>
                    <td style="width: 33.3%;text-align: center;">
                        <p>
                            <b>DIAGNOSTICO BIOMOLECULAR</b><br>
                            RFC DBI2012084N2<br>
                            Calle AV. RUIZ CORTINES, 1344, TABASCO 2000, CENTRO,<br>
                            VILLAHERMOSA, TABASCO, 86060, MEX<br>
                            9936340250<br>
                            hola@bimo.com.mx
                        </p>
                    </td>
                    <td style="width: 33.3%;text-align: center;">
                        <p>Cotización<br>
                            <b>No. 75</b>
                        </p>
                    </td>
                </tr>
            </table>
            <table style="width: 100%; border-collapse: collapse; text-align: center;">
                <td colspan="12">&nbsp;</td>
                <!--COTIZACIONES-->
                <div style="display: flex; justify-content: space-between;">
                    <!--INICIO DE TABLA INFORMACIÓN-->
                    <table style="width: 100%; border-collapse: collapse; text-align: center; border-radius: 10px;" border="2">

                        <tr>
                            <td style="background-color: darkgrey;" colspan="2">RAZÓN SOCIAL</td>
                            <td colspan="7"><?php echo $encabezado->RAZON_SOCIAL; ?></td>
                            <td style="background-color: darkgrey;" colspan="3">FECHA DE EXPEDICIÓN (DD/MM/AA)</td>
                        </tr>
                        <tr style=" border-collapse: collapse; border-bottom: transparent;">
                            <td style="background-color: darkgrey;" colspan="2">DOMICILIO FISCAL</td>
                            <td colspan="7">País: MEX</td>
                            <td colspan="3"><?php echo $encabezado->FECHA_CREACION; ?></td>
                        </tr>
                        <tr>
                            <td style="background-color: darkgrey;" colspan="2"></td>
                            <td colspan="7"></td>
                            <td style="background-color: darkgrey;" colspan="3">FECHA DE VENCIMIENTO (DD/MM/AA)</td>
                        </tr>
                        <tr>
                            <td style="background-color: darkgrey;" colspan="2">TELÉFONO</td>
                            <td colspan="2"><?php echo $encabezado->TELEFONO; ?></td>
                            <td style="background-color: darkgrey;" colspan="2">RFC</td>
                            <td colspan="2"><?php echo $encabezado->RFC; ?></td>
                            <td colspan="4"><?php echo $encabezado->FECHA_VENCIMIENTO; ?></td>
                        </tr>
                    </table>
                    <!--FIN DE TABLA INFORMACIÓN-->
                    <P style="line-height: 2.5""></P>
                    <!---INICIO DE LA TABLA DE PRODUCTOS--->
                    <table style=" width: 100%;text-align: center; padding-top: 50px; border-collapse: collapse; height: 500px;" border="2">
                        <thead style="text-align: center; background-color: darkgrey;">
                            <tr>
                                <th colspan="5">Producto</th>
                                <td colspan="1">Unidad de Medida</td>
                                <td colspan="1">Precio unitario</td>
                                <td colspan="1">Cantidad</td>
                                <td colspan="1">Descuento</td>
                                <td colspan="1">Impuesto</td>
                                <td colspan="1">Total</td>
                            </tr>
                        </thead>
                        <tbody style=" border-bottom: transparent;line-height: 1.5;">
                            <tr>
                                <th colspan="5">Ag. Carcinoembrionario (LABORATORIO)</th>
                                <td colspan="1">E48 - Unidad de servicio</td>
                                <td colspan="1">$418.00 </td>
                                <td colspan="1">1.00</td>
                                <td colspan="1">0.00%</td>
                                <td colspan="1">16%</td>
                                <td colspan="1">$418.00</td>
                            </tr>
                            <?php
                            $count = count($resultados->ESTUDIOS);
                            $i = 0;

                            $estudios = $resultados;
                            foreach ($estudios->CONTENEDORES as $a => $estudios) {
                                echo "  <tr>
                                                <th colspan= \"5 \">" . $recipiente->CONTENEDOR . "</th>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                                <td colspan= \"1 \">" . $recipiente->CONTENEDOR . "</td>
                                        </tr>";
                            }

                            $i++;
                            ?>
                            <tr>
                                <td colspan="5"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                        <tfoot style="text-align: center; background-color: darkgrey; text-align: left;">
                            <tr>
                                <td colspan="12">
                            </tr>
                        </tfoot>
            </table>
        </div>

    </div>
    </table>
    <P style="line-height: 2.5""></P>
            <table style=" width: 150px; text-align: right; border-bottom: transparent;" align="right">
        <tbody>
            <tr>
                <td>Subtotal</td>
                <td><?php echo $encabezado->SUBTOTAL; ?></td>
            </tr>
            <tr>
                <td>IVA (16.00%)</td>
                <td><?php echo $encabezado->IVA; ?></td>
            </tr>
            <tr style="
                    background-color: darkgrey;">
                <td>Total</td>
                <td><?php echo $encabezado->TOTAL; ?></td>
            </tr>
        </tbody>
        </table>
        <!---FIN DE LA TABLA DE PRODUCTOS--->

    <table style="width: 35%; padding-top: 11%;" align="left">
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