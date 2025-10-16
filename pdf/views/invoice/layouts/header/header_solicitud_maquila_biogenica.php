<?php
$ruta_logo = file_get_contents('../pdf/public/assets/logo-biogenica.png');
$logo_enconde = base64_encode($ruta_logo);
?>

<div class="header">
    <table class="header-container-bio" border="0" cellpadding="0">
        <tbody>
            <tr>
                <td>
                    <?= "<img src='data:image/png;base64, " . $logo_enconde . "' height='60' >"; ?>
                </td>
                <td class="data-maquila-bio">
                    <div class="clave-maquila-bio">
                        <p class="data-result">Nombre de Maquila</p>
                        <p class="label">Diagnostico Biomolecular</p>
                    </div>
                    <div class="fecha-maquila-bio">
                        <p class="data-result">Fecha de Envío</p>
                        <p class="label"><?= $resultados[0][0]->FECHA_ENVIO ?></p>
                    </div>
                </td>
            </tr>
            </tbody>
    </table>
</div>
