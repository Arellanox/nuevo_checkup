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
<table>
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
</table>
<p style="font-size: 12px; padding-left: 3.5px; margin: -1px;">
    <?php echo "Procedencia: <strong style='font-size: 12px;'> $encabezado->PROCEDENCIA"; ?> </strong>

    <?php if ($encabezado->PAQUETE_CARGADO) { ?>
        <span style="margin-left: 20px;">
            <!-- Tipo de muestra  -->
            <?php echo "Paquete: <strong style='font-size: 12px;'> $encabezado->PAQUETE_CARGADO"; ?> </strong>
        </span>
    <?php } ?>

    <?php if ($encabezado->CATEGORIA) { ?>
        <span style="margin-left: 20px;">
            <!-- Tipo de muestra  -->
            <?php echo "Categoría: <strong style='font-size: 12px;'> $encabezado->CATEGORIA"; ?> </strong>
        </span>
    <?php } ?>
</p>