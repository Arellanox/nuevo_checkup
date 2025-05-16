<?php
    $ruta_logo = file_get_contents('../pdf/public/assets/logotipo.png');
    $logo_enconde = base64_encode($ruta_logo);
?>
<div class="header">
    <table>
        <thead>
            <tr class="titulo">
                <th>
                    <?= "<img class='float-logo' src='data:image/png;base64, " . $logo_enconde . "' height='55' >"; ?>
                    <?= $titulo ?>
                </th>
            </tr>
            <tr class="subtitle">
                <th>
                    <?= $subtitle ?>
                </th>
            </tr>
        </thead>
    </table>
</div>
