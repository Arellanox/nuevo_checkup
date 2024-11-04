<style>
    table.full-width-table {
        width: 100%;
        font-size: 10px;
        border-collapse: collapse;
        text-align: left;
        margin: 0;
    }
    .full-width-table td {
        padding: 2px 5px;
        line-height: 1;
        border: none;
        font-size: 10px;
    }
    .full-width-table strong {
        font-weight: bold;
    }
    .col-left, .col-right, .col-extra {
        width: 15%; /* Reducido para dar más espacio al nombre */
    }
    .col-center {
        width: 35%; /* Aumentado para la columna del nombre */
    }
</style>

<table>
    <tbody>
        <tr>
            <td class="col-der" style="border-bottom: none; text-align: center">
                <h4>
                    DIAGNÓSTICO BIOMOLECULAR S.A.de C.V. <br>
                    <?php echo $titulo; ?> <br>
                    <?php if (isset($subtitulo)) {
                        echo $subtitulo;
                    } else {
                        echo 'Resultado de exámenes';
                    }; ?>
                </h4>
            </td>
            <td class="col-izq" style="border-bottom: none; text-align:center;">
                <?php
                echo "<img src='data:image/png;base64, " . $encode . "' height='65' >";
                // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                ?>

            </td>


        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="text-align: center; border-style: solid none solid none; ">
                <h3>
                    <?php echo $tituloPersonales; ?>
                </h3>
            </td>
        </tr>
    </tbody>
</table>

<!-- TABLA ORIGINAL -->
<!-- <table>
    <tbody>
        <tr>
            <td class="col-left" style="border-bottom: none">
                No. Folio: <strong style="font-size: 12px;"> <?php echo $folio; ?> </strong>
            </td>
            <td class="col-center" style="border-bottom: none">
                Edad: <strong style="font-size: 12px;"> <?php echo $encabezado->EDAD; ?></strong>
            </td>
            <td class="col-right" style="border-bottom: none">
                Sexo: <strong style="font-size: 12px;"><?php echo $encabezado->SEXO; ?> </strong>
            </td>
            <td>
                
            </td>
        </tr>
        <tr>
            <td class="col-left" style="border-bottom: none">
                Nombre: <strong style="font-size: 12px;"> <?php echo $encabezado->NOMBRE; ?> </strong>
            </td>
            <td class="col-center" style="border-bottom: none">
                Fecha de Nacimiento: <strong style="font-size: 12px;"> <?php echo $encabezado->NACIMIENTO; ?> </strong>
            </td>
        </tr>
        <tr>
            <td class="col-center" style="border-bottom: none">
                <?php
                $fechaActual = date("d/m/Y");
                ?>
                Fecha de Resultado: <strong style="font-size: 12px;"><?php echo $fechaActual; ?>
            </td>
        </tr>
        <tr>
        </tr>
    </tbody>
</table> -->
<table class="full-width-table">
    <tbody>
        <tr>
            <td>No. Folio: <strong><?php echo $folio; ?></strong></td>
            <td>Edad: <strong><?php echo $encabezado->EDAD; ?></strong></td>
            <td>Sexo: <strong><?php echo $encabezado->SEXO; ?></strong></td>
            <td>Procedencia: <strong><?php echo $encabezado->PROCEDENCIA; ?></strong></td>
        </tr>
        <tr>
            <td colspan="2">Nombre: <strong><?php echo $encabezado->NOMBRE; ?></strong></td>
            <td>Fecha de Nacimiento: <strong><?php echo $encabezado->NACIMIENTO; ?></strong></td>
            <td>Fecha de Resultado: <strong><?php echo date("d/m/Y"); ?></strong></td>
        </tr>
    </tbody>
</table>
<!-- 
<p style="font-size: 12px; padding-left: 3.5px; margin: -1px;">
    <?php echo "Procedencia: <strong style='font-size: 12px;'> $encabezado->PROCEDENCIA"; ?> </strong>

    <?php if ($encabezado->PAQUETE_CARGADO) { ?>
        <span style="margin-left: 20px;">
            <?php echo "Paquete: <strong style='font-size: 12px;'> $encabezado->PAQUETE_CARGADO"; ?> </strong>
        </span>
    <?php } ?>

    <?php if ($encabezado->CATEGORIA) { ?>
        <span style="margin-left: 20px;">
            <?php echo "Categoría: <strong style='font-size: 12px;'> $encabezado->CATEGORIA"; ?> </strong>
        </span>
    <?php } ?>
</p> -->