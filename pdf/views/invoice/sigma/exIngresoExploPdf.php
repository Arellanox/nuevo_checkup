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
    <table dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
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
                <td <?php $imagePath = 'assets/project/Imagen1.jpg';
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
                <td><span id="simetriaNormalSpan"></span></td>
                <td><span id="simetriaAnormalSpan"></span></td>
                <td><span id="simetriaEspecifiqueSpan"></span></td>
                <td class="tittleBoldBgG">MIEM. TOR&Aacute;CICOS</td>
                <td style="text-align: center; background-color: darkgray;">Der.</td>
                <td style="text-align: center; background-color: darkgray;">Izq.</td>
                <td style="text-align: center; background-color: darkgray;">Especifique</td>
            </tr>
            <tr>
                <td>Amplexi&oacute;n</td>
                <td><span id="amplexionNormalSpan"></span></td>
                <td><span id="amplexionAnormalSpan"></span></td>
                <td><span id="amplexionEspecifiqueSpan"></span></td>
                <td>Integridad</td>
                <td class="tittleCentered">N <span id="integridadNDerSpan">( )</span> A <span id="integridadADerSpan">( )</span></td>
                <td class="tittleCentered">N <span id="integridadNIzqSpan">( )</span> A <span id="integridadAIzqSpan">( )</span></td>
                <td><span id="integridadEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Amplexaci&oacute;n</td>
                <td><span id="amplexacionNormalSpan"></span></td>
                <td><span id="amplexacionAnormalSpan"></span></td>
                <td><span id="amplexacionEspecifiqueSpan"></span></td>
                <td>Movilidad</td>
                <td class="tittleCentered">N<span id="movilidadNDerSpan">( )</span> A <span id="movilidadADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="movilidadNIzqSpan">( )</span> A <span id="movilidadAIzqSpan">( )</span></td>
                <td><span id="movilidadEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Murmullo</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute;<span id="murmulloSiSpan">( )</span> No<span id="murmulloNoSpan">( )</span></td>
                <td><span id="murmulloEspecifiqueSpan"></span></td>
                <td>R.O.T.</td>
                <td class="tittleCentered">N<span id="rotNDerSpan">( )</span> A <span id="rotADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="rotNIzqSpan">( )</span> A <span id="rotAIzqSpan">( )</span></td>
                <td><span id="rotEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Ventilaci&oacute;n</td>
                <td><span id="ventilacionNormalSpan"></span></td>
                <td><span id="ventilacionAnormalSpan"></span></td>
                <td><span id="ventilacionEspecifiqueSpan"></span></td>
                <td>Fuerza</td>
                <td class="tittleCentered">N<span id="fuerzaNDerSpan">( )</span> A <span id="fuerzaADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="fuerzaNIzqSpan">( )</span> A <span id="fuerzaAIzqSpan">( )</span></td>
                <td><span id="fuerzaEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">&Aacute;REA CARD&Iacute;ACA</td>
                <td class="tittleCenteredBgG">Normal</td>
                <td class="tittleCenteredBgG">Anormal</td>
                <td class="tittleCenteredBgG">Especifique</td>
                <td>Pulsos</td>
                <td class="tittleCentered">N<span id="pulsosNDerSpan">( )</span> A <span id="pulsosADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="pulsosNIzqSpan">( )</span> A <span id="pulsosAIzqSpan">( )</span></td>
                <td><span id="pulsosEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Ritmo</td>
                <td><span id="ritmoNormalSpan"></span></td>
                <td><span id="ritmoAnormalSpan"></span></td>
                <td><span id="ritmoEspecifiqueSpan"></span></td>
                <td class="tittleBoldBgG">MIEM. P&Eacute;LVICOS</td>
                <td style="text-align: center; background-color: darkgray;">Der.</td>
                <td style="text-align: center; background-color: darkgray;">Izq.</td>
                <td style="text-align: center; background-color: darkgray;">Especifique</td>
            </tr>
            <tr>
                <td>Intensidad</td>
                <td><span id="intensidadNormalSpan"></span></td>
                <td><span id="intensidadAnormalSpan"></span></td>
                <td><span id="intensidadEspecifiqueSpan"></span></td>
                <td>Integridad</td>
                <td class="tittleCentered">N<span id="integridadPelvNDerSpan">( )</span> A <span id="integridadPelvADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="integridadPelvNIzqSpan">( )</span> A <span id="integridadPelvAIzqSpan">( )</span></td>
                <td><span id="integridadPelvEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Ruidos</td>
                <td><span id="ruidosNormalSpan"></span></td>
                <td><span id="ruidosAnormalSpan"></span></td>
                <td><span id="ruidosEspecifiqueSpan"></span></td>
                <td>Movilidad</td>
                <td class="tittleCentered">N<span id="movilidadPelvNDerSpan">( )</span> A <span id="movilidadPelvADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="movilidadPelvNIzqSpan">( )</span> A <span id="movilidadPelvAIzqSpan">( )</span></td>
                <td><span id="movilidadPelvEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Soplos</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute;<span id="soplosSiSpan">( )</span> No<span id="soplosNoSpan">( )</span></td>
                <td><span id="soplosEspecifiqueSpan"></span></td>
                <td>R.O.T.</td>
                <td class="tittleCentered">N<span id="rotPelvNDerSpan">( )</span> A <span id="rotPelvADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="rotPelvNIzqSpan">( )</span> A <span id="rotPelvAIzqSpan">( )</span></td>
                <td><span id="rotPelvEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">ABDOMEN</td>
                <td class="tittleCenteredBgG" colspan="2" rowspan="1"><span id="abdomenNormalSpan"></span></td>
                <td class="tittleCenteredBgG">Especifique</td>
                <td>Fuerza</td>
                <td class="tittleCentered">N<span id="fuerzaPelvNDerSpan">( )</span> A <span id="fuerzaPelvADerSpan">( )</span></td>
                <td class="tittleCentered">N<span id="fuerzaPelvNIzqSpan">( )</span> A <span id="fuerzaPelvAIzqSpan">( )</span></td>
                <td><span id="fuerzaPelvEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Conformaci&oacute;n</td>
                <td colspan="3" rowspan="1" style="text-align: center;">Plano <span id="conformacionPlanoSpan">( )</span> Globoso <span id="conformacionGlobosoSpan">( )</span> C&oacute;ncavo <span id="conformacionConcavoSpan">( )</span></td>
                <td>Pulsos / Hinchazón</td>
                <td class="tittleCentered">N <span id="pulsosHinchazonNDerSpan">( )</span> A <span id="pulsosHinchazonADerSpan">( )</span></td>
                <td class="tittleCentered">N <span id="pulsosHinchazonNIzqSpan">( )</span> A <span id="pulsosHinchazonAIzqSpan">( )</span></td>
                <td><span id="puntInchEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Peristalsis</td>
                <td class="tittleCentered" colspan="2" rowspan="1">Normal <span id="peristalsisNormalSpan">( )</span> Anormal <span id="peristalsisAnormalSpan">( )</span></td>
                <td><span id="peristalisisEspecifiqueSpan"></span></td>
                <td class="tittleBoldBgG">PIEL Y ANEXOS</td>
                <td class="tittleCenteredBgG">Normal</td>
                <td class="tittleCenteredBgG">Anormal</td>
                <td class="tittleCenteredBgG">Especifique</td>
            </tr>
            <tr>
                <td>Visceromegalias</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="visceromegaliasSiSpan">( )</span> No <span id="visceromegaliasNoSpan">( )</span></td>
                <td><span id="visceromegaliasEspecifiqueSpan"></span></td>
                <td>Dermis</td>
                <td><span id="dermisNormalSpan"></span></td>
                <td><span id="dermisAnormalSpan"></span></td>
                <td><span id="dermisEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Hernias umbilical/inguinal</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="herniasSiSpan">( )</span> No <span id="herniasNoSpan">( )</span></td>
                <td><span id="herniasUmbIngEspecifiqueSpan"></span></td>
                <td>Cabello</td>
                <td><span id="cabelloNormalSpan"></span></td>
                <td><span id="cabelloAnormalSpan"></span></td>
                <td><span id="cabelloEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Otros</td>
                <td colspan="3" rowspan="1"><span id="abdomenOtrosSpan"></span></td>
                <td>U&ntilde;as</td>
                <td><span id="unasNormalSpan"></span></td>
                <td><span id="unasAnormalSpan"></span></td>
                <td><span id="unasEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleBoldBgG">COLUMNA LUMBOSACRA</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Normal</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Anormal</td>
                <td style="vertical-align: middle; text-align: center; background-color: darkgray;">Especifique</td>
                <td style="vertical-align: middle;">Dermatosis</td>
                <td style="vertical-align: middle; text-align: center;">Si <span id="dermatosisSiSpan">( )</span> No <span id="dermatosisNoSpan">( )</span></td>
                <td>&nbsp;</td>
                <td><span id="dermatosisEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Conformaci&oacute;n</td>
                <td><span id="conformacionNormalSpan"></span></td>
                <td><span id="conformacionAnormalSpan"></span></td>
                <td><span id="conformacionEspecifiqueSpan"></span></td>
                <td>Dermatitis</td>
                <td class="tittleCentered">Si <span id="dermatitisSiSpan">( )</span> No <span id="dermatitisNoSpan">( )</span></td>
                <td>&nbsp;</td>
                <td><span id="dermatitisEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Arcos de mov.</td>
                <td><span id="arcosMovNormalSpan"></span></td>
                <td><span id="arcosMovAnormalSpan"></span></td>
                <td><span id="arcosMovEspecifiqueSpan"></span></td>
                <td>Tatuajes</td>
                <td class="tittleCentered">Si <span id="tatuajesSiSpan">( )</span> No <span id="tatuajesNoSpan">( )</span></td>
                <td>&nbsp;</td>
                <td><span id="tatuajesEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Marcha</td>
                <td><span id="marchaNormalSpan"></span></td>
                <td><span id="marchaAnormalSpan"></span></td>
                <td><span id="marchaEspecifiqueSpan"></span></td>
                <td>Cicatrices</td>
                <td colspan="2" class="tittleCentered">Si <span id="cicatricesSiSpan">( )</span> No <span id="cicatricesNoSpan">( )</span></td>
                <td><span id="cicatricesEspecifiqueSpan"></span></td>
            </tr>
            <tr>
                <td>Puntos dolorosos</td>
                <td class="tittleCentered" colspan="2" rowspan="1">S&iacute; <span id="puntosDolorososSiSpan">( )</span> No <span id="puntosDolorososNoSpan">( )</span></td>
                <td><span id="puntosDolorososEspecifiqueSpan"></span></td>
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
                <td colspan="4" rowspan="1">Cuenta Roja (BH):</td>
                <td colspan="4" rowspan="1">Audiometr&iacute;a: (s&oacute;lo si amerita)</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="1">General de Orina:</td>
                <td colspan="4" rowspan="1">Otros:</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="1">Qu&iacute;m. Sang. 6 elem.:</td>
                <td class="tittleCenteredBgP" colspan="4" rowspan="1">S&oacute;lo personal designado a &Aacute;reas Cr&iacute;ticas HACCP</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="1">Radiograf&iacute;a de T&oacute;rax (AP y lateral de columna)</td>
                <td colspan="4" rowspan="1">REACCIONES FEBRILES:</td>
            </tr>
            <tr>
                <td class="BgP" colspan="4" rowspan="1">VIH:</td>
                <td colspan="4" rowspan="1">VDRL:</td>
            </tr>
            <tr>
                <td class="BgP" colspan="4" rowspan="1">Antidoping 5 parámetros: Marihuana (THC), Coca&iacute;na (COC), Anfetaminas (AMP)<br /> Metanfetaminas (mAMP) Opioides (OPI) y Fenciclidina (PCP)</td>
                <td colspan="4" rowspan="1" style="vertical-align: middle;">COPRO:</td>
            </tr>
            <tr>
                <td colspan="4" rowspan="1">Tipo de Sangre:</td>
                <td colspan="4" rowspan="1">EXUDADO FARINGEO:</td>
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
                <td colspan="8" rowspan="1"><span id="diagObserSpan">&nbsp;</span></td>
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