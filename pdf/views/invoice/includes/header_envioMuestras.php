<br>

<table>
    <tbody>
        <tr>
            <td class="col-der" style="border-bottom: none; text-align: center; color: #054d60">
                <h4>
                    Diagnóstico Biomolecular <br>
                    Coordinación de Laboratorios<br>
                    Formato para el Envio de Muestras<br>
                    FLB-02-DB
                </h4>
            </td>
            <td class="col-izq" style="border-bottom: none; text-align:center;">
                <?php
                echo "<img src='data:image/png;base64, " . $encode . "' height='75' >";
                // echo "<img src='data:image/png;base64," . $barcode . "' height='75'>";
                ?>

            </td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td style="text-align: center; border-bottom: solid; ">
            </td>
        </tr>
    </tbody>
</table>

<table style="color: #054d60">
    <tbody>
        <tr>
            <td class="col-right" style="border-bottom: none; padding-left: 156%;">
                <p> Folio: <strong style="font-size: 13px;"><?php echo $encabezado->SEXO; ?> </strong></p>
            </td>
        </tr>

        <tr>
            <td class="col-two-left" style="border-bottom: none;">
                <p> Unidad Solicitante: <strong style="font-size: 13px;"> <?php echo $encabezado->NOMBRE; ?> </strong></p>
            </td>
            <td class="col-two-right" style="border-bottom: none;">
                <p> Fecha de Recolección o Envío de Muestras: <strong style="font-size: 13px; border-bottom: 1px solid black;"></strong></p>
            </td>

        </tr>

        <tr>
            <td class="col-two-left" style="border-bottom: none;">
                <p> Correo para resultados: <strong style="font-size: 13px;"> <?php echo $encabezado->FECHA_RESULTADO; ?> </strong></p>
            </td>

            <td class="col-two-left" style="border-bottom: none">
                <p> Fecha de Resultado: <strong style="font-size: 13px;"> <?php echo $encabezado->FECHA_RESULTADO; ?> </strong></p>
            </td>
    </tbody>
</table>