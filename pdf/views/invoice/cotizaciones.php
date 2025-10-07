<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Cotización</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            font-size: 10px;
        }

        .footer .page:after {
            content: counter(page);
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

        body {
            font-size: 11px;
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

        .tachado-doble {
            text-decoration: line-through;
            color: #a9a9a9;
        }
    </style>
</head>
<?php
    $ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
    $encode = base64_encode($ruta);
    $idioma = 1;

?>
<body>
    <div class="container-fluid body">
        <table style="width: 100%; text-align: center;">
            <tr>
                <td style="width: 25%">
                    <?= "<img src='data:image/png;base64, " . $encode . "' height='65' >";?>
                </td>
                <?php if (!(isset($resultados->franquicia) && is_array($resultados->franquicia))) : ?>
                    <td style="width: 50%;text-align: center;">
                        <p>
                            <b>DIAGNOSTICO BIOMOLECULAR</b>
                            <br>
                            RFC DBI2012084N2
                            <br>
                            Avenida José Pagés Llergo No. 150, Colonia Arboledas,
                            Villahermosa Tabasco, C.P. 86079
                            <br>
                            9936340250
                            <br>
                            hola@bimo.com.mx
                        </p>
                    </td>
                    <td style="width: 25%;text-align: center;">
                        <p>Cotización<br>
                            <b>No. <?= $resultados->FOLIO ?></b>
                        </p>
                    </td>
                <?php else: ?>
                    <td style="width: 50%;text-align: center;">
                        <p>
                            <?php $franquicia = $resultados->franquicia[0]; ?>
                            <b>DIAGNOSTICO BIOMOLECULAR SA DE CV</b>
                            <br>
                            RFC <?= $franquicia->RFC ?>
                            <br>
                            <?= formatearDireccionFranquicia($franquicia); ?>
                            <br>
                            <?= $franquicia->TELEFONO ?>
                            <br>
                            <?= $franquicia->CORREO ?>
                        </p>
                    </td>
                    <td style="width: 25%;text-align: center;">
                        <p>Cotización<br>
                            <b>No. <?= $resultados->FOLIO ?></b>
                        </p>
                    </td>
                <?php endif; ?>
            </tr>
        </table>

        <table style="width: 100%; text-align: center; text-align: right; border: darkgrey 1px solid;" class="rounded">
            <tbody>
                <tr>
                    <td style="background-color: darkgrey; width: 15%; border-radius: 4px 0px 0px 0px;"><b>RAZÓN SOCIAL</b></td>
                    <td style="width: 55%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;" colspan="3"><?= $resultados->RAZON_SOCIAL ?></td>
                    <td style="background-color: darkgrey; width: 30%; text-align: center; border-radius: 0px 4px 0px 0px; border-left: 1px solid darkgrey;"><b>FECHA DE EXPEDICIÓN (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 0px;"><b>DOMICILIO FISCAL</b></td>
                    <td style="width: 55%;text-align: left; border-top: 1px solid darkgrey;" colspan="3" class="cell"><?=  $resultados->DOMICILIO_FISCAL ?></td>
                    <td style="width: 30%;text-align: center; border-left: 1px solid darkgrey;"><?= $resultados->FECHA_CREACION ?></td>
                </tr>
                <tr>
                    <td style="background-color: darkgrey; width: 15%;" class="colored-cell"></td>
                    <td style="width: 55%; border-bottom: 1px solid darkgrey;" class="colored-cell" colspan="3"></td>
                    <td style="background-color: darkgrey; width: 30%; text-align: center; border-left: 1px solid darkgrey;"><b>FECHA DE VENCIMIENTO (DD/MM/AA)</td>
                    </td>
                </tr>
                <tr>
                    <td style="background-color: darkgrey; width: 15%; border-radius: 0px 0px 0px 4px;"><b>TELÉFONO</td>
                    </td>
                    <td style="width: 20%; text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;"><?= $resultados->TELEFONO ?></td>
                    <td style="background-color: darkgrey; width: 10%; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;"><b>RFC</td>
                    <td style="width: 20%;text-align: left; border-bottom: 1px solid darkgrey; border-top: 1px solid darkgrey;"> <?= $resultados->RFC ?></td>
                    <td style="width: 30%;border-bottom: 1px solid darkgrey; border-radius: 0px 0px 4px 0px; border-left: 1px solid darkgrey; text-align: center;"><?= $resultados->FECHA_VENCIMIENTO ?></td>
                </tr>
            </tbody>
        </table>

        <p style="line-height: 1"></p>

        <table style="text-align: center; width: 100%; min-height: 500px;" class="rounded2">
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
            <tbody>
            <?php
                if(!isset($resultados->ESTUDIOS_DETALLE)){
                    return;
                }

                $resultArray = $resultados->ESTUDIOS_DETALLE;
                $count = count((array)$resultArray);

                for ($i = 0; $i < $count; $i++):

                    $numero = json_decode(json_encode($resultArray[$i]), true)['TOTAL'];
                    $formateado = number_format($numero, 2);
                    $formateado2 = number_format(json_decode(
                            json_encode($resultArray[$i]), true
                    )['TOTAL_ORIGINAL'], 2);
                    $descuento = json_decode(json_encode($resultArray[$i]), true)['DESCUENTO_PORCENTAJE'];
            ?>
                <tr>
                    <td style="width: 34%; text-align: left;">
                        <?=
                            json_decode(json_encode($resultArray[$i]), true)['PRODUCTO'] ??
                            json_decode(json_encode($resultArray[$i]), true)['PAQUETE']
                        ?>
                    </td>
                    <td style="width: 11%; text-align: left;">E48 -Service unit</td>
                    <td style="width: 11%; text-align: right;">
                        $<?= json_decode(json_encode($resultArray[$i]), true)['PRECIO_UNITARIO'] ?>
                    </td>
                    <td style="width: 11%; text-align: center;">
                        <?= json_decode(json_encode($resultArray[$i]), true)['CANTIDAD']?>.00
                    </td>
                    <td style="width: 11%; text-align: right;"><?= $descuento ?> %</td>
                    <td style="width: 11%; text-align: center;">16% </td>
                    <td style="width: 11%; text-align: right;">
                        $<?= $formateado ?>
                        <?php if($descuento != 0) : ?>
                            <br>
                            <span class='tachado-doble'>$<?= $formateado2 ?></span>
                        <?php endif;?>
                    </td>
                </tr>
            <?php endfor; ?>
            </tbody>
        </table>

        <table class="esquina-inferior">
            <tbody>
                <tr style="background-color: darkgrey; ">
                    <td colspan="12"><?= $resultados->CANTIDAD ?> M.N</td>
                </tr>
            </tbody>
        </table>
        <p><strong>Comentarios:</strong><br><?=  $resultados->OBSERVACIONES?></p>

        <p style="line-height: 2.5"></p>

            <div style=" float: right;width: 30%;">
            <table style=" width: 180px; text-align: right; border-bottom: transparent; align-items: right;">
                <tbody>
                    <tr>
                        <td>Total de cargos</td>
                        <td>$<?= number_format($resultados->SUBTOTAL_SIN_DESCUENTO, 2, '.', ',') ?></td>
                    </tr>
                    <tr>
                        <td>Descuento <br>(<?= $resultados->PORCENTAJE_DESCUENTO ?>%) </td>
                        <td style="color: #ba2929">-$<?= number_format($resultados->DESCUENTO, 2, '.', ',') ?></td>
                    </tr>
                    <tr>
                        <td>Subtotal</td>
                        <td>$<?= number_format($resultados->SUBTOTAL, 2, '.',',') ?></td>
                    </tr>
                    <tr>
                        <td>IVA (16.00%)</td>
                        <td>$<?= number_format($resultados->IVA, 2, '.', ',') ?></td>
                    </tr>
                    <tr style="background-color: darkgrey;">
                        <td><b>Total</b></td>
                        <td><b>$</p><?= number_format($resultados->TOTAL_DETALLE, 2, '.', ',')?> </b></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="float: left;width: 70%;">
            <table style="width: 100%; padding-top: 16%; border-collapse: collapse;" align="left">
                <tr>
                    <td style="text-align: center;"><b><?= $resultados->CREADO_POR ?></b></td>
                </tr>
                <tr style="text-align: center;">
                    <td style="width: 10%; text-align: center; border-top: 1px solid black;">
                        ELABORADO POR
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>

<?php
    function formatearDireccionFranquicia($franquicia): string
    {
        if (!$franquicia || !is_object($franquicia)) {
            return '';
        }

        $direccion = [];

        // Línea 1: Calle, Colonia, No. Ext, No. Int (si existe)
        $linea1 = [];

        if (!empty($franquicia->CALLE)) {
            $linea1[] = $franquicia->CALLE;
        }

        if (!empty($franquicia->COLONIA)) {
            $linea1[] = $franquicia->COLONIA;
        }

        if (!empty($franquicia->NUMERO_EXT)) {
            $linea1[] = 'No. Ext. ' . $franquicia->NUMERO_EXT;
        }

        if (!empty($franquicia->NUMERO_INT)) {
            $linea1[] = 'No. Int. ' . $franquicia->NUMERO_INT;
        }

        if (!empty($linea1)) {
            $direccion[] = implode(', ', $linea1);
        }

        // Línea 2: Estado, Municipio, Código Postal
        $linea2 = [];

        if (!empty($franquicia->ESTADO)) {
            $linea2[] = ' '.$franquicia->ESTADO;
        }

        if (!empty($franquicia->MUNICIPIO)) {
            $linea2[] = $franquicia->MUNICIPIO;
        }

        if (!empty($franquicia->CODIGO_POSTAL)) {
            $linea2[] = 'C.P. ' . $franquicia->CODIGO_POSTAL;
        }

        if (!empty($linea2)) {
            $direccion[] = implode(', ', $linea2);
        }

        // Retornar el resultado con salto de línea entre las líneas
        return implode('', $direccion);
    }

?>