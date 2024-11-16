<style>
    <?php include 'esqDiagPdf.css'; ?>
</style>
<script>
    import "@fontsource-variable/onest";
</script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esq. Diag.</title>
</head>

<body>
    <table dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
        <colgroup>
            <col width="426" />
            <col width="106" />
        </colgroup>
        <tbody>
            <tr>
                <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
                <td class="tittleBoldCenteredBgG" colspan="3" rowspan="1">Exploraci&oacute;n F&iacute;sica</td>
            </tr>
            <tr>
                <td class="tittleCentered" colspan="3" rowspan="1">Marcar en el esquema datos encontrados durante la exploraci&oacute;n f&iacute;sica.</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1" style="text-align: center;">
                    <?php
                    $imagePath = 'assets/project/Imagen2.jpg';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?>
                    <img class="imgc" src="<?= $src ?>" alt="">
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Valoración de Condición:</td>
                <td style="text-align: center;"><span id="valorCondicionMesesSpan">______</span> meses.</td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan=" 3" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Apto</td>
                <td class="tittleCentered"><span id="aptoSpan">( )</span></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">No Apto</td>
                <td class="tittleCentered"><span id="noAptoSpan">( )</span></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Apto Condicionado</td>
                <td class="tittleCentered"><span id="condicionadoSpan">( )</span></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1" style="text-align: center;"><span id="medicoResponsableSpan">____________</span></td>
                <td colspan="1" rowspan="1" style="text-align: center;"><span id="cedulaProfesionalSpan">____________</span></td>
                <td colspan="1" rowspan="1" style="text-align: center;"><span id="firmaSpan">____________</span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1" style="text-align: center;">Medico Responsable</td>
                <td colspan="1" rowspan="1" style="text-align: center;">Cédula Profesional</td>
                <td colspan="1" rowspan="1" style="text-align: center;">Firma</td>
            </tr>

            <tr>
                <td colspan="3" rowspan="1">
                    <div>Formato 5 -4</div>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>