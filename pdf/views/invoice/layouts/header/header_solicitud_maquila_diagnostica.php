<?php
$ruta_logo = file_get_contents('../pdf/public/assets/diagnostica_logo.png');
$ruta_aniversario = file_get_contents('../pdf/public/assets/diagnostica-lema_&_aniversario.png');
$ruta_lema = file_get_contents('../pdf/public/assets/diagnostica_lema.png');

$logo_enconde = base64_encode($ruta_logo);
$aniversario_enconde = base64_encode($ruta_aniversario);
$lema_enconde = base64_encode($ruta_lema);
?>

<div class="header">
    <table class="header-container">
        <tbody>
        <tr>
            <td class="logo-maquila">
                <?= "<img src='data:image/png;base64, " . $logo_enconde . "' height='45' >"; ?>
            </td>
            <td class="banner-maquila">
                <p>SOLICITUD DE TRABAJO</p>
                <p>Laboratorio Clínico del Mar</p>
                <p>Laboratorios BIMO</p>
            </td>
            <td  class="data-maquila">
                <div class="clave-maquila">
                    <p class="label">Clave Maquila</p>
                    <p class="data-result">BIMO</p>
                </div>
                <div class="fecha-maquila">
                    <p class="label">Fecha de Envío</p>
                    <p class="data-result"><?= $resultados[0][0]->FECHA_ENVIO ?></p>
                </div>
            </td>
        </tr>
        <tr class="banner-footer">
            <td></td>
            <td></td>
            <td></td>
        </tr>
        </tbody>
    </table>

    <?= "<img class='float-img' src='data:image/png;base64, " . $aniversario_enconde . "' height='40' >"; ?>
</div>