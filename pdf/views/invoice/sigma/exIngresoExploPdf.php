<style>
    <?php include 'exIngresoExploPdf.css'; ?>
</style>
<script>
    import "@fontsource-variable/onest";
</script>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex Ingreso Explo</title>
</head>

<body>
    <table class="tableS" dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
        <colgroup>
            <col width="2092" />
            <col width="357" />
            <col width="57" />
            <col width="76" />
            <col width="303" />
            <col width="65" />
            <col width="58" />
            <col width="76" />
        </colgroup>
        <tbody>
            <tr>
                <td <?php $imagePath = 'https://bimo-lab.com/nuevo_checkup/pdf/views/invoice/sigma/Imagen1.jpg';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?> colspan="1" rowspan="1"><img class="logoSigma" src="<?= $src ?>" alt="SigmaLogo">
                </td>
                <td colspan="7" style="text-align: center; vertical-align: middle; font-weight: bold; font-size: 12px;">SISTEMA DE SALUD INTEGRAL SIGMA</td>
            </tr>
            <tr>
                <td class="tittleBoldCenter" colspan="8" rowspan="1">EXAMEN M&Eacute;DICO DE INGRESO</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1" style="text-align: center; background-color: #CCFFFF;">Marque <strong>X</strong> bajo la condici&oacute;n observada durante la <strong>Exploraci&oacute;n F&iacute;sica</strong>: Normal "N" vs. Anormal "A" o "S&iacute;" vs. "No".</td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">T&Oacute;RAX</td>
                <td class="tittleCenteredBgG">Normal</td>
                <td class="tittleCenteredBgG">Anormal</td>
                <td class="tittleCenteredBgG">Especifique</td>
                <td class="tittleBoldCenterBgG" colspan="4" rowspan="1">EXTREMIDADES</td>
            </tr>
            <tr>
                <td>Simetr&iacute;a</td>
                <td class="cent"><span id="simetriaNormalSpan">
                        <?php
                        if ($resultados[7]->{926}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="simetriaAnormalSpan">
                        <?php
                        if ($resultados[7]->{926}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="simetriaEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{926}->OBSERVACIONES)) {
                            echo $resultados[7]->{926}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td class="tittleBoldBgG">MIEM. TOR&Aacute;CICOS</td>
                <td style="text-align: center; background-color: darkgray;">Der.</td>
                <td style="text-align: center; background-color: darkgray;">Izq.</td>
                <td style="text-align: center; background-color: darkgray;">Especifique</td>
            </tr>
            <tr>
                <td>Amplexi&oacute;n</td>
                <td class="cent"><span id="amplexionNormalSpan">
                        <?php
                        if ($resultados[7]->{927}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="amplexionAnormalSpan">
                        <?php
                        if ($resultados[7]->{927}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="amplexionEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{927}->OBSERVACIONES)) {
                            echo $resultados[7]->{927}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Integridad</td>
                <td class="tittleCentered">N <span id="integridadNDerSpan">
                        <?php
                        if ($resultados[7]->{1343}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="integridadADerSpan">
                        <?php
                        if ($resultados[7]->{1343}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N <span id="integridadNIzqSpan">
                        <?php
                        if ($resultados[7]->{1443}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="integridadAIzqSpan">
                        <?php
                        if ($resultados[7]->{1443}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="integridadEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1343}->OBSERVACIONES) || isset($resultados[7]->{1443}->OBSERVACIONES)) {
                            echo $resultados[7]->{1343}->OBSERVACIONES . ' / ' . $resultados[7]->{1443}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Amplexaci&oacute;n</td>
                <td class="cent"><span id="amplexacionNormalSpan">
                        <?php
                        if ($resultados[7]->{928}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="amplexacionAnormalSpan">
                        <?php
                        if ($resultados[7]->{928}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="amplexacionEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{928}->OBSERVACIONES)) {
                            echo $resultados[7]->{928}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Movilidad</td>
                <td class="tittleCentered">N<span id="movilidadNDerSpan">
                        <?php
                        if ($resultados[7]->{135}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="movilidadADerSpan">
                        <?php
                        if ($resultados[7]->{135}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="movilidadNIzqSpan">
                        <?php
                        if ($resultados[7]->{145}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="movilidadAIzqSpan">
                        <?php
                        if ($resultados[7]->{145}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="movilidadEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{135}->OBSERVACIONES) || isset($resultados[7]->{145}->OBSERVACIONES)) {
                            echo $resultados[7]->{135}->OBSERVACIONES . ' / ' . $resultados[7]->{145}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Murmullo</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute;<span id="murmulloSiSpan">
                        <?php
                        if ($resultados[7]->{929}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No<span id="murmulloNoSpan">
                        <?php
                        if ($resultados[7]->{929}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="murmulloEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{929}->OBSERVACIONES)) {
                            echo $resultados[7]->{929}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>R.O.T.</td>
                <td class="tittleCentered">N<span id="rotNDerSpan">
                        <?php
                        if ($resultados[7]->{1344}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="rotADerSpan">
                        <?php
                        if ($resultados[7]->{1344}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="rotNIzqSpan">
                        <?php
                        if ($resultados[7]->{1444}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="rotAIzqSpan">
                        <?php
                        if ($resultados[7]->{1444}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="rotEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1344}->OBSERVACIONES) || isset($resultados[7]->{1444}->OBSERVACIONES)) {
                            echo $resultados[7]->{1344}->OBSERVACIONES . ' / ' . $resultados[7]->{1444}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Ventilaci&oacute;n</td>
                <td class="cent"><span id="ventilacionNormalSpan">
                        <?php
                        if ($resultados[7]->{930}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="ventilacionAnormalSpan">
                        <?php
                        if ($resultados[7]->{930}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="ventilacionEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{930}->OBSERVACIONES)) {
                            echo $resultados[7]->{930}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Fuerza</td>
                <td class="tittleCentered">N<span id="fuerzaNDerSpan">
                        <?php
                        if ($resultados[7]->{1345}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="fuerzaADerSpan">
                        <?php
                        if ($resultados[7]->{1345}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="fuerzaNIzqSpan">
                        <?php
                        if ($resultados[7]->{1445}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="fuerzaAIzqSpan">
                        <?php
                        if ($resultados[7]->{1445}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="fuerzaEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1345}->OBSERVACIONES) || isset($resultados[7]->{1445}->OBSERVACIONES)) {
                            echo $resultados[7]->{1345}->OBSERVACIONES . ' / ' . $resultados[7]->{1445}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">&Aacute;REA CARD&Iacute;ACA</td>
                <td class="tittleCenteredBgG">Normal</td>
                <td class="tittleCenteredBgG">Anormal</td>
                <td class="tittleCenteredBgG">Especifique</td>
                <td>Pulsos</td>
                <td class="tittleCentered">N<span id="pulsosNDerSpan">
                        <?php
                        if ($resultados[7]->{1346}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="pulsosADerSpan">
                        <?php
                        if ($resultados[7]->{1346}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="pulsosNIzqSpan">
                        <?php
                        if ($resultados[7]->{1446}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="pulsosAIzqSpan">
                        <?php
                        if ($resultados[7]->{1446}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="pulsosEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1346}->OBSERVACIONES) || isset($resultados[7]->{1446}->OBSERVACIONES)) {
                            echo $resultados[7]->{1346}->OBSERVACIONES . ' / ' . $resultados[7]->{1446}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Ritmo</td>
                <td class="cent"><span id="ritmoNormalSpan">
                        <?php
                        if ($resultados[7]->{1031}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="ritmoAnormalSpan">
                        <?php
                        if ($resultados[7]->{1031}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        }
                        ?>
                    </span></td>
                <td><span id="ritmoEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1031}->OBSERVACIONES)) {
                            echo $resultados[7]->{1031}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td class="tittleBoldBgG">MIEM. P&Eacute;LVICOS</td>
                <td style="text-align: center; background-color: darkgray;">Der.</td>
                <td style="text-align: center; background-color: darkgray;">Izq.</td>
                <td style="text-align: center; background-color: darkgray;">Especifique</td>
            </tr>
            <tr>
                <td>Intensidad</td>
                <td class="cent"><span id="intensidadNormalSpan">
                        <?php
                        if ($resultados[7]->{1032}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="intensidadAnormalSpan">
                        <?php
                        if ($resultados[7]->{1032}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="intensidadEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1032}->OBSERVACIONES)) {
                            echo $resultados[7]->{1032}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Integridad</td>
                <td class="tittleCentered">N<span id="integridadPelvNDerSpan">
                        <?php
                        if ($resultados[7]->{1543}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="integridadPelvADerSpan">
                        <?php
                        if ($resultados[7]->{1543}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="integridadPelvNIzqSpan">
                        <?php
                        if ($resultados[7]->{1643}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="integridadPelvAIzqSpan">
                        <?php
                        if ($resultados[7]->{1643}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="integridadPelvEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1543}->OBSERVACIONES) || isset($resultados[7]->{1643}->OBSERVACIONES)) {
                            echo $resultados[7]->{1543}->OBSERVACIONES . ' / ' . $resultados[7]->{1643}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Ruidos</td>
                <td class="cent"><span id="ruidosNormalSpan">
                        <?php
                        if ($resultados[7]->{1033}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="ruidosAnormalSpan">
                        <?php
                        if ($resultados[7]->{1033}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="ruidosEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1033}->OBSERVACIONES)) {
                            echo $resultados[7]->{1033}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Movilidad</td>
                <td class="tittleCentered">N<span id="movilidadPelvNDerSpan">
                        <?php
                        if ($resultados[7]->{155}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="movilidadPelvADerSpan">
                        <?php
                        if ($resultados[7]->{155}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="movilidadPelvNIzqSpan">
                        <?php
                        if ($resultados[7]->{165}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="movilidadPelvAIzqSpan">
                        <?php
                        if ($resultados[7]->{165}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="movilidadPelvEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{155}->OBSERVACIONES) || isset($resultados[7]->{165}->OBSERVACIONES)) {
                            echo $resultados[7]->{155}->OBSERVACIONES . ' / ' . $resultados[7]->{165}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Soplos</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute;<span id="soplosSiSpan">
                        <?php
                        if ($resultados[7]->{1034}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No<span id="soplosNoSpan">
                        <?php
                        if ($resultados[7]->{1034}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="soplosEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1034}->OBSERVACIONES)) {
                            echo $resultados[7]->{1034}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>R.O.T.</td>
                <td class="tittleCentered">N<span id="rotPelvNDerSpan">
                        <?php
                        if ($resultados[7]->{1544}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="rotPelvADerSpan">
                        <?php
                        if ($resultados[7]->{1544}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="rotPelvNIzqSpan">
                        <?php
                        if ($resultados[7]->{1644}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="rotPelvAIzqSpan">
                        <?php
                        if ($resultados[7]->{1644}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="rotPelvEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1544}->OBSERVACIONES) || isset($resultados[7]->{1644}->OBSERVACIONES)) {
                            echo $resultados[7]->{1544}->OBSERVACIONES . ' / ' . $resultados[7]->{1644}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">ABDOMEN</td>
                <td class="tittleCenteredBgG" colspan="2" rowspan="1"><span id="abdomenNormalSpan"></span></td>
                <td class="tittleCenteredBgG">Especifique</td>
                <td>Fuerza</td>
                <td class="tittleCentered">N<span id="fuerzaPelvNDerSpan">
                        <?php
                        if ($resultados[7]->{1545}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="fuerzaPelvADerSpan">
                        <?php
                        if ($resultados[7]->{1545}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N<span id="fuerzaPelvNIzqSpan">
                        <?php
                        if ($resultados[7]->{1645}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="fuerzaPelvAIzqSpan">
                        <?php
                        if ($resultados[7]->{1645}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="fuerzaPelvEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1545}->OBSERVACIONES) || isset($resultados[7]->{1645}->OBSERVACIONES)) {
                            echo $resultados[7]->{1545}->OBSERVACIONES . ' / ' . $resultados[7]->{1645}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Conformaci&oacute;n</td>
                <td colspan="2" rowspan="1" style="text-align: center;">Plano <span id="conformacionPlanoSpan">
                        <?php
                        if ($resultados[7]->{1135}->RESPUESTA == 'Plano') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> Globoso <span id="conformacionGlobosoSpan">
                        <?php
                        if ($resultados[7]->{1135}->RESPUESTA == 'Globoso') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> C&oacute;ncavo <span id="conformacionConcavoSpan">
                        <?php
                        if ($resultados[7]->{1135}->RESPUESTA == 'Cóncavo') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="conformacionEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1135}->OBSERVACIONES)) {
                            echo $resultados[7]->{1135}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Pulsos / Hinchazón</td>
                <td class="tittleCentered">N <span id="pulsosHinchazonNDerSpan">
                        <?php
                        if ($resultados[7]->{1546}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="pulsosHinchazonADerSpan">
                        <?php
                        if ($resultados[7]->{1546}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td class="tittleCentered">N <span id="pulsosHinchazonNIzqSpan">
                        <?php
                        if ($resultados[7]->{1646}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> A <span id="pulsosHinchazonAIzqSpan">
                        <?php
                        if ($resultados[7]->{1646}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="puntInchEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1546}->OBSERVACIONES) || isset($resultados[7]->{1646}->OBSERVACIONES)) {
                            echo $resultados[7]->{1546}->OBSERVACIONES . ' / ' . $resultados[7]->{1646}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Peristalsis</td>
                <td class="tittleCentered" colspan="2" rowspan="1">Normal <span id="peristalsisNormalSpan">
                        <?php
                        if ($resultados[7]->{1136}->RESPUESTA == 'Normal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> Anormal <span id="peristalsisAnormalSpan">
                        <?php
                        if ($resultados[7]->{1136}->RESPUESTA == 'Anormal') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="peristalisisEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1136}->OBSERVACIONES)) {
                            echo $resultados[7]->{1136}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td class="tittleBoldBgG">PIEL Y ANEXOS</td>
                <td class="tittleCenteredBgG">Normal</td>
                <td class="tittleCenteredBgG">Anormal</td>
                <td class="tittleCenteredBgG">Especifique</td>
            </tr>
            <tr>
                <td>Visceromegalias</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="visceromegaliasSiSpan">
                        <?php
                        if ($resultados[7]->{1137}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="visceromegaliasNoSpan">
                        <?php
                        if ($resultados[7]->{1137}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="visceromegaliasEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1137}->OBSERVACIONES)) {
                            echo $resultados[7]->{1137}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Dermis</td>
                <td class="cent"><span id="dermisNormalSpan">
                        <?php
                        if ($resultados[7]->{1747}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="dermisAnormalSpan">
                        <?php
                        if ($resultados[7]->{1747}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="dermisEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1747}->OBSERVACIONES)) {
                            echo $resultados[7]->{1747}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Hernias umbilical/inguinal</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="herniasSiSpan">
                        <?php
                        if ($resultados[7]->{1138}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="herniasNoSpan">
                        <?php
                        if ($resultados[7]->{1138}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="herniasUmbIngEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1138}->OBSERVACIONES)) {
                            echo $resultados[7]->{1138}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Cabello</td>
                <td class="cent"><span id="cabelloNormalSpan">
                        <?php
                        if ($resultados[7]->{1748}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="cabelloAnormalSpan">
                        <?php
                        if ($resultados[7]->{1748}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="cabelloEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1748}->OBSERVACIONES)) {
                            echo $resultados[7]->{1748}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Otros</td>
                <td colspan="3" rowspan="1"><span id="abdomenOtrosSpan">
                        <?php
                        if (isset($resultados[7]->{1139}->OBSERVACIONES)) {
                            echo $resultados[7]->{1139}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>U&ntilde;as</td>
                <td class="cent"><span id="unasNormalSpan">
                        <?php
                        if ($resultados[7]->{1749}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="unasAnormalSpan">
                        <?php
                        if ($resultados[7]->{1749}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="unasEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1749}->OBSERVACIONES)) {
                            echo $resultados[7]->{1749}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">COLUMNA LUMBOSACRA</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Normal</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Anormal</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Especifique</td>
                <td style="vertical-align: middle;">Dermatosis</td>
                <td style="vertical-align: middle; text-align: center;">Si <span id="dermatosisSiSpan">
                        <?php
                        if ($resultados[7]->{1750}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="dermatosisNoSpan">
                        <?php
                        if ($resultados[7]->{1750}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td>&nbsp;</td>
                <td><span id="dermatosisEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1750}->OBSERVACIONES)) {
                            echo $resultados[7]->{1750}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Conformaci&oacute;n</td>
                <td class="cent"><span id="conformacionNormalSpan">
                        <?php
                        if ($resultados[7]->{1235}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="conformacionAnormalSpan">
                        <?php
                        if ($resultados[7]->{1235}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="conformacionEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1235}->OBSERVACIONES)) {
                            echo $resultados[7]->{1235}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Dermatitis</td>
                <td class="tittleCentered">Si <span id="dermatitisSiSpan">
                        <?php
                        if ($resultados[7]->{1751}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="dermatitisNoSpan">
                        <?php
                        if ($resultados[7]->{1751}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td>&nbsp;</td>
                <td><span id="dermatitisEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1751}->OBSERVACIONES)) {
                            echo $resultados[7]->{1751}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Arcos de mov.</td>
                <td class="cent"><span id="arcosMovNormalSpan">
                        <?php
                        if ($resultados[7]->{1240}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="arcosMovAnormalSpan">
                        <?php
                        if ($resultados[7]->{1240}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="arcosMovEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1240}->OBSERVACIONES)) {
                            echo $resultados[7]->{1240}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Tatuajes</td>
                <td class="tittleCentered">Si <span id="tatuajesSiSpan">
                        <?php
                        if ($resultados[7]->{1752}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="tatuajesNoSpan">
                        <?php
                        if ($resultados[7]->{1752}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td>&nbsp;</td>
                <td><span id="tatuajesEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1752}->OBSERVACIONES)) {
                            echo $resultados[7]->{1752}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Marcha</td>
                <td class="cent"><span id="marchaNormalSpan">
                        <?php
                        if ($resultados[7]->{1241}->RESPUESTA == 'Normal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="marchaAnormalSpan">
                        <?php
                        if ($resultados[7]->{1241}->RESPUESTA == 'Anormal') {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td><span id="marchaEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1241}->OBSERVACIONES)) {
                            echo $resultados[7]->{1241}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>Cicatrices</td>
                <td colspan="1" class="tittleCentered">Si <span id="cicatricesSiSpan">
                        <?php
                        if ($resultados[7]->{1753}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="cicatricesNoSpan">
                        <?php
                        if ($resultados[7]->{1753}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                <td>&nbsp;</td>
                </span></td>
                <td><span id="cicatricesEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1753}->OBSERVACIONES)) {
                            echo $resultados[7]->{1753}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td>Puntos dolorosos</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="puntosDolorososSiSpan">
                        <?php
                        if ($resultados[7]->{1242}->RESPUESTA == 'Sí') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span> No <span id="puntosDolorososNoSpan">
                        <?php
                        if ($resultados[7]->{1242}->RESPUESTA == 'No') {
                            echo '( x )';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td><span id="puntosDolorososEspecifiqueSpan">
                        <?php
                        if (isset($resultados[7]->{1242}->OBSERVACIONES)) {
                            echo $resultados[7]->{1242}->OBSERVACIONES;
                        }
                        ?>
                    </span></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="2" rowspan="1">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="tittleBoldCenterBgG" colspan="8" rowspan="1">INTERPRETACI&Oacute;N DE RESULTADOS DE LABORATORIO</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Cuenta Roja (BH):</td>
                <td colspan="2" rowspan="1"><span id="cuentaRojaSpan">
                        <?php
                        if (isset($resultados[8]->CUENTA_ROJA)) {
                            echo $resultados[8]->CUENTA_ROJA;
                        }
                        ?>
                    </span></td>
                </span></td>
                <td colspan="2" rowspan="1">Audiometr&iacute;a: (s&oacute;lo si amerita)</td>
                <td colspan="2" rowspan="1"><span id="audiometriaSpan">
                        <?php
                        if (isset($resultados[8]->AUDIOMETRIA)) {
                            echo $resultados[8]->AUDIOMETRIA;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">General de Orina:</td>
                <td colspan="2" rowspan="1"><span id="generalOrinaSpan">
                        <?php
                        if (isset($resultados[8]->GENERAL_ORINA)) {
                            echo $resultados[8]->GENERAL_ORINA;
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">Otros:</td>
                <td colspan="2" rowspan="1"><span id="intOtrosSpan">
                        <?php
                        if (isset($resultados[8]->OTROS)) {
                            echo $resultados[8]->OTROS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Qu&iacute;m. Sang. 6 elem.:</td>
                <td colspan="2" rowspan="1">
                    <span id="quimSang6ElemSpan">
                        <?php
                        if (isset($resultados[8]->QUIMICA_SANGUINEA)) {
                            echo $resultados[8]->QUIMICA_SANGUINEA;
                        }
                        ?>
                    </span>
                </td>
                <td class="tittleCenteredBgP" colspan="4" rowspan="1">S&oacute;lo personal designado a &Aacute;reas Cr&iacute;ticas HACCP</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Radiograf&iacute;a de T&oacute;rax (AP y lateral de columna)</td>
                <td colspan="2" rowspan="1"><span id="radiografiaToraxSpan">
                        <?php
                        if (isset($resultados[8]->RADIOGRAFIA_TORAX)) {
                            echo $resultados[8]->RADIOGRAFIA_TORAX;
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">REACCIONES FEBRILES:</td>
                <td colspan="2"><span id="reaccionesFebrilesSpan">
                        <?php
                        if (isset($resultados[8]->REACCIONES_FEBRILES)) {
                            echo $resultados[8]->REACCIONES_FEBRILES;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="BgP" colspan="2" rowspan="1">VIH:</td>
                <td colspan="2" rowspan="1"><span id="vihSapn">
                        <?php
                        if (isset($resultados[8]->VIH)) {
                            echo $resultados[8]->VIH;
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">VDRL:</td>
                <td colspan="2" rowspan="1"><span id="vdrlSpan">
                        <?php
                        if (isset($resultados[8]->VDRL)) {
                            echo $resultados[8]->VDRL;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="BgP" colspan="2" rowspan="1">Antidoping 5 parámetros: Marihuana (THC), Coca&iacute;na (COC), Anfetaminas (AMP)<br /> Metanfetaminas (mAMP) Opioides (OPI) y Fenciclidina (PCP)</td>
                <td style="vertical-align: middle;" colspan="2" rowspan="1"><span id="antidopingSpan">
                        <?php
                        if (isset($resultados[8]->ANTIDOPING)) {
                            echo $resultados[8]->ANTIDOPING;
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1" style="vertical-align: middle;">COPRO:</td>
                <td style="vertical-align: middle;" colspan="2"><span id="coproSpan">
                        <?php
                        if (isset($resultados[8]->COPRO)) {
                            echo $resultados[8]->COPRO;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Tipo de Sangre:</td>
                <td colspan="2" rowspan="1"><span id="tipoSangreSpan">
                        <?php
                        if (isset($resultados[8]->TIPO_SANGRE)) {
                            echo $resultados[8]->TIPO_SANGRE;
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">EXUDADO FARINGEO:</td>
                <td colspan="2" rowspan="1"><span id="exuadoFarinSpan">
                        <?php
                        if (isset($resultados[8]->EXUDADO_FARINGEO)) {
                            echo $resultados[8]->EXUDADO_FARINGEO;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBold" colspan="8" rowspan="1">
                    <div>Apegando a REGLAMENTO DE LA LEY FEDERAL DE PROTECCI&Oacute;N DE DATOS PERSONALES EN POSESI&Oacute;N DE LOS PARTICULARES &ldquo;La informaci&oacute;n contenida en este documento es estrictamente confidencial y propiedad de Sigma Alimentos; queda prohibida su utilizaci&oacute;n total o parcial para cualquier fin ajeno a la empresa&rdquo;<br /> <br /> Nombre y Firma del Aspirante:<span id="nombreFirmaAspiranteSpan">__________________________________________________________________________________________________</span></div>
                </td>
            </tr>
            <tr>
                <td class="tittleBoldCenterBgG" colspan="8" rowspan="1">DIAGN&Oacute;STICO Y OBSERVACIONES</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1"><span id="diagObserSpan">
                        <?php
                        // if (isset($resultados[10]->NOTAS_PADECIMIENTO) || isset($resultados[10]->DIAGNOSTICO)) {
                        //     echo $resultados[10]->DIAGNOSTICO . ' / ' . $resultados[10]->NOTAS_PADECIMIENTO;
                        // }
                        echo $resultados[12]->OBSERVACIONES;
                        ?>
                    </span></td>
                </span></td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">Formato 5 - 3</td>
            </tr>
        </tbody>
    </table>
</body>

</html>