<style>
    <?php include 'historiaPdf.css'; ?>
</style>
<script>
    import "@fontsource-variable/onest";
</script>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historia</title>
</head>

<body>
    <table dir="ltr" border="1" cellspacing="0" cellpadding="0" data-sheets-root="1" data-sheets-baot="1">
        <colgroup>
            <col width="735" />
            <col width="357" />
            <col width="98" />
            <col width="568" />
            <col width="106" />
            <col width="575" />
            <col width="136" />
            <col width="200" />
            <col width="196" />
            <col width="177" />
            <col width="269" />
            <col width="211" />
            <col width="38" />
            <col width="131" />
            <col width="103" />
            <col width="80" />
            <col width="103" />
        </colgroup>
        <tbody>
            <tr>
                <td <?php $imagePath = 'assets/project/Imagen1.jpg';
                    $imageData = base64_encode(file_get_contents($imagePath));
                    $src = 'data:image/jpeg;base64,' . $imageData;
                    ?> colspan="3" rowspan="1"><img class="logoSigma" src="<?= $src ?>" alt="SigmaLogo"></td>
                <td class="tittleBoldCenter" colspan="21" style="text-align: center; vertical-align: middle;">SISTEMA DE SALUD INTEGRAL SIGMA</td>

            </tr>
            <tr>
                <td colspan="3" rowspan="1">Razón Social:</td>
                <td colspan="6">
                    <span id="razonSocialSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Domicilio:</td>
                <td colspan="13">
                    <span id="domicilioSpan"></span>
                </td>
            </tr>
            <tr>
                <td class="tittleBoldCenter" colspan="24" rowspan="1">HISTORIA CL&Iacute;NICA - ADMISI&Oacute;N</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Nombre:</td>
                <td colspan="14" rowspan="1">
                    <span id="nombreSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Fecha:</td>
                <td colspan="2" rowspan="1">
                    <span id="fechaSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Edad:</td>
                <td colspan="2" rowspan="1">
                    <span id="edadSpan"></span>
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Sexo:</td>
                <td colspan="2" rowspan="1">
                    <span id="sexoSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Edo. Civil:</td>
                <td colspan="2" rowspan="1">
                    <span id="edoCivSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Religi&oacute;n:</td>
                <td colspan="2" rowspan="1">
                    <span id="religionSpan"></span>
                </td>
                <td colspan="3" rowspan="1">Lugar de Nacim.:</td>
                <td colspan="5" rowspan="1">
                    <span id="lugarNaciSpan"></span>
                </td>
                <td colspan="3" rowspan="1">Fecha de Nacim.:</td>
                <td colspan="2" rowspan="1">
                    <span id="fechaNaciSpan"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Domicilio:</td>
                <td colspan="10" rowspan="1">
                    <span id="domicilioSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Colonia:</td>
                <td colspan="2" rowspan="1">
                    <span id="coloniaSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Cd. o Del.</td>
                <td colspan="2" rowspan="1">
                    <span id="cdODelSpan"></span>
                </td>
                <td colspan="1" rowspan="1">Tel.</td>
                <td colspan="3" rowspan="1">
                    <span id="telSpan"></span>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="1">Puesto que solicita / actual:</td>
                <td colspan="3" rowspan="1">
                    <span id="puestoSoliSpan"></span>
                </td>
                <td colspan="4" rowspan="1">&Aacute;rea o departamento:</td>
                <td colspan="2" rowspan="1">
                    <span id="areaDepaSpan"></span>
                </td>
                <td colspan="5" rowspan="1">No. de Afiliaci&oacute;n IMSS:</td>
                <td colspan="4" rowspan="1">
                    <span id="noAfiliSpan"></span>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Profesi&oacute;n:</td>
                <td colspan="7" rowspan="1">
                    <span id="profesionSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Escolaridad:</td>
                <td colspan="5" rowspan="1">
                    <span id="escolaridadSpan"></span>
                </td>
                <td colspan="4" rowspan="1">Cl&iacute;nica IMSS o UMF:</td>
                <td colspan="4" rowspan="1">
                    <span id="immsOumfSpan"></span>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="1">En caso de accidente avisar a:</td>
                <td colspan="5" rowspan="1">
                    <span id="avisarASpan"></span>
                </td>
                <td colspan="2" rowspan="1">Parentesco:</td>
                <td colspan="4" rowspan="1">
                    <span id="parentescofSpan"></span>
                </td>
                <td colspan="2" rowspan="1">Tel&eacute;fonos:</td>
                <td colspan="5" rowspan="1">
                    <span id="telefonosSpan"></span>
                </td>
            </tr>
            <tr>
                <td class="tittleCenterBgG" colspan="24" rowspan="1">1. HISTORIA FAMILIAR</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2">
                    <div class="familiarCentered">Familiar</div>
                </td>
                <td class="tittleCenterBgB" colspan="2" rowspan="1">Vive</td>
                <td class="tittleCenterBgB" colspan="20" rowspan="1">Marque con una X si su familiar padece o ha padecido alguna de las siguientes enfermedades:</td>
            </tr>
            <tr>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
                <td class="textCentered" colspan="2" rowspan="1">Diabetes</td>
                <td class="textCentered" colspan="2" rowspan="1">Hipertensi&oacute;n</td>
                <td class="textCentered" colspan="4" rowspan="1">Enf. del Coraz&oacute;n</td>
                <td class="textCentered" colspan="4" rowspan="1">Enf. de Pulmones</td>
                <td class="textCentered" colspan="3" rowspan="1">C&aacute;ncer o Leucem</td>
                <td class="textCentered" colspan="2" rowspan="1">Embolia</td>
                <td class="textCentered" colspan="3" rowspan="1">Enf. Mentales</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Padre</td>
                <td><span id="padreViveSiSpan"></span></td>
                <td><span id="padreViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="padreDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="padreHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="padreEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="padreEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="padreCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="padreEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="padreEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Madre</td>
                <td><span id="madreViveSiSpan"></span></td>
                <td><span id="madreViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="madreDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="madreHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="madreEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="madreEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="madreCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="madreEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="madreEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Hermanos</td>
                <td><span id="hermanosViveSiSpan"></span></td>
                <td><span id="hermanosViveSiSpan"></span></td>
                <<td colspan="2" rowspan="1"><span></span></td>
                    <td colspan="2" rowspan="1"><span id="hermanosDiabetesSpan"></span></td>
                    <td colspan="4" rowspan="1"><span id="hermanosHipertensionSpan"></span></td>
                    <td colspan="4" rowspan="1"><span id="hermanosEnfCorazonSpan"></span></td>
                    <td colspan="3" rowspan="1"><span id="hermanosEnfPulmonesSpan"></span></td>
                    <td colspan="2" rowspan="1"><span id="hermanosCancerLeucSpan"></span></td>
                    <td colspan="3" rowspan="1"><span id="hermanosEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuelo P.</td>
                <td><span id="abueloPViveSiSpan"></span></td>
                <td><span id="abueloPViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloPDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloPHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abueloPEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abueloPEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abueloPCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloPEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abueloPEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuela P.</td>
                <td><span id="abuelaPViveSiSpan"></span></td>
                <td><span id="abuelaPViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaPDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaPHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abuelaPEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abuelaPEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abuelaPCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaPEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abuelaPEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuelo M.</td>
                <td><span id="abueloMViveSiSpan"></span></td>
                <td><span id="abueloMViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloMDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloMHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abueloMEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abueloMEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abueloMCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abueloMEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abueloMEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuela M.</td>
                <td><span id="abuelaMViveSiSpan"></span></td>
                <td><span id="abuelaMViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaMDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaMHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abuelaMEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="abuelaMEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abuelaMCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="abuelaMEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="abuelaMEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Hijos</td>
                <td><span id="hijosViveSiSpan"></span></td>
                <td><span id="hijosViveNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="hijosDiabetesSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="hijosHipertensionSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="hijosEnfCorazonSpan"></span></td>
                <td colspan="4" rowspan="1"><span id="hijosEnfPulmonesSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="hijosCancerLeucSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="hijosEmboliaSpan"></span></td>
                <td colspan="3" rowspan="1"><span id="hijosEnfMentalesSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgG" colspan="24" rowspan="1">2. H&Aacute;BITOS DE HIGIENE, SALUD Y NUTRICIONALES</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Consume</td>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
                <td class="textCentered" colspan="2" rowspan="1">A&ntilde;o de inicio</td>
                <td class="textCentered" colspan="2" rowspan="1">A&ntilde;o de fin</td>
                <td class="textCentered" colspan="15" rowspan="1">Cantidad que consume por semana:</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Alcohol /Cerveza</td>
                <td><span id="alcoholSiSpan"></span></td>
                <td><span id="alcoholNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="alcoholAnyoInicioSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="alcoholAnyoFinSpan"></span></td>
                <td colspan="15" rowspan="1"><span id="alcoholConsumSemanSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Tabaco</td>
                <td><span id="tabacoSiSpan"></span></td>
                <td><span id="tabacoNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="tabacoAnyoInicioSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="tabacoAnyoFinSpan"></span></td>
                <td colspan="15" rowspan="1"><span id="tabacoConsumSemanSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Drogas</td>
                <td><span id="drogasSiSpan"></span></td>
                <td><span id="drogasNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="drogasAnyoInicioSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="drogasAnyoFinSpan"></span></td>
                <td colspan="15" rowspan="1"><span id="drogasConsumSemanSpan"></span></td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&iquest;Realiza con frecuencia Deporte /Ejercicio?</td>
                <td colspan="2" rowspan="1"><span id="realizaDeporteSpan"></span></td>
                <td colspan="2" rowspan="1">&iquest;Cu&aacute;l?</td>
                <td colspan="12" rowspan="1"><span id="cualDeporteSpan"></span></td>
            </tr>
            <tr>
                <td colspan="13" rowspan="1">Marque los alimentos que consume m&aacute;s de 4 veces por semana:</td>
                <td colspan="5" rowspan="1">Caracter&iacute;sticas de su vivienda:</td>
                <td colspan="6" rowspan="1">Material de:</td>
            </tr>

            <tr>
                <td colspan="3" rowspan="1">a. Frutas/Verduras</td>
                <td class="textCentered"><span id="frutasVerdurasSpan">___</span></td>
                <td colspan="3" rowspan="1">b. Pan/Galletas</td>
                <td class="textCentered"><span id="panGalletasSpan">___</span></td>
                <td colspan="4" rowspan="1">c. Pollo/Pescado</td>
                <td class="textCentered"><span id="polloPescadoSpan">___</span></td>
                <td colspan="4" rowspan="1">N&uacute;mero de Habitaciones:</td>
                <td class="textCentered"><span id="numeroHabitacionesSpan">___</span></td>
                <td colspan="2" rowspan="1">Techo:</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="techoSpan">___</span></td>
                <td colspan="2" rowspan="1">Paredes</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="paredesSpan">___</span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">d. Carne</td>
                <td class="textCentered"><span id="carneSpan">___</span></td>
                <td colspan="2" rowspan="1">e. Refrescos</td>
                <td class="textCentered"><span id="refrescosSpan">___</span></td>
                <td colspan="2" rowspan="1">f. Tortillas</td>
                <td class="textCentered"><span id="tortillasSpan">___</span></td>
                <td class="textCentered" colspan="2" rowspan="1">g.Frituras</td>
                <td class="textCentered" colspan="2"><span id="friturasSpan">___</span></td>
                <td colspan="4" rowspan="1">&iquest;Cuenta con Servicios?</td>
                <td>Luz</td>
                <td class="textCentered"><span id="luzSpan">___</span></td>
                <td>Agua</td>
                <td class="textCentered"><span id="aguaSpan">___</span></td>
                <td colspan="2" rowspan="1">Drenaje</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="drenajeSpan">___</span></td>
            </tr>

            <tr>
                <td class="tittleCenterBgG" colspan="24" rowspan="1">3. ANTECEDENTES PERSONALES</td>
            </tr>
            <tr>
                <td class="tittleCenterBgB" colspan="24" rowspan="1">Ha recibido alguno de los siguientes tratamientos m&eacute;dicos</td>
            </tr>
            <tr>
                <td class="tittleCenterBgB" colspan="3" rowspan="1">&nbsp;</td>
                <td class="tittleCenterBgB" colspan="1" rowspan="1">S&iacute;</td>
                <td class="tittleCenterBgB" colspan="1" rowspan="1">No</td>
                <td class="tittleCenterBgB" colspan="2" rowspan="1">Fecha</td>
                <td class="tittleCenterBgB" colspan="17" rowspan="1">Motivo</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Cirug&iacute;as</td>
                <td colspan="1" rowspan="1"><span id="cirugiasSiSpan"></span></td>
                <td colspan="1" rowspan="1"><span id="cirugiasNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="cirugiasFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="cirugiasMotivoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Transfusiones</td>
                <td colspan="1" rowspan="1"><span id="transfusionesSiSpan"></span></td>
                <td colspan="1" rowspan="1"><span id="transfusionesNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="transfusionesFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="transfusionesMotivoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Hospitalizaciones</td>
                <td colspan="1" rowspan="1"><span id="hospitalizacionesSiSpan"></span></td>
                <td colspan="1" rowspan="1"><span id="hospitalizacionesNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="hospitalizacionesFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="hospitalizacionesMotivoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Usa lentes</td>
                <td colspan="1" rowspan="1"><span id="lentesSiSpan"></span></td>
                <td colspan="1" rowspan="1"><span id="lentesNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="lentesFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="lentesMotivoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Alergias</td>
                <td colspan="1" rowspan="1"><span id="alergiasSiSpan"></span></td>
                <td colspan="1" rowspan="1"><span id="alergiasNoSpan"></span></td>
                <td colspan="2" rowspan="1"><span id="alergiasFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="alergiasMotivoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="4" rowspan="1">Esquema de Vacunaci&oacute;n:</td>
                <td colspan="2" rowspan="1">Completo</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="esqVacunCompletoSpan">( )</span></td>
                <td colspan="2" rowspan="1">Incompleto</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="esqVacunIncompletoSpan">( )</span></td>
                <td colspan="7" rowspan="1">&Uacute;ltima vacuna que se aplic&oacute;:</td>
                <td colspan="7" rowspan="1"><span id="ultVacunSpab"></span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgP" colspan="24">Padece o ha padecido alguna de las siguientes enfermedades (para ser llenado por Médico de Empresa)</td>
            </tr>
            <tr>
                <td class="tittleBgBB" colspan="6">Enf. Crónicas</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
                <td class="tittleBgBB" colspan="6">Enf. Infecciosas</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
                <td class="tittleBgBB" colspan="6">Neurológicas</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
            </tr>
            <tr>
                <td colspan="6">Hipertensión</td>
                <td colspan="1"><span id="hipertensionSiSpan"></span></td>
                <td colspan="1"><span id="hipertensionNoSpan""></span></td>
                <td colspan=" 6">Tuberculosis</td>
                <td colspan="1"><span id="tuberculosisSiSpan""></span></td>
                <td colspan=" 1"><span id="tuberculosisNoSpan""></span></td>
                <td colspan=" 6">Embolia cerebral</td>
                <td colspan="1"><span id="emboliaCerebralSiSpan""></span></td>
                <td colspan=" 1"><span id="emboliaCerebralNoSpan""></span></td>
            </tr>
            <tr>
                <td colspan=" 6">Diabetes</td>
                <td colspan="1"><span id="diabetesSiSpan""></span></td>
                <td colspan=" 1"><span id="diabetesNoSpan""></span></td>
                <td colspan=" 6">Hepatitis</td>
                <td colspan="1"><span id="hepatitisSiSpan""></span></td>
                <td colspan=" 1"><span id="hepatitisNoSpan""></span></td>
                <td colspan=" 6">Dolor de cabeza intenso (Migraña)</td>
                <td colspan="1"><span id="migrañaSiSpan""></span></td>
                <td colspan=" 1"><span id="migrañaNoSpan""></span></td>
            </tr>
            <tr>
                <td colspan=" 6">Colesterol Alto</td>
                <td colspan="1"><span id="colesterolAltoSiSpan""></span></td>
                <td colspan=" 1"><span id="colesterolAltoNoSpan""></span></td>
                <td colspan=" 6">Enf. Transm. Sexual</td>
                <td colspan="1"><span id="enfermedadTransmSexualSiSpan""></span></td>
                <td colspan=" 1"><span id="enfermedadTransmSexualNoSpan""></span></td>
                <td colspan=" 6">Epilepsia / Convulsiones</td>
                <td colspan="1"><span id="epilepsiaSiSpan""></span></td>
                <td colspan=" 1"><span id="epilepsiaNoSpan""></span></td>
            </tr>
            <tr>
                <td colspan=" 6">Enfermedades gastrointestinales</td>
                <td colspan="1"><span id="enfGastrointestinalesSiSpan""></span></td>
                <td colspan=" 1"><span id="enfGastrointestinalesNoSpan""></span></td>
                <td colspan=" 6">Enf. Gastrointestinales</td>
                <td colspan="1"><span id="enfGastrointestinalesAdicionalesSiSpan""></span></td>
                <td colspan=" 1"><span id="enfGastrointestinalesAdicionalesNoSpan""></span></td>
                <td colspan=" 6">Depresión</td>
                <td colspan="1"><span id="depresionSiSpan""></span></td>
                <td colspan=" 1"><span id="depresionNoSpan""></span></td>
            </tr>
            <tr>
                <td colspan=" 6">Enfermedades del corazón</td>
                <td colspan="1"><span id="enfCorazonSiSpan""></span></td>
                <td colspan=" 1"><span id="enfCorazonNoSpan""></span></td>
                <td colspan=" 6">Conjuntivitis</td>
                <td colspan="1"><span id="conjuntivitisSiSpan""></span></td>
                <td colspan=" 1"><span id="conjuntivitisNoSpan""></span></td>
                <td colspan=" 6">Enf. Psiquiátricas</td>
                <td colspan="1"><span id="enfPsiquiatricasSiSpan""></span></td>
                <td colspan=" 1"><span id="enfPsiquiatricasNoSpan""></span></td>
            </tr>
            <tr>
                <td class=" tittleBgBB" colspan="6">Enf. del Trabajo</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
                <td class="tittleBgBB" colspan="6">Otras Enfermedades</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
                <td class="tittleBgBB" colspan="6">Sólo Mujeres</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
            </tr>
            <tr>
                <td colspan="6">Dolores de Espalda o de Cintura</td>
                <td colspan="1"><span id="dolorEspaldaSiSpan"></span></td>
                <td colspan="1"><span id="dolorEspaldaNoSpan"></span></td>
                <td class="tittleBgP" colspan="6" rowspan="3">
                    <div>Fracturas o Torceduras (parte del Cuerpo lesionada, tratamiento, tiempo de resolución, secuela)</div>
                </td>
                <td colspan="1" rowspan="3"><span id="fracturasSiSpan"></span></td>
                <td colspan="1" rowspan="3"><span id="fracturasNoSpan"></span></td>
                <td colspan="6">Menstruación con dolor</td>
                <td colspan="1"><span id="menstruacionDolorSiSpan"></span></td>
                <td colspan="1"><span id="menstruacionDolorNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6">Dificultad para oír</td>
                <td colspan="1"><span id="dificultadOirSiSpan"></span></td>
                <td colspan="1"><span id="dificultadOirNoSpan"></span></td>
                <td colspan="6 ">Incapacidad por cólico</td>
                <td colspan="1"><span id="incapacidadColicoSiSpan"></span></td>
                <td colspan="1"><span id="incapacidadColicoNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6">Enfermedades de la Piel</td>
                <td colspan="1"><span id="enfPielSiSpan"></span></td>
                <td colspan="1"><span id="enfPielNoSpan"></span></td>
                <td colspan="4">Embarazos ¿cuántos?</td>
                <td class="textCentered" colspan="2"><span id="embarazosCuantosSpan">_______</span></td>
                <td colspan="1"><span id="embarazosSiSpan"></span></td>
                <td colspan="1"><span id="embarazosNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6">Alteraciones de la Vista</td>
                <td colspan="1"><span id="alteracionesVistaSiSpan"></span></td>
                <td colspan="1"><span id="alteracionesVistaNoSpan"></span></td>
                <td colspan="6">Enf. De los Riñones</td>
                <td colspan="1"><span id="enfRinonesSiSpan"></span></td>
                <td colspan="1"><span id="enfRinonesNoSpan"></span></td>
                <td colspan="4">Abortos ¿cuántos?</td>
                <td class="textCentered" colspan="2"><span id="abortosCuantosSpan">_______</span></td>
                <td colspan="1"><span id="abortosSiSpan"></span></td>
                <td colspan="1"><span id="abortosNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6">Enfermedades de los Pulmones</td>
                <td colspan="1"><span id="enfPulmonesSiSpan"></span></td>
                <td colspan="1"><span id="enfPulmonesNoSpan"></span></td>
                <td colspan="6">Cáncer o tumores</td>
                <td colspan="1"><span id="cancerTumoresSiSpan"></span></td>
                <td colspan="1"><span id="cancerTumoresNoSpan"></span></td>
                <td colspan="8"><span></span></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td colspan="1"><span></span></td>
                <td colspan="1"><span></span></td>
                <td class="tittleBgP" colspan="6">Obesidad IMC &gt;30</td>
                <td colspan="1"><span id="obesidadImcSiSpan"></span></td>
                <td colspan="1"><span id="obesidadImcNoSpan"></span></td>
                <td colspan="8"><span></span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgG" colspan="24">4. ANTECEDENTES LABORALES</td>
            </tr>
            <tr>
                <td class="tittleCenterBgB" colspan="5">Salud y Seguridad en el Trabajo</td>
                <td class="textCentered" colspan="1">Sí</td>
                <td class="textCentered" colspan="1">No</td>
                <td class="textCentered" colspan="6">¿Cuáles?</td>
                <td class="textCentered" colspan="9">Secuelas de los accidentes o enfermedades</td>
                <td class="textCentered" colspan="2">% IPP</td>
            </tr>
            <tr>
                <td class="tittleBgP" colspan="5">Accidentes de trabajo</td>
                <td colspan="1"><span id="accTrabajoSiSpan"></span></td>
                <td colspan="1"><span id="accTrabajoNoSpan"></span></td>
                <td colspan="6"><span id="accTrabajoCualesSpan"></span></td>
                <td colspan="9"><span id="accTrabajoSecuelasSpan"></span></td>
                <td colspan="2"><span id="accTrabajoIppSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleBgP" colspan="5">Enfermedades de trabajo</td>
                <td colspan="1"><span id="enfTrabajoSiSpan"></span></td>
                <td colspan="1"><span id="enfTrabajoNoSpan"></span></td>
                <td colspan="6"><span id="enfTrabajoCualesSpan"></span></td>
                <td colspan="9"><span id="enfTrabajoSecuelasSpan"></span></td>
                <td colspan="2"><span id="enfTrabajoIppSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleBgP" colspan="5">Accidentes de trayecto o viales</td>
                <td colspan="1"><span id="accTrayectoSiSpan"></span></td>
                <td colspan="1"><span id="accTrayectoNoSpan"></span></td>
                <td colspan="6"><span id="accTrayectoCualesSpan"></span></td>
                <td colspan="9"><span id="accTrayectoSecuelasSpan"></span></td>
                <td colspan="2"><span id="accTrayectoIppSpan"></span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgB" colspan="6" rowspan="1">Puesto en sus empleos anteriores</td>
                <td>A&ntilde;os</td>
                <td colspan="15" rowspan="1">En sus trabajos anteriores ha estado expuesto a algunos de los siguientes casos:</td>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan1"></span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan1"></span></td>
                <td colspan="15" rowspan="1">Productos químicos (polvos, humos, neblina, vapores, aerosoles):</td>
                <td><span id="productosQuimicosSiSpan"></span></td>
                <td><span id="productosQuimicosNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Temperaturas elevadas extremas o bajas extremas o vibraciones:</td>
                <td><span id="tempElevadasSiSpan"></span></td>
                <td><span id="tempElevadasNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan2"></span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan2"></span></td>
                <td colspan="15" rowspan="1">Áreas con niveles elevados de ruido:</td>
                <td><span id="nivelesRuidoSiSpan"></span></td>
                <td><span id="nivelesRuidoNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Levantamiento de cargas pesadas y repetitivas:</td>
                <td><span id="cargasPesadasSiSpan"></span></td>
                <td><span id="cargasPesadasNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan3"></span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan3"></span></td>
                <td colspan="15" rowspan="1">Trabajos manuales repetitivos:</td>
                <td><span id="trabajosManualesSiSpan"></span></td>
                <td><span id="trabajosManualesNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Agentes biológicos (bacterias, virus, hongos u otros):</td>
                <td><span id="agentesBiologicosSiSpan"></span></td>
                <td><span id="agentesBiologicosNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan4"></span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan4"></span></td>
                <td colspan="15" rowspan="1">Radiaciones (rayos X, láser, infrarrojos, UV u otros):</td>
                <td><span id="radiacionesSiSpan"></span></td>
                <td><span id="radiacionesNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Trabajo bajo estrés, ambientes cerrados, rolar turnos, tiempo extra:</td>
                <td><span id="estresAmbientesSiSpan"></span></td>
                <td><span id="estresAmbientesNoSpan"></span></td>
            </tr>
            <tr>
                <td colspan="24">Doy fe de que las respuestas son verídicas y correctas de acuerdo a mi leal saber y entender.</td>
            </tr>
            <tr>
                <td colspan="16">Acepto y entiendo que cualquier declaración falsa será motivo de mi despido o recesión de contrato.</td>
                <td class="textCentered" colspan="8"><span id="firmaAspiranteSpan">__________________</span></td>
            </tr>
            <tr>
                <td colspan="16">Formato 5 -1</td>
                <td class="textCentered" colspan="8">Firma del aspirante</td>
            </tr>
        </tbody>
    </table>
</body>

</html>