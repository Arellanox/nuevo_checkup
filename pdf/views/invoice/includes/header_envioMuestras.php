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
            <td class="col-two-left" style="border-bottom: none;">
                <br>
            </td>
            <td class="col-two-right" style="border-bottom: none; text-align:right;padding-bottom: 20px; padding-top: 20px">
                <p> Folio: <strong style="font-size: 13px;"><?php echo $resultados->FOLIO; ?> </strong></p>
            </td>
        </tr>

        <tr>
            <td class="col-two-left" style="border-bottom: none;">
                <p> Unidad Solicitante: <strong style="font-size: 13px;"> <?php echo $resultados->UNIDAD_SOLICITANTE; ?> </strong></p>
            </td>
            <td class="col-two-right" style="border-bottom: none;">
                <p> Fecha de Recolección o Envío de Muestras: <strong style="font-size: 13px;"><?php echo $resultados->FECHA_ENVIO; ?></strong></p>
            </td>

        </tr>

        <tr>
            <td class="col-two-left" style="border-bottom: none;">
                <p> Correo para resultados: <strong style="font-size: 13px;"> <?php echo $resultados->CORREO_ENVIAR_RESULTADOS; ?> </strong></p>
            </td>

            <td class="col-two-left" style="border-bottom: none">
                <p> Hora de Recolección o Envío de Muestras:: <strong style="font-size: 13px;"> <?php echo $resultados->HORA_ENVIO; ?> </strong></p>
            </td>
    </tbody>
</table>
