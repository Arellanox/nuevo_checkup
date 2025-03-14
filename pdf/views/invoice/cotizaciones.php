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

        .tachado-doble {
            text-decoration: line-through;
            color: #a9a9a9;
        }
    </style>
</head>
<?php
// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);
$idioma = 1;
switch ($idioma) {
    case 1:
        echo
        "<body>
    <div class=\"container-fluid\">
        <table style=\"width: 100%; text-align: center;\">
            <tr>
                <td style=\"width: 25%\">
                    <img src='data:image/png;base64, " . $encode . "' height='65' >
                </td>
                <td style=\"width: 50%;text-align: center;\">
                    <p>
                        <b>DIAGNOSTICO BIOMOLECULAR</b><br>
                        RFC DBI2012084N2<br>
                        Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas,
                    Villahermosa Tabasco, C.P. 86079 <br>
                        9936340250<br>
                        hola@bimo.com.mx
                    </p>
                </td>
                <td style=\"width: 25%;text-align: center;\">
                    <p>Cotización<br>
                        <b>No. " . $resultados->FOLIO . "</b>
                    </p>
                </td>
            </tr>
        </table>
        <!--COTIZACIONES-->
        <!--INICIO DE TABLA INFORMACIÓN-->
        <table style=\"width: 100%; text-align: center; text-align: right; border: darkgrey 1px solid;\" class=\"rounded\" ;>
            <tbody>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 4px 0px 0px 0px; \"><b>RAZÓN SOCIAL</b></td>
                    <td style=\"width: 55%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\" colspan=\"3\">" . $resultados->RAZON_SOCIAL . "</td>
                    <td style=\"background-color: darkgrey; width: 30%; text-align: center; border-radius: 0px 4px 0px 0px; border-left: 1px solid darkgrey;\"><b>FECHA DE EXPEDICIÓN (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 0px;\"><b>DOMICILIO FISCAL</b></td>
                    <td style=\"width: 55%;text-align: left; border-top: 1px solid darkgrey;\" colspan=\"3\" class=\"cell\">" . $resultados->DOMICILIO_FISCAL . "</td>
                    <td style=\"width: 30%;text-align: center; border-left: 1px solid darkgrey;\">" . $resultados->FECHA_CREACION . "</td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%;\" class=\"colored-cell\"></td>
                    <td style=\"width: 55%; border-bottom: 1px solid darkgrey;\" class=\"colored-cell\" colspan=\"3\"></td>
                    <td style=\"background-color: darkgrey; width: 30%; text-align: center; border-left: 1px solid darkgrey;\"><b>FECHA DE VENCIMIENTO (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 4px;\"><b>TELÉFONO</td>
                    </td>
                    <td style=\"width: 20%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\">" . $resultados->TELEFONO . "</td>
                    <td style=\"background-color: darkgrey; width: 10%; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\"><b>RFC</td>
                    <td style=\"width: 20%;text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\"> " . $resultados->RFC . "</td>
                    <td style=\"width: 30%;border-bottom: 1px solid darkgrey; border-radius: 0px 0px 4px 0px; border-left: 1px solid darkgrey; text-align: center;\">" . $resultados->FECHA_VENCIMIENTO . "</td>
                </tr>
            </tbody>
        </table>
        <!--FIN DE TABLA INFORMACIÓN-->
        <p style=\"line-height: 1\"></p>
        <!---INICIO DE LA TABLA DE PRODUCTOS--->
        <table style=\"text-align: center; width: 100%; min-height: 550px;\" class=\"rounded2\">
            <thead style=\"text-align: center; background-color: darkgrey; font-size: 9px;\">
                <tr>
                    <th style=\"width: 34%;\">Producto</th>
                    <th style=\"width: 11%;\">Unidad de Medida</th>
                    <th style=\"width: 11%;\">Precio unitario</th>
                    <th style=\"width: 11%;\">Cantidad</th>
                    <th style=\"width: 11%;\">Descuento</th>
                    <th style=\"width: 11%;\">Impuesto</th>
                    <th style=\"width: 11%;\">Total</th>
                </tr>
            </thead>";

        $resultArray = $resultados->ESTUDIOS_DETALLE;
        $count = count((array)$resultArray);
        #// echo $count;
        for ($i = 0; $i < $count; $i++) {

            $numero = json_decode(json_encode($resultArray[$i]), true)['TOTAL'];

            $formateado = number_format($numero, 2);
            $formateado2 = number_format(json_decode(json_encode($resultArray[$i]), true)['TOTAL_ORIGINAL'], 2);
            $descuento = json_decode(json_encode($resultArray[$i]), true)['DESCUENTO_PORCENTAJE'];

            echo "<tr>
                <td style=\"width: 34%; text-align: left;\">" . json_decode(json_encode($resultArray[$i]), true)['PRODUCTO'] . "</td>
                <td style=\"width: 11%; text-align: left;\">E48 -Service unit</td>
                <td style=\"width: 11%; text-align: right;\">$" . json_decode(json_encode($resultArray[$i]), true)['PRECIO_UNITARIO'] . "</td>
                <td style=\"width: 11%; text-align: center;\">" . json_decode(json_encode($resultArray[$i]), true)['CANTIDAD'] . ".00</td>
                <td style=\"width: 11%; text-align: right;\">" . $descuento . "%</td>
                <td style=\"width: 11%; text-align: center;\">16% </td>
                <td style=\"width: 11%; text-align: right;\">$" . $formateado;

            echo $descuento == 0 ? '' : "<br>
                <span class='tachado-doble'>$" . $formateado2 . "</span>";

            echo " </td> </tr>";
        }

        echo "</tbody>
        </table>
        <table class=\"esquina-inferior\">
            <tbody>
                <tr style=\"background-color: darkgrey; \">
                    <td colspan=\"12\">" . $resultados->CANTIDAD . "</td>
                </tr>
            </tbody>
        </table>
        <p><strong>Comentarios:</strong><br>" . $resultados->OBSERVACIONES . "</p>
        <!--Inicio tabla totales -->
        <p style=\"line-height: 2.5\"></p>
        <div style=\" float: right;width: 30%;\">
            <table style=\" width: 180px; text-align: right; border-bottom: transparent; align-items:right; \">
                <tbody>
                    <tr>
                        <td>Total de cargos</td>
                        <td>$ ". number_format($resultados->SUBTOTAL_SIN_DESCUENTO, 2, '.', ',')  ."</td>
                    </tr>
                    <tr>
                        <td>Descuento (" . $resultados->PORCENTAJE_DESCUENTO . "%)</td>
                        <td>$ " . number_format($resultados->DESCUENTO, 2, '.', ',') . "</td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>$ " . number_format($resultados->SUBTOTAL, 2, '.',',') . "</td>
                    </tr>
                    <tr>
                        <td>IVA (16.00%)</td>
                        <td>$ " . number_format($resultados->IVA, 2, '.', ',') . "</td>
                    </tr>
                    <tr style=\"background-color: darkgrey;\">
                        <td><b>Total</b></td>
                        <td><b></p>$ " . number_format($resultados->TOTAL_DETALLE, 2, '.', ',') . " </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!---FIN DE LA TABLA DE PRODUCTOS--->
        <div style=\"float: left;width: 70%;\">
            <table style=\"width: 100%; padding-top: 16%; border-collapse: collapse;\" align=\"left\">
                <tr>
                    <td style=\"text-align: center;\"><b> " . $resultados->CREADO_POR . "</b></td> 
                </tr>
                <tr style=\"text-align: center;\">
                    <td style=\"width: 10%; text-align: center; border-top: 1px solid black;\">
                        ELABORADO POR
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>";
        break;
    case 2:
        echo
        "<body>
    <div class=\"container-fluid\">
        <table style=\"width: 100%; text-align: center;\">
            <tr>
                <td style=\"width: 25%\">
                    <img src='data:image/png;base64, " . $encode . "' height='65' >
                </td>
                <td style=\"width: 50%;text-align: center;\">
                    <p>
                        <b>DIAGNOSTICO BIOMOLECULAR</b><br>
                        RFC DBI2012084N2<br>
                        Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas,
                    Villahermosa Tabasco, C.P. 86079 <br>
                        9936340250<br>
                        hola@bimo.com.mx
                    </p>
                </td>
                <td style=\"width: 25%;text-align: center;\">
                    <p>Quotation<br>
                        <b>No. " . $encabezado->FOLIO_COTIZACIONES . "</b>
                    </p>
                </td>
            </tr>
        </table>
        <!--COTIZACIONES-->
        <!--INICIO DE TABLA INFORMACIÓN-->
        <table style=\"width: 100%; text-align: center; text-align: right; border: darkgrey 1px solid;\" class=\"rounded\" ;>
            <tbody>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 4px 0px 0px 0px; \"><b>BUSINESS NAME</b></td>
                    <td style=\"width: 55%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\" colspan=\"3\">" . $resultados->RAZON_SOCIAL . "</td>
                    <td style=\"background-color: darkgrey; width: 30%; text-align: center; border-radius: 0px 4px 0px 0px; border-left: 1px solid darkgrey;\"><b>EXPEDITION DATE (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 0px;\"><b>TAX RESIDENCE</b></td>
                    <td style=\"width: 55%;text-align: left; border-top: 1px solid darkgrey;\" colspan=\"3\" class=\"cell\">País: MEX</td>
                    <td style=\"width: 30%;text-align: center; border-left: 1px solid darkgrey;\">" . $resultados->FECHA_CREACION . "</td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%;\" class=\"colored-cell\"></td>
                    <td style=\"width: 55%; border-bottom: 1px solid darkgrey;\" class=\"colored-cell\" colspan=\"3\"></td>
                    <td style=\"background-color: darkgrey; width: 30%; text-align: center; border-left: 1px solid darkgrey;\"><b>EXPIRATION DATE (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style=\"background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 4px;\"><b>PHONE</td>
                    </td>
                    <td style=\"width: 20%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\">" . $resultados->TELEFONO . "</td>
                    <td style=\"background-color: darkgrey; width: 10%; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\"><b>RFC</td>
                    <td style=\"width: 20%;text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;\">" . $resultados->RFC . "</td>
                    <td style=\"width: 30%;border-bottom: 1px solid darkgrey; border-radius: 0px 0px 4px 0px; border-left: 1px solid darkgrey; text-align: center;\">" . $resultados->FECHA_VENCIMIENTO . "</td>
                </tr>
            </tbody>
        </table>
        <!--FIN DE TABLA INFORMACIÓN-->
        <p style=\"line-height: 1\"></p>
        <!---INICIO DE LA TABLA DE PRODUCTOS--->
        <table style=\"text-align: center; width: 100%; min-height: 550px;\" class=\"rounded2\">
            <thead style=\"text-align: center; background-color: darkgrey; font-size: 9px;\">
                <tr>
                    <th style=\"width: 34%;\">Product</th>
                    <th style=\"width: 11%;\">Measurement unit</th>
                    <th style=\"width: 11%;\">unit price</th>
                    <th style=\"width: 11%;\">quantity</th>
                    <th style=\"width: 11%;\">Discount</th>
                    <th style=\"width: 11%;\">Tax</th>
                    <th style=\"width: 11%;\">Total</th>
                </tr>
            </thead>";

        $resultArray = $resultados->ESTUDIOS_DETALLE;
        $count = count((array)$resultArray);
        #// echo $count;
        for ($i = 0; $i < $count; $i++) {

            $numero = json_decode(json_encode($resultArray[$i]), true)['TOTAL'];

            $formateado = number_format($numero, 2);
            echo "  <tr>
                                        <td style=\"width: 34%; text-align: left;\">" . json_decode(json_encode($resultArray[$i]), true)['PRODUCTO'] . "</td>
                                        <td style=\"width: 11%; text-align: left;\">E48 -Service unit</td>
                                        <td style=\"width: 11%; text-align: right;\">$" . json_decode(json_encode($resultArray[$i]), true)['PRECIO'] . "</td>
                                        <td style=\"width: 11%; text-align: center;\">" . json_decode(json_encode($resultArray[$i]), true)['CANTIDAD'] . ".00</td>
                                        <td style=\"width: 11%; text-align: right;\">" . $resultados->DESCUENTO . ".00%</td>
                                        <td style=\"width: 11%; text-align: center;\">16% </td>
                                        <td style=\"width: 11%; text-align: right;\">$" . $formateado . "</td>
                                    </tr>";
        }

        echo "</tbody>
        </table>
        <table class=\"esquina-inferior\">
            <tbody>
                <tr style=\"background-color: darkgrey; \">
                    <td colspan=\"12\">" . $resultados->CANTIDAD . " Total quantity 00/100 M.N.</td>
                </tr>
            </tbody>
        </table>
        <!--Inicio tabla totales -->
        <p style=\"line-height: 2.5\"></p>
        <div style=\" float: right;width: 30%;\">
            <table style=\" width: 150px; text-align: right; border-bottom: transparent; align-items:right; \">
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>$ " . $resultados->SUBTOTAL . "</td>
                    </tr>
                    <tr>
                        <td>TAX (16.00%)</td>
                        <td>$ " . $resultados->IVA . "</td>
                    </tr>
                    <tr style=\"background-color: darkgrey;\">
                        <td><b>Total</b></td>
                        <td><b></p>$ " . $resultados->TOTAL_DETALLE . " </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!---FIN DE LA TABLA DE PRODUCTOS--->
        <div style=\"float: left;width: 70%;\">
            <table style=\"width: 100%; padding-top: 16%; border-collapse: collapse;\" align=\"left\">
                <tr>
                    <td style=\"text-align: center;\"></b></td>
                </tr>
                <tr style=\"text-align: center;\">
                    <td style=\"width: 10%; text-align: center; border-top: 1px solid black;\">
                    PREPARED BY
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>";
        break;
    default:
        echo "frances";
        break;
}
?>