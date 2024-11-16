<style>
    <?php include 'exIngresoIpasPdf.css'; ?>
</style>
<script>
    import "@fontsource-variable/onest";
</script>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ex Ingreso IPAS</title>
</head>

<body>
    <table dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
        <colgroup>
            <col width="670" />
            <col width="357" />
            <col width="189" />
            <col width="116" />
            <col width="100" />
            <col width="328" />
            <col width="66" />
            <col width="58" />
            <col width="76" />
            <col width="100" />
        </colgroup>
        <tbody>
            <tr>
                <td <?php $imagePath = 'assets/project/Imagen1.jpg';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?> colspan="1" rowspan="1"><img class="logoSigma" src="<?= $src ?>" alt="SigmaLogo">
                </td>
                <td colspan="9" style="text-align: center; vertical-align: middle; font-weight: bold; font-size: 12px;">SISTEMA DE SALUD INTEGRAL SIGMA</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="9" rowspan="1" style="text-align: center; vertical-align: middle; font-weight: bold;">EXAMEN M&Eacute;DICO DE INGRESO</td>
            </tr>
            <tr>
                <td colspan="2"><strong>SIGNOS VITALES:</strong></td>
                <td><strong>TA: /</strong></td>
                <td><span id="signosTASpan"></span></td>
                <td><strong>FC:</strong></td>
                <td><span id="signosFCSpan"></span></td>
                <td><strong>FR:</strong></td>
                <td><span id="signosFRSpan"></span></td>
                <td><strong>TEMP:</strong></td>
                <td colspan="1" rowspan="1"><span id="signosTEMPSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1"><strong>ANTOPOMETRICOS:</strong></td>
                <td><span></span></td>
                <td><strong>PESO:</strong></td>
                <td><span></span id="antoPESOSpan"></td>
                <td><strong>ESTATURA:</strong></td>
                <td><span id="antoPESOSpan"></span></td>
                <td style="background-color: #E6B8B7;"><strong>IMC:</strong></td>
                <td colspan="2" rowspan="1"><span id="antoIMDSpan"></span></td>
            </tr>
            <tr>
                <td colspan="10" rowspan="1" style="text-align: center; font-weight: bold; background-color: #C0C0C0;">INTERROGATORIO POR APARATOS Y SISTEMAS</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">&Oacute;rgano de los Sentidos</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Respiratorio</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Problemas de la vista (uso de Lentes)</td>
                <td colspan="2" rowspan="1"><span id="problemasViSpan"></span></td>
                <td colspan="3" rowspan="1">Antecedente de ASMA</td>
                <td colspan="2" rowspan="1"><span id="anteAsmaSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Infecciones Oculares Recurrentes</td>
                <td colspan="2" rowspan="1"><span id="infecOcuSpan"></span></td>
                <td colspan="3" rowspan="1">Antecedente Rinitis Alérgica</td>
                <td colspan="2" rowspan="1"><span id="antecRiniAlerSpan"></span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Neumonías o Bronquitis</td>
                <td colspan="2" rowspan="1"><span id="antecNeumBronqSpan"></span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Influenza</td>
                <td colspan="2" rowspan="1"><span id="antecInfuSpan"></span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="3" rowspan="1">Antecedente de Tuberculosis</td>
                <td colspan="2" rowspan="1"><span id="antecTuberSpan"></span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Cardiovascular</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Digestivo</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Cirugías Cardiacas</td>
                <td colspan="2" rowspan="1"><span id="cirCardSpan"></span></td>
                <td colspan="3" rowspan="1">Antecedente de Gastritis</td>
                <td colspan="2" rowspan="1"><span id="antecGrastSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Antecedente de Varices</td>
                <td colspan="2" rowspan="1"><span id="antecVaricSpan"></span></td>
                <td colspan="3" rowspan="1">Antecedente de Colitis</td>
                <td colspan="2" rowspan="1"><span id="antecColSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Dolor hormigueos o Adormecimiento de Piernas</td>
                <td colspan="2" rowspan="1"><span id="dolHorAdoPierSpan"></span></td>
                <td colspan="3" rowspan="1">Antecedente de Enfermedades Diarreicas frecuentes</td>
                <td colspan="2" rowspan="1"><span id="antecEnfDiarFrecSpan"></span></td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1">&nbsp;</td>
                <td colspan="5" rowspan="1">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Genitourinario</td>
                <td colspan="5" rowspan="1" style="text-align: center; font-weight: bold; background-color: #E6B8B7;">Musculoesquel&eacute;tico</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Infecciones Urinarias</td>
                <td colspan="2" rowspan="1"><span id="infUrinSpan"></span></td>
                <td colspan="3" rowspan="1">Dolor en Columna, (Lumbar o cuello)</td>
                <td colspan="2" rowspan="1"><span id="dolColumSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Cálculos o arenillas</td>
                <td colspan="2" rowspan="1"><span id="calcArenilSpan"></span></td>
                <td colspan="3" rowspan="1">Desviación de Columna</td>
                <td colspan="2" rowspan="1"><span id="desvColumSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Problemas en ri&ntilde;ón</td>
                <td colspan="2" rowspan="1"><span id="probRiñSpan"></span></td>
                <td colspan="3" rowspan="1">Dolor, inflamación o crepitación de Hombro</td>
                <td colspan="2" rowspan="1"><span id="dolInfCrepHombrSpan"></span></td>
            </tr>
            <tr">
                <td colspan="2" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">S&Oacute;LO MUJERES: Menarquia:</td>
                <td style="background-color: #CCFFFF;"><span id="menarquiaSpan"></span></td>
                <td style="background-color: #CCFFFF; font-weight: bold; font-size: 7px; text-align: center;">Ritmo Menstrual:</td>
                <td style="background-color: #CCFFFF;"><span id="ritmoMenstrualSpan"></span></td>
                <td colspan="3" rowspan="1">Dolor, inflamación o crepitación de Rodillas</td>
                <td colspan="2" rowspan="1"><span id="dolInflCrepRodiSpan"></span></td>
                </tr>
                <tr>
                    <td style="background-color: #CCFFFF; font-weight: bold;">Vida Sex Activa:</td>
                    <td style="background-color: #CCFFFF;"><span id="vidaSexActSpan"></span></td>
                    <td colspan="2" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">Fecha &Uacute;ltima Menstruaci&oacute;n:</td>
                    <td style="background-color: #CCFFFF;"><span id="fechUltMensSpan"></span></td>
                    <td colspan="3" rowspan="1">Dolor, inflamación o crepitación en Mu&ntilde;ecas</td>
                    <td colspan="2" rowspan="1"><span id="dolorInfCrepMuñSpan"></span></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="1" style="background-color: #CCFFFF; font-weight: bold;">Fecha &Uacute;ltimo Papanicolau C V:</td>
                    <td colspan="3" rowspan="1" style="background-color: #CCFFFF;"><span id="fechUltPapanicolauSpan"></span></td>
                    <td colspan="3" rowspan="1">Antecedente de Accidente Automovilístico</td>
                    <td colspan="2" rowspan="1"><span id="antecedenAccAutoSpan"></span></td>
                </tr>
                <tr>
                    <td colspan="10" rowspan="1" style="text-align: center; background-color: #C0C0C0;">Marque <strong>X</strong> bajo la condici&oacute;n observada durante la <strong>Exploraci&oacute;n F&iacute;sica</strong>: Normal "N" vs. Anormal "A" o "S&iacute;" vs. "No".</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CABEZA</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">NARIZ</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td>Cr&aacute;neo</td>
                    <td><span id="craneoNormalSpan"></span></td>
                    <td><span id="craneoAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="craneoEspecifiqueSpan"></span></td>
                    <td style="vertical-align: middle;">Mucosa</td>
                    <td><span id="mucosaNormalSpan"></span></td>
                    <td><span id="mucosaAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="mucosaEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Cara</td>
                    <td><span id="caraNormalSpan"></span></td>
                    <td><span id="caraAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="caraEspecifiqueSpan"></span></td>
                    <td>Cornetes</td>
                    <td><span id="cornetesNormalSpan"></span></td>
                    <td><span id="cornetesAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="cornetesEspecifiqueSpan"></span></td>
                </tr>

                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CUELLO</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                    <td>P&oacute;lipos</td>
                    <td colspan="2" rowspan="1" style="text-align: center;">S&iacute;<span id="poliposSiSpan">( )</span> No<span id="poliposNoSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="poliposEspecifiqueSpan"></s></td>
                </tr>
                <tr>
                    <td>Cilíndrico</td>
                    <td><span id="cilindricoNormalSpan"></span></td>
                    <td><span id="cilindricoAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="cilindricoEspecifiqueSpan"></span></td>
                    <td>Septum</td>
                    <td><span id="septumNormalSpan"></span></td>
                    <td><span id="septumAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="septumEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Tráquea</td>
                    <td><span id="traqueaNormalSpan"></span></td>
                    <td><span id="traqueaAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="traqueaEspecifiqueSpan"></span></td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">OIDOS</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Der.</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Izq.</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">Movilidad</td>
                    <td><span id="movilidadNormalSpan"></span></td>
                    <td><span id="movilidadAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="movilidadEspecifiqueSpan"></span></td>
                    <td style="vertical-align: middle;">Membrana T&iacute;mpano</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="membaranaTimpanoNDerSpan">( )</span> A <span id="membranaTimpanoADerSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="membranaTimpanoNIzqSpan">( )</span> A <span id="membranaTimpanoAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="membranaTimpanoEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Ganglios/ Tiroides</td>
                    <td style="text-align: center; vertical-align: middle;">S&iacute;<span id="ganglTiroSiSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">No<span id="ganglTiroNoSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="ganglTiroEspecifiqueSpan"></span></td>
                    <td style="vertical-align: middle;">Conducto Aud Ext</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="conducAudExtNDerSpan">( )</span> A <span id="conducAudExtADerSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="conducAudExtNIzqSpan">( )</span> A <span id="conducAudExtAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="conducAudExtEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td style="font-weight: bold; background-color: #C0C0C0; vertical-align: middle;">OJOS</td>
                    <td style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Der.</td>
                    <td style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Izq.</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center; vertical-align: middle;">Especifique</td>
                    <td style="vertical-align: middle;">Pabell&oacute;n Auricular</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pabAuricNDerSpan">( )</span> A <span id="pabAuricADerSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pabAuricNIzqSpan">( )</span> A <span id="pabAuricAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="pabAuricEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">Pupila</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pupilaNDerSpan">( )</span> A <span id="pupilaADerSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="pupilaNIzqSpan">( )</span> A <span id="pupilaAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="pupilaEspecifiqueSpan"></span></td>
                    <td style="font-weight: bold; background-color: #C0C0C0;">CAVIDAD ORAL</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Normal</td>
                    <td style="background-color: #C0C0C0; text-align: center;">Anormal</td>
                    <td colspan="2" rowspan="1" style="background-color: #C0C0C0; text-align: center;">Especifique</td>
                </tr>
                <tr>
                    <td style="vertical-align: middle;">C&oacute;rnea</td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="corneaNDerSpan">( )</span> A <span id="corneaADerSpan">( )</span></td>
                    <td style="text-align: center; vertical-align: middle;">N<span id="corneaNIzqSpan">( )</span> A <span id="corneaAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="corneaEspecifiqueSpan"></span></td>
                    <td>Enc&iacute;as</td>
                    <td><span id="enciasNormalSpan"></span></td>
                    <td><span id="enciasAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="enciasEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Agudeza Visual (sin lentes)</td>
                    <td style="background-color: #E6B8B7;">20/<span id="agudViSinSpan"></span></td>
                    <td style="background-color: #E6B8B7;">20/<span id="agudViSinSpan"></span></td>
                    <td colspan="2" rowspan="1" style="background-color: #E6B8B7;"><span id="agudViSinEspecifiqueSpan"></span></td>
                    <td style="vertical-align: middle;">Mucosa</td>
                    <td><span id="mucosaNormalSpan"></span></td>
                    <td><span id="mucosaAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="mucosaEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td style="background-color: #E6B8B7; vertical-align: middle;">Agudeza Visual (con lentes)</td>
                    <td style="background-color: #E6B8B7;">20/<span id="agudViConSpan"></span></td>
                    <td style="background-color: #E6B8B7;">20/<span id="agudViConSpan"></span></td>
                    <td colspan="2" rowspan="1" style="background-color: #E6B8B7;"><span id="agudViConEspecifiqueSpan"></span></td>
                    <td style="vertical-align: middle;">Paladar</td>
                    <td><span id="paladarNormalSpan"></span></td>
                    <td><span id="paladarAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="paladarEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Identifica Colores</td>
                    <td style="text-align: center;">S&iacute;<span id="identColSiDerSpan">( )</span> No<span id="identColNoDerSpan">( )</span></td>
                    <td style="text-align: center;">S&iacute;<span id="identColSiIzqSpan">( )</span> No<span id="identColNoIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="identColEspecifiqueSpan"></span></td>
                    <td>Lengua</td>
                    <td><span id="lenguaNormalSpan"></span></td>
                    <td><span id="lenguaAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="lenguaEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Movimiento Ocular</td>
                    <td style="text-align: center;">N<span id="movOculNDerSpan">( )</span> A <span id="movOculADerSpan">( )</span></td>
                    <td style="text-align: center;">N<span id="movOculNIzqSpan">( )</span> A <span id="movOculAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="movOculEspecifiqueSpan"></span></td>
                    <td>Am&iacute;gdalas</td>
                    <td><span id="amigdalasNormalSpan"></span></td>
                    <td><span id="amigdalasAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="amigdalasEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Reflejos Oculares</td>
                    <td style="text-align: center;">N<span id="refOculNDerSpan">( )</span> A <span id="refOculADerSpan">( )</span></td>
                    <td style="text-align: center;">N<span id="refOculNIzqSpan">( )</span> A <span id="refOculAIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="refOculEspecifiqueSpan"></span></td>
                    <td>Dentadura</td>
                    <td><span id="dentaduraNormalSpan"></span></td>
                    <td><span id="dentaduraAnormalSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="dentaduraEspecifiqueSpan"></span></td>
                </tr>
                <tr>
                    <td>Pterigión</td>
                    <td style="text-align: center;">S&iacute;<span id="pterigionSiDerSpan">( )</span> No<span id="pterigionNoDerSpan">( )</span></td>
                    <td style="text-align: center;">S&iacute;<span id="pterigionSiIzqSpan">( )</span> No<span id="pterigionNoIzqSpan">( )</span></td>
                    <td colspan="2" rowspan="1"><span id="pterigionEspecifiqueSpan"></span></td>
                    <td style="background-color: #E6B8B7;">Otras Lesiones</td>
                    <td colspan="4" rowspan="1"><span id="otrasLesionesEspecifiqueSpan"></span></td>
                </tr>
        </tbody>
    </table>
</body>

</html>