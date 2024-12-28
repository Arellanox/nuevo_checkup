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
                    $imagePath = 'http://localhost/nuevo_checkup/pdf/views/invoice/sigma/Imagen2.png';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?>
                    <div style="position: relative; text-align: left; display: inline-block; margin-left: 0;">
                        <img src="<?= $src ?>" alt="Cuerpo Humano" style="width: 100%; max-width: 600px;">

                        <!-- Frontal -->
                        <span style="position: absolute; top: 7%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{1}->DETALLE_LESION)) {
                                echo $resultados[11]->{1}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 11%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{2}->DETALLE_LESION)) {
                                echo $resultados[11]->{2}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 13%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{18}->DETALLE_LESION)) {
                                echo $resultados[11]->{18}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 13%; left: 25%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{19}->DETALLE_LESION)) {
                                echo $resultados[11]->{19}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 15%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{20}->DETALLE_LESION)) {
                                echo $resultados[11]->{20}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 19%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{21}->DETALLE_LESION)) {
                                echo $resultados[11]->{21}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 25%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{11}->DETALLE_LESION)) {
                                echo $resultados[11]->{11}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 32%; left: 18%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{22}->DETALLE_LESION)) {
                                echo $resultados[11]->{22}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{23}->DETALLE_LESION)) {
                                echo $resultados[11]->{23}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 30%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{24}->DETALLE_LESION)) {
                                echo $resultados[11]->{24}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 28%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{25}->DETALLE_LESION)) {
                                echo $resultados[11]->{25}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 28%; left: 30%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{26}->DETALLE_LESION)) {
                                echo $resultados[11]->{26}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 35%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{27}->DETALLE_LESION)) {
                                echo $resultados[11]->{27}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 35%; left: 30%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{28}->DETALLE_LESION)) {
                                echo $resultados[11]->{28}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 39%; left: 7%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{29}->DETALLE_LESION)) {
                                echo $resultados[11]->{29}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 39%; left: 23%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{30}->DETALLE_LESION)) {
                                echo $resultados[11]->{30}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 45%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{31}->DETALLE_LESION)) {
                                echo $resultados[11]->{31}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 45%; left: 25%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{32}->DETALLE_LESION)) {
                                echo $resultados[11]->{32}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 50%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{33}->DETALLE_LESION)) {
                                echo $resultados[11]->{33}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 50%; left: 25%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{34}->DETALLE_LESION)) {
                                echo $resultados[11]->{34}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 58%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{35}->DETALLE_LESION)) {
                                echo $resultados[11]->{35}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 58%; left: 25%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{36}->DETALLE_LESION)) {
                                echo $resultados[11]->{36}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 60%; left: 5%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{37}->DETALLE_LESION)) {
                                echo $resultados[11]->{37}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 60%; left: 25%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{38}->DETALLE_LESION)) {
                                echo $resultados[11]->{38}->DETALLE_LESION;
                            }
                            ?>
                        </span>

                        <!-- Posterior -->
                        <span style="position: absolute; top: 7%; left: 78%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{78}->DETALLE_LESION)) {
                                echo $resultados[11]->{78}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 11%; left: 78%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{79}->DETALLE_LESION)) {
                                echo $resultados[11]->{79}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 13%; left: 65%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{81}->DETALLE_LESION)) {
                                echo $resultados[11]->{81}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 13%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{80}->DETALLE_LESION)) {
                                echo $resultados[11]->{80}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 65%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{88}->DETALLE_LESION)) {
                                echo $resultados[11]->{88}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 93%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{87}->DETALLE_LESION)) {
                                echo $resultados[11]->{87}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 24%; left: 65%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{90}->DETALLE_LESION)) {
                                echo $resultados[11]->{90}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 24%; left: 93%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{89}->DETALLE_LESION)) {
                                echo $resultados[11]->{89}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 28%; left: 65%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{92}->DETALLE_LESION)) {
                                echo $resultados[11]->{92}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 28%; left: 93%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{91}->DETALLE_LESION)) {
                                echo $resultados[11]->{91}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 15%; left: 78%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{85}->DETALLE_LESION)) {
                                echo $resultados[11]->{85}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 78%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{82}->DETALLE_LESION)) {
                                echo $resultados[11]->{82}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 27%; left: 78%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{86}->DETALLE_LESION)) {
                                echo $resultados[11]->{86}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 32%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{84}->DETALLE_LESION)) {
                                echo $resultados[11]->{84}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 32%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{83}->DETALLE_LESION)) {
                                echo $resultados[11]->{83}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 37%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{95}->DETALLE_LESION)) {
                                echo $resultados[11]->{95}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 37%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{94}->DETALLE_LESION)) {
                                echo $resultados[11]->{94}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 45%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{97}->DETALLE_LESION)) {
                                echo $resultados[11]->{97}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 45%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{96}->DETALLE_LESION)) {
                                echo $resultados[11]->{96}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 50%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{99}->DETALLE_LESION)) {
                                echo $resultados[11]->{99}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 50%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{98}->DETALLE_LESION)) {
                                echo $resultados[11]->{98}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 58%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{101}->DETALLE_LESION)) {
                                echo $resultados[11]->{101}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 58%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{100}->DETALLE_LESION)) {
                                echo $resultados[11]->{100}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 60%; left: 75%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{103}->DETALLE_LESION)) {
                                echo $resultados[11]->{103}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 60%; left: 85%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{102}->DETALLE_LESION)) {
                                echo $resultados[11]->{102}->DETALLE_LESION;
                            }
                            ?>
                        </span>

                        <!-- Lateral -->
                        <span style="position: absolute; top: 7%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{104}->DETALLE_LESION)) {
                                echo $resultados[11]->{104}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 11%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{105}->DETALLE_LESION)) {
                                echo $resultados[11]->{105}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 14%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{115}->DETALLE_LESION)) {
                                echo $resultados[11]->{115}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 16%; left: 53%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{106}->DETALLE_LESION)) {
                                echo $resultados[11]->{106}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 20%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{107}->DETALLE_LESION)) {
                                echo $resultados[11]->{107}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 24%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{108}->DETALLE_LESION)) {
                                echo $resultados[11]->{108}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 28%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{109}->DETALLE_LESION)) {
                                echo $resultados[11]->{109}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 37%; left: 45%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{110}->DETALLE_LESION)) {
                                echo $resultados[11]->{110}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 45%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{111}->DETALLE_LESION)) {
                                echo $resultados[11]->{111}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 50%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{112}->DETALLE_LESION)) {
                                echo $resultados[11]->{112}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 58%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{113}->DETALLE_LESION)) {
                                echo $resultados[11]->{113}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                        <span style="position: absolute; top: 60%; left: 48%; color: white; font-weight: bold; background-color: #B30101; border-radius: 50%; padding: 2px 5px;">
                            <?php
                            if (isset($resultados[11]->{114}->DETALLE_LESION)) {
                                echo $resultados[11]->{114}->DETALLE_LESION;
                            }
                            ?>
                        </span>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Valoración de Condición:</td>
                <td style="text-align: center;"><span id="valorCondicionMesesSpan">
                        <?php
                        if (isset($resultados[12]->VALORACION_MESES)) {
                            echo $resultados[12]->VALORACION_MESES;
                        } else
                            echo "______";
                        ?>
                    </span> meses.</td>
                </span> meses.</td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan=" 3" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Apto</td>
                <td class="tittleCentered"><span id="aptoSpan">
                        <?php
                        if ($resultados[12]->VALORACION == "APTO") {
                            echo "(x)";
                        } else {
                            echo "( )";
                        }
                        ?>
                    </span></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">No Apto</td>
                <td class="tittleCentered"><span id="noAptoSpan">
                        <?php
                        if ($resultados[12]->VALORACION == "NO APTO") {
                            echo "(x)";
                        } else {
                            echo "( )";
                        }
                        ?>
                    </span></td>
                <td><span></span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Apto Condicionado</td>
                <td class="tittleCentered"><span id="condicionadoSpan">
                        <?php
                        if ($resultados[12]->VALORACION == "APTO CONDICIONADO") {
                            echo "(x)";
                        } else {
                            echo "( )";
                        }
                        ?>
                    </span></td>
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