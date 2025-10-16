<?php
    $ruta_logo = file_get_contents('../pdf/public/assets/logotipo.png');
    $logo_enconde = base64_encode($ruta_logo);
?>

<div class="header">
    <table class="header-container">
        <tbody>
        <tr>
            <td class="logo-maquila">
                <?= "<img src='data:image/png;base64, " . $logo_enconde . "' height='50' >"; ?>
            </td>
            <td class="banner-maquila">
                <p>SOLICITUD DE TRABAJO</p>
                <p>Laboratorio <?= $resultados[0]->LABORATORIO_NOMBRE ?></p>
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
</div>