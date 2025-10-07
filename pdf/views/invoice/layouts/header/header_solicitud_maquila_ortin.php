<?php
    $ruta_logo = file_get_contents('../pdf/public/assets/logo-ortin.png');
    $logo_enconde = base64_encode($ruta_logo);

    $ruta_logo_2 = file_get_contents('../pdf/public/assets/brand-ortin.png');
    $logo_enconde_2 = base64_encode($ruta_logo_2);
?>

<div class="header">
    <table class="header-container-bio" border="0" cellpadding="0" width="100%">
        <tbody>
                <tr>
                    <td align="center" style="position: relative; width: 100%;">
                        <?= "<img src='data:image/png;base64, " . $logo_enconde . "' width='150' class='logo_ortin' >"; ?>
                        <p style="font-size: 14px; font-weight: bold">
                            Solicitud de estudios por base
                        </p>
                        <?= "<img src='data:image/png;base64, " . $logo_enconde_2 . "' height='80' class='logo_ortin_brand' >"; ?>
                    </td>

                </tr>
                <tr>
                    <td align="center">
                        <span style="font-weight: bold; font-size: 11px;">
                            Nombre y clave de Laboratorio: <span style="font-size: 11px; font-weight: lighter; margin-left: 5px; display: inline-block; border-bottom: .5px solid #353535; padding-bottom: 1px; padding-left: 10px; padding-right: 10px">DIAGNOSTICO BIOMOLECULAR BIMO #24308</span>

                        </span>
                        <span style="font-weight: bold; font-size: 11px;">
                            Fecha: <span style="font-size: 11px; margin-left: 5px; display: inline-block; border-bottom: .5px solid #353535; padding-bottom: 1px; padding-left: 8px; padding-right: 8px; color: white">XXXXXXXXXXXXXX</span>
                        </span>
                    </td>
                </tr>
            </tbody>
    </table>
</div>
<style>
    .logo_ortin {
        position: absolute;
        top: 0;
        left: 0;
    }
    .logo_ortin_brand {
        position: absolute;
        top: 0;
        right: 0;
    }
</style>