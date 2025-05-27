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
                <td <?php $imagePath = 'https://bimo-lab.com/nuevo_checkup/pdf/views/invoice/sigma/Imagen1.jpg';
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
                <td colspan="12" rowspan="1">
                    <span id="nombreSpan">
                        <?php
                        echo ($resultados[0]->nombre_cliente);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Fecha:</td>
                <td colspan="4" rowspan="1">
                    <span id="fechaSpan">
                        <?php
                        echo ($resultados[5]->FECHA_ADMISION);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Edad:</td>
                <td colspan="2" rowspan="1">
                    <span id="edadSpan">
                        <?php
                        echo ($resultados[5]->EDAD);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">Sexo:</td>
                <td colspan="1" rowspan="1">
                    <span id="sexoSpan">
                        <?php
                        echo ($resultados[0]->GENERO);
                        ?>
                    </span>
                </td>
                <td colspan="3" rowspan="1">Edo. Civil:</td>
                <td colspan="2" rowspan="1">
                    <span id="edoCivilSpan">
                        <?php
                        echo ($resultados[5]->ESTADO_CIVIL);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1"><strong>Religi&oacute;n</strong>:</td>
                <td colspan="2" rowspan="1">
                    <span id="religionSpan">
                        <?php
                        echo ($resultados[5]->RELIGION);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Lugar de Nacim.:</td>
                <td colspan="5" rowspan="1">
                    <span id="lugarNaciSpan">
                        <?php
                        echo ($resultados[5]->LUGAR_NACIMIENTO);
                        ?>
                    </span>
                </td>
                <td colspan="4" rowspan="1">Fecha de Nacim.:</td>
                <td colspan="2" rowspan="1">
                    <span id="fechaNaciSpan">
                        <?php
                        echo ($resultados[0]->NACIMIENTO);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Domicilio:</td>
                <td colspan="6" rowspan="1">
                    <span id="domicilioSpan">
                        <?php
                        echo ($resultados[0]->domicilio_cliente);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Colonia:</td>
                <td colspan="4" rowspan="1">
                    <span id="coloniaSpan">
                        <?php
                        echo ($resultados[0]->COLONIA);
                        ?>
                    </span>
                </td>
                <td colspan="3" rowspan="1">Cd. o Del.</td>
                <td colspan="3" rowspan="1">
                    <span id="cdODelSpan">
                        <?php
                        echo ($resultados[0]->MUNICIPIO);
                        ?>
                    </span>
                </td>
                <td colspan="1" rowspan="1">Tel.</td>
                <td colspan="3" rowspan="1">
                    <span id="telSpan">
                        <?php
                        echo ($resultados[5]->CELULAR);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="1">Puesto que solicita / actual:</td>
                <td colspan="3" rowspan="1">
                    <span id="puestoSoliSpan">
                        <?php
                        echo ($resultados[5]->PUESTO_SOLICITA);
                        ?>
                    </span>
                </td>
                <td colspan="4" rowspan="1">&Aacute;rea o departamento:</td>
                <td colspan="2" rowspan="1">
                    <span id="areaDepaSpan">
                        <?php
                        echo ($resultados[5]->AREA_DEPTO);
                        ?>
                    </span>
                </td>
                <td colspan="5" rowspan="1">No. de Afiliaci&oacute;n IMSS:</td>
                <td colspan="4" rowspan="1">
                    <span id="noAfiliSpan">
                        <?php
                        echo ($resultados[5]->NO_IMSS);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Profesi&oacute;n:</td>
                <td colspan="7" rowspan="1">
                    <span id="profesionSpan">
                        <?php
                        echo ($resultados[5]->PROFESION);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Escolaridad:</td>
                <td colspan="5" rowspan="1">
                    <span id="escolaridadSpan">
                        <?php
                        echo ($resultados[5]->ESCOLARIDAD);
                        ?>
                    </span>
                </td>
                <td colspan="4" rowspan="1">Cl&iacute;nica IMSS o UMF:</td>
                <td colspan="4" rowspan="1">
                    <span id="immsOumfSpan">
                        <?php
                        echo ($resultados[5]->UMF);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="6" rowspan="1">En caso de accidente avisar a:</td>
                <td colspan="5" rowspan="1">
                    <span id="avisarASpan">
                        <?php
                        echo ($resultados[5]->ACCIDENTE_AVISAR);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Parentesco:</td>
                <td colspan="4" rowspan="1">
                    <span id="parentescofSpan">
                        <?php
                        echo ($resultados[5]->PARENTESCO);
                        ?>
                    </span>
                </td>
                <td colspan="2" rowspan="1">Tel&eacute;fonos:</td>
                <td colspan="5" rowspan="1">
                    <span id="telefonosSpan">
                        <?php
                        echo ($resultados[5]->TELEFONO1 . ', ' . $resultados[5]->TELEFONO2);
                        ?>
                    </span>
                </td>
            </tr>
            <tr>
                <td class="tittleCenterBgG" colspan="24" rowspan="1">1. HISTORIA FAMILIAR</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2">
                    <div style="vertical-align: middle;" class="cent">Familiar</div>
                </td>
                <td class="tittleCenterBgB" colspan="2" rowspan="1">Vive</td>
                <td class="tittleCenterBgB" colspan="20" rowspan="1">Marque con una X si su familiar padece o ha padecido alguna de las siguientes enfermedades:</td>
            </tr>
            <tr>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
                <td class="textCentered" colspan="2" rowspan="1">Diabetes</td>
                <td class="textCentered" colspan="3" rowspan="1">Hipertensi&oacute;n</td>
                <td class="textCentered" colspan="3" rowspan="1">Enf. del Coraz&oacute;n</td>
                <td class="textCentered" colspan="4" rowspan="1">Enf. de Pulmones</td>
                <td class="textCentered" colspan="3" rowspan="1">C&aacute;ncer o Leucem</td>
                <td class="textCentered" colspan="2" rowspan="1">Embolia</td>
                <td class="textCentered" colspan="3" rowspan="1">Enf. Mentales</td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Padre</td>
                <td style="text-align: center; vertical-align: middle;"><span id="padreViveSiSpan">
                        <?php
                        if ($resultados[1]->{25}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="padreViveNoSpan">
                        <?php
                        if ($resultados[1]->{25}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="padreDiabetesSpan">
                        <?php
                        if ($resultados[1]->{26}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="padreHipertensionSpan">
                        <?php
                        if ($resultados[1]->{27}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="padreEnfCorazonSpan">
                        <?php
                        if ($resultados[1]->{210}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="padreEnfPulmonesSpan">
                        <?php
                        if ($resultados[1]->{211}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="padreCancerLeucSpan">
                        <?php
                        if ($resultados[1]->{28}->RESPUESTA == "Sí" || $resultados[1]->{212}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="padreEmboliaSpan">
                        <?php
                        if ($resultados[1]->{213}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="padreEnfMentalesSpan">
                        <?php
                        if ($resultados[1]->{214}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Madre</td>
                <td style="text-align: center; vertical-align: middle;"><span id="madreViveSiSpan">
                        <?php
                        if ($resultados[1]->{30}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="madreViveNoSpan">
                        <?php
                        if ($resultados[1]->{30}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="madreDiabetesSpan">
                        <?php
                        if ($resultados[1]->{31}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="madreHipertensionSpan">
                        <?php
                        if ($resultados[1]->{32}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="madreEnfCorazonSpan">
                        <?php
                        if ($resultados[1]->{215}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="madreEnfPulmonesSpan">
                        <?php
                        if ($resultados[1]->{216}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="madreCancerLeucSpan">
                        <?php
                        if ($resultados[1]->{33}->RESPUESTA == "Sí" || $resultados[1]->{217}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="madreEmboliaSpan">
                        <?php
                        if ($resultados[1]->{218}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="madreEnfMentalesSpan">
                        <?php
                        if ($resultados[1]->{219}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Hermanos</td>
                <td style="text-align: center; vertical-align: middle;">
                    <span id="hermanosViveSiSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle;">
                    <span id="hermanosViveNoSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span>
                </td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="hermanosDiabetesSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hermanosHipertensionSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hermanosEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="hermanosEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hermanosCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="hermanosEmboliaSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hermanosEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{1}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuelo P.</td>
                <td style="text-align: center; vertical-align: middle;"><span id="abueloPViveSiSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="abueloPViveNoSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abueloPDiabetesSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloPHipertensionSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloPEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="abueloPEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloPCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abueloPEmboliaSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloPEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{2}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuela P.</td>
                <td style="text-align: center; vertical-align: middle;"><span id="abuelaPViveSiSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="abuelaPViveNoSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abuelaPDiabetesSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaPHipertensionSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaPEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="abuelaPEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaPCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abuelaPEmboliaSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaPEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{3}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuelo M.</td>
                <td style="text-align: center; vertical-align: middle;"><span id="abueloMViveSiSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="abueloMViveNoSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abueloMDiabetesSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloMHipertensionSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloMEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="abueloMEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloMCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abueloMEmboliaSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abueloMEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{4}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Abuela M.</td>
                <td style="text-align: center; vertical-align: middle;"><span id="abuelaMViveSiSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="abuelaMViveNoSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abuelaMDiabetesSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaMHipertensionSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaMEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="abuelaMEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaMCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="abuelaMEmboliaSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="abuelaMEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{5}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="1">Hijos</td>
                <td style="text-align: center; vertical-align: middle;"><span id="hijosViveSiSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{1}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="hijosViveNoSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{1}->RESPUESTA == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="hijosDiabetesSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{2}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hijosHipertensionSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{3}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hijosEnfCorazonSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{4}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="4" rowspan="1"><span id="hijosEnfPulmonesSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{5}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hijosCancerLeucSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{6}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="hijosEmboliaSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{7}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="hijosEnfMentalesSpan">
                        <?php
                        if ($resultados[2]->{6}->PREGUNTAS->{8}->RESPUESTA == 1) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgG" colspan="24" rowspan="1">2. H&Aacute;BITOS DE HIGIENE, SALUD Y NUTRICIONALES</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Consume</td>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
                <td class="textCentered" colspan="3" rowspan="1">A&ntilde;o de inicio</td>
                <td class="textCentered" colspan="2" rowspan="1">A&ntilde;o de fin</td>
                <td class="textCentered" colspan="14" rowspan="1">Cantidad que consume por semana:</td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Alcohol /Cerveza</td>
                <td style="text-align: center; vertical-align: middle;"><span id="alcoholSiSpan">
                        <?php
                        if ($resultados[1]->{19}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="alcoholNoSpan">
                        <?php
                        if ($resultados[1]->{19}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="alcoholAnyoInicioSpan">
                        <?php
                        if ($resultados[1]->{19}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{233}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="alcoholAnyoFinSpan">
                        <?php
                        if ($resultados[1]->{19}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{234}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="14" rowspan="1"><span id="alcoholConsumSemanSpan">
                        <?php
                        if ($resultados[1]->{19}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{235}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Tabaco</td>
                <td style="text-align: center; vertical-align: middle;"><span id="tabacoSiSpan">
                        <?php
                        if ($resultados[1]->{18}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="tabacoNoSpan">
                        <?php
                        if ($resultados[1]->{18}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="tabacoAnyoInicioSpan">
                        <?php
                        if ($resultados[1]->{18}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{230}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="tabacoAnyoFinSpan">
                        <?php
                        if ($resultados[1]->{18}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{231}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="14" rowspan="1"><span id="tabacoConsumSemanSpan">
                        <?php
                        if ($resultados[1]->{18}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{232}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Drogas</td>
                <td style="text-align: center; vertical-align: middle;"><span id="drogasSiSpan">
                        <?php
                        if ($resultados[1]->{20}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;"><span id="drogasNoSpan">
                        <?php
                        if ($resultados[1]->{20}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="3" rowspan="1"><span id="drogasAnyoInicioSpan">
                        <?php
                        if ($resultados[1]->{20}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{236}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2" rowspan="1"><span id="drogasAnyoFinSpan">
                        <?php
                        if ($resultados[1]->{20}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{237}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="14" rowspan="1"><span id="drogasConsumSemanSpan">
                        <?php
                        if ($resultados[1]->{20}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{238}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="8" rowspan="1">&iquest;Realiza con frecuencia Deporte /Ejercicio?</td>
                <td colspan="2" rowspan="1"><span id="realizaDeporteSpan">
                        <?php
                        if ($resultados[1]->{21}->RESPUESTA == "Sí") {
                            echo 'Sí';
                        } else if ($resultados[1]->{21}->RESPUESTA == "No") {
                            echo 'No';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">&iquest;Cu&aacute;l?</td>
                <td colspan="12" rowspan="1"><span id="cualDeporteSpan">
                        <?php
                        if ($resultados[1]->{21}->RESPUESTA == "Sí") {
                            echo $resultados[1]->{21}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="13" rowspan="1">Marque los alimentos que consume m&aacute;s de 4 veces por semana:</td>
                <td colspan="5" rowspan="1">Caracter&iacute;sticas de su vivienda:</td>
                <td colspan="6" rowspan="1">Material de:</td>
            </tr>

            <tr>
                <td colspan="2" rowspan="1">a. Frutas/Verduras</td>
                <td style="text-align: center; vertical-align: middle;" class="textCentered"><span id="frutasVerdurasSpan">
                        <?php
                        if (isset($resultados[3]->{1})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="4" rowspan="1">b. Pan/Galletas</td>
                <td style="text-align: center; vertical-align: middle;" class="textCentered"><span id="panGalletasSpan">
                        <?php
                        if (isset($resultados[3]->{2})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="3" rowspan="1">c. Pollo/Pescado</td>
                <td style="text-align: center; vertical-align: middle;" class="textCentered"><span id="polloPescadoSpan">
                        <?php
                        if (isset($resultados[3]->{3})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="4" rowspan="1">N&uacute;mero de Habitaciones:</td>
                <td style="text-align: center; vertical-align: middle;" class="textCentered"><span id="numeroHabitacionesSpan">
                        <?php
                        if (isset($resultados[1]->{281}->NOTAS)) {
                            echo '<u>' . $resultados[1]->{281}->NOTAS . '</u>';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">Techo:</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="techoSpan">
                        <?php
                        if (isset($resultados[1]->{240}->NOTAS)) {
                            echo '<u>' . $resultados[1]->{240}->NOTAS . '</u>';
                        } else {
                            echo '____';
                        }
                        ?></span></td>
                <td colspan="3" rowspan="1">Paredes:</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="paredesSpan">
                        <?php
                        if (isset($resultados[1]->{242}->NOTAS)) {
                            echo '<u>' . $resultados[1]->{242}->NOTAS . '</u>';
                        } else {
                            echo '____';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="1" rowspan="1">d. Carne</td>
                <td class="textCentered"><span id="carneSpan">
                        <?php
                        if (isset($resultados[3]->{4})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="3" rowspan="1">e. Refrescos</td>
                <td class="textCentered"><span id="refrescosSpan">
                        <?php
                        if (isset($resultados[3]->{5})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="2" rowspan="1">f. Tortillas</td>
                <td class="textCentered"><span id="tortillasSpan">
                        <?php
                        if (isset($resultados[3]->{6})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td class="textCentered" colspan="2" rowspan="1">g.Frituras</td>
                <td class="textCentered" colspan="2"><span id="friturasSpan">
                        <?php
                        if (isset($resultados[3]->{7})) {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                <td colspan="4" rowspan="1">&iquest;Cuenta con Servicios?</td>
                <td>Luz</td>
                <td class="textCentered"><span id="luzSpan">
                        <?php
                        if ($resultados[1]->{243}->RESPUESTA == "Sí") {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                </span></td>
                <td>Agua</td>
                <td class="textCentered"><span id="aguaSpan">
                        <?php
                        if ($resultados[1]->{244}->RESPUESTA == "Sí") {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                </span></td>
                <td colspan="2" rowspan="1">Drenaje</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="drenajeSpan">
                        <?php
                        if ($resultados[1]->{245}->RESPUESTA == "Sí") {
                            echo '<u>x</u>';
                        }
                        ?></span></td>
                </span></td>
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
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="cirugiasSiSpan">
                        <?php
                        if ($resultados[1]->{17}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="cirugiasNoSpan">
                        <?php
                        if ($resultados[1]->{17}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1"><span id="cirugiasFechaSpan">
                        <?php
                        if (isset($resultados[1]->{246}->NOTAS)) {
                            echo $resultados[1]->{246}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="17" rowspan="1"><span id="cirugiasMotivoSpan">
                        <?php
                        if (isset($resultados[1]->{17}->NOTAS)) {
                            echo $resultados[1]->{17}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Transfusiones</td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="transfusionesSiSpan">
                        <?php
                        if ($resultados[1]->{9}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="transfusionesNoSpan">
                        <?php
                        if ($resultados[1]->{9}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1"><span id="transfusionesFechaSpan">
                        <?php
                        if (isset($resultados[1]->{247}->NOTAS)) {
                            echo $resultados[1]->{247}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="17" rowspan="1"><span id="transfusionesMotivoSpan">
                        <?php
                        if (isset($resultados[1]->{9}->NOTAS)) {
                            echo $resultados[1]->{9}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Hospitalizaciones</td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="hospitalizacionesSiSpan">
                        <?php
                        if ($resultados[1]->{16}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="hospitalizacionesNoSpan">
                        <?php
                        if ($resultados[1]->{16}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1"><span id="hospitalizacionesFechaSpan">
                        <?php
                        if (isset($resultados[1]->{248}->NOTAS)) {
                            echo $resultados[1]->{248}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="17" rowspan="1"><span id="hospitalizacionesMotivoSpan">
                        <?php
                        if (isset($resultados[1]->{16}->NOTAS)) {
                            echo $resultados[1]->{16}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Usa lentes</td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="lentesSiSpan">
                        <?php
                        if ($resultados[4]->{249}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="lentesNoSpan">
                        <?php
                        if ($resultados[4]->{249}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1"><span id="lentesFechaSpan"></span></td>
                <td colspan="17" rowspan="1"><span id="lentesMotivoSpan">
                        <?php
                        if (isset($resultados[4]->{249}->NOTAS)) {
                            echo $resultados[4]->{249}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Alergias</td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="alergiasSiSpan">
                        <?php
                        if ($resultados[1]->{1}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="1" rowspan="1"><span id="alergiasNoSpan">
                        <?php
                        if ($resultados[1]->{1}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1"><span id="alergiasFechaSpan">
                        <?php //no hay fecha de alergias
                        ?>
                    </span></td>
                <td colspan="17" rowspan="1"><span id="alergiasMotivoSpan">
                        <?php
                        if (isset($resultados[1]->{1}->NOTAS)) {
                            echo $resultados[1]->{1}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1">Esquema de Vacunaci&oacute;n:</td>
                <td colspan="3" rowspan="1">Completo</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="esqVacunCompletoSpan">
                        <?php
                        if ($resultados[1]->{239}->RESPUESTA == "Sí") {
                            echo '(x)';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td colspan="2" rowspan="1">Incompleto</td>
                <td class="textCentered" colspan="1" rowspan="1"><span id="esqVacunIncompletoSpan">
                        <?php
                        if ($resultados[1]->{239}->RESPUESTA == "No") {
                            echo '(x)';
                        } else {
                            echo '( )';
                        }
                        ?>
                    </span></td>
                <td colspan="7" rowspan="1">&Uacute;ltima vacuna que se aplic&oacute;:</td>
                <td colspan="7" rowspan="1"><span id="ultVacunSpab">
                        <?php
                        if (isset($resultados[1]->{239}->NOTAS)) {
                            echo $resultados[1]->{239}->NOTAS;
                        }
                        ?>
                    </span></td>
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
                <td class="cent" colspan="1"><span id="hipertensionSiSpan">
                        <?php
                        if ($resultados[1]->{4}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="hipertensionNoSpan">
                        <?php
                        if ($resultados[1]->{4}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Tuberculosis</td>
                <td class="cent" colspan="1"><span id="tuberculosisSiSpan">
                        <?php
                        if ($resultados[1]->{13}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="tuberculosisNoSpan">
                        <?php
                        if ($resultados[1]->{13}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Embolia cerebral</td>
                <td class="cent" colspan="1"><span id="emboliaCerebralSiSpan">
                        <?php
                        if ($resultados[1]->{252}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="emboliaCerebralNoSpan">
                        <?php
                        if ($resultados[1]->{252}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan=" 6">Diabetes</td>
                <td class="cent" colspan="1"><span id="diabetesSiSpan">
                        <?php
                        if ($resultados[1]->{3}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="diabetesNoSpan">
                        <?php
                        if ($resultados[1]->{3}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Hepatitis</td>
                <td class="cent" colspan="1"><span id="hepatitisSiSpan">
                        <?php
                        if ($resultados[1]->{250}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="hepatitisNoSpan">
                        <?php
                        if ($resultados[1]->{250}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Dolor de cabeza intenso (Migraña)</td>
                <td class="cent" colspan="1"><span id="migrañaSiSpan">
                        <?php
                        if ($resultados[1]->{253}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="migrañaNoSpan">
                        <?php
                        if ($resultados[1]->{253}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan=" 6">Colesterol Alto</td>
                <td class="cent" colspan="1"><span id="colesterolAltoSiSpan">
                        <?php
                        if ($resultados[1]->{5}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="colesterolAltoNoSpan">
                        <?php
                        if ($resultados[1]->{5}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Enf. Transm. Sexual</td>
                <td class="cent" colspan="1"><span id="enfermedadTransmSexualSiSpan">
                        <?php
                        if ($resultados[1]->{15}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="enfermedadTransmSexualNoSpan">
                        <?php
                        if ($resultados[1]->{15}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Epilepsia / Convulsiones</td>
                <td class="cent" colspan="1"><span id="epilepsiaSiSpan">
                        <?php
                        if ($resultados[1]->{254}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="epilepsiaNoSpan">
                        <?php
                        if ($resultados[1]->{254}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan=" 6">Enfermedades gastrointestinales</td>
                <td class="cent" colspan="1"><span id="enfGastrointestinalesSiSpan">
                        <?php
                        if ($resultados[1]->{11}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="enfGastrointestinalesNoSpan">
                        <?php
                        if ($resultados[1]->{11}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Enf. Gastrointestinales</td>
                <td class="cent" colspan="1"><span id="enfGastrointestinalesAdicionalesSiSpan">
                        <?php
                        if ($resultados[1]->{292}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="enfGastrointestinalesAdicionalesNoSpan">
                        <?php
                        if ($resultados[1]->{292}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Depresión</td>
                <td class="cent" colspan="1"><span id="depresionSiSpan">
                        <?php
                        if ($resultados[1]->{12}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="depresionNoSpan">
                        <?php
                        if ($resultados[1]->{12}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan=" 6">Enfermedades del corazón</td>
                <td class="cent" colspan="1"><span id="enfCorazonSiSpan">
                        <?php
                        if ($resultados[1]->{7}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="enfCorazonNoSpan">
                        <?php
                        if ($resultados[1]->{7}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Conjuntivitis</td>
                <td class="cent" colspan="1"><span id="conjuntivitisSiSpan">
                        <?php
                        if ($resultados[1]->{251}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="conjuntivitisNoSpan">
                        <?php
                        if ($resultados[1]->{251}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan=" 6">Enf. Psiquiátricas</td>
                <td class="cent" colspan="1"><span id="enfPsiquiatricasSiSpan">
                        <?php
                        if ($resultados[1]->{35}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan=" 1"><span id="enfPsiquiatricasNoSpan">
                        <?php
                        if ($resultados[1]->{35}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
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
                <td class="cent" colspan="1"><span id="dolorEspaldaSiSpan">
                        <?php
                        if ($resultados[1]->{255}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="dolorEspaldaNoSpan">
                        <?php
                        if ($resultados[1]->{255}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="tittleBgP" colspan="6" rowspan="3">
                    <div>Fracturas o Torceduras (parte del Cuerpo lesionada, tratamiento, tiempo de resolución, secuela)</div>
                </td>
                <td class="cent" colspan="1" rowspan="3"><span id="fracturasSiSpan">
                        <?php
                        if ($resultados[1]->{258}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1" rowspan="3"><span id="fracturasNoSpan">
                        <?php
                        if ($resultados[1]->{258}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6">Menstruación con dolor</td>
                <td class="cent" colspan="1"><span id="menstruacionDolorSiSpan">
                        <?php
                        if ($resultados[1]->{282}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="menstruacionDolorNoSpan">
                        <?php
                        if ($resultados[1]->{282}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6">Dificultad para oír</td>
                <td class="cent" colspan="1"><span id="dificultadOirSiSpan">
                        <?php
                        if ($resultados[1]->{260}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="dificultadOirNoSpan">
                        <?php
                        if ($resultados[1]->{260}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6 ">Incapacidad por cólico</td>
                <td class="cent" colspan="1"><span id="incapacidadColicoSiSpan">
                        <?php
                        if ($resultados[1]->{283}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="incapacidadColicoNoSpan">
                        <?php
                        if ($resultados[1]->{283}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6">Enfermedades de la Piel</td>
                <td class="cent" colspan="1"><span id="enfPielSiSpan">
                        <?php
                        if ($resultados[1]->{56}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="enfPielNoSpan">
                        <?php
                        if ($resultados[1]->{56}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="4">Embarazos ¿cuántos?</td>
                <td class="textCentered" colspan="2"><span id="embarazosCuantosSpan">
                        <?php
                        if (isset($resultados[1]->{194}->NOTAS)) {
                            echo '<a>' . $resultados[1]->{194}->NOTAS . '</a>';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="embarazosSiSpan">
                        <?php
                        if (isset($resultados[1]->{194}->NOTAS) && $resultados[1]->{194}->NOTAS > 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="embarazosNoSpan">
                        <?php
                        if (isset($resultados[1]->{194}->NOTAS) && $resultados[1]->{194}->NOTAS == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6">Alteraciones de la Vista</td>
                <td class="cent" colspan="1"><span id="alteracionesVistaSiSpan">
                        <?php
                        if ($resultados[1]->{256}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="alteracionesVistaNoSpan">
                        <?php
                        if ($resultados[1]->{256}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6">Enf. De los Riñones</td>
                <td class="cent" colspan="1"><span id="enfRinonesSiSpan">
                        <?php
                        if ($resultados[1]->{259}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="enfRinonesNoSpan">
                        <?php
                        if ($resultados[1]->{259}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="4">Abortos ¿cuántos?</td>
                <td class="textCentered" colspan="2"><span id="abortosCuantosSpan">
                        <?php
                        if (isset($resultados[1]->{202}->NOTAS)) {
                            echo '<a>' . $resultados[1]->{202}->NOTAS . '</a>';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="abortosSiSpan">
                        <?php
                        if (isset($resultados[1]->{202}->NOTAS) && $resultados[1]->{202}->NOTAS > 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="abortosNoSpan">
                        <?php
                        if (isset($resultados[1]->{202}->NOTAS) && $resultados[1]->{202}->NOTAS == 0) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6">Enfermedades de los Pulmones</td>
                <td class="cent" colspan="1"><span id="enfPulmonesSiSpan">
                        <?php
                        if ($resultados[1]->{257}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="enfPulmonesNoSpan">
                        <?php
                        if ($resultados[1]->{257}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6">Cáncer o tumores</td>
                <td class="cent" colspan="1"><span id="cancerTumoresSiSpan">
                        <?php
                        if ($resultados[1]->{8}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="cancerTumoresNoSpan">
                        <?php
                        if ($resultados[1]->{8}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="8"><span></span></td>
            </tr>
            <tr>
                <td colspan="6"></td>
                <td colspan="1"><span></span></td>
                <td colspan="1"><span></span></td>
                <td class="tittleBgP" colspan="6">Obesidad IMC &gt;30</td>
                <td class="cent" colspan="1"><span id="obesidadImcSiSpan">
                        <?php
                        if ($resultados[6]->{3}->VALOR >= 30) {
                            echo 'x';
                        } //preguntar por comprobacion
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="obesidadImcNoSpan">
                        <?php
                        if ($resultados[6]->{3}->VALOR <= 29.9) {
                            echo 'x';
                        }
                        ?>
                    </span></td>
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
                <td class="cent" colspan="1"><span id="accTrabajoSiSpan">
                        <?php
                        if ($resultados[1]->{54}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="accTrabajoNoSpan">
                        <?php
                        if ($resultados[1]->{54}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6"><span id="accTrabajoCualesSpan">
                        <?php
                        if (isset($resultados[1]->{220}->NOTAS)) {
                            echo $resultados[1]->{220}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="9"><span id="accTrabajoSecuelasSpan">
                        <?php
                        if (isset($resultados[1]->{221}->NOTAS)) {
                            echo $resultados[1]->{221}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2"><span id="accTrabajoIppSpan">
                        <?php
                        if (isset($resultados[1]->{222}->NOTAS)) {
                            echo $resultados[1]->{222}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBgP" colspan="5">Enfermedades de trabajo</td>
                <td class="cent" colspan="1"><span id="enfTrabajoSiSpan">
                        <?php
                        if ($resultados[1]->{55}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="enfTrabajoNoSpan">
                        <?php
                        if ($resultados[1]->{55}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6"><span id="enfTrabajoCualesSpan">
                        <?php
                        if (isset($resultados[1]->{223}->NOTAS)) {
                            echo $resultados[1]->{223}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="9"><span id="enfTrabajoSecuelasSpan">
                        <?php
                        if (isset($resultados[1]->{224}->NOTAS)) {
                            echo $resultados[1]->{224}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2"><span id="enfTrabajoIppSpan">
                        <?php
                        if (isset($resultados[1]->{225}->NOTAS)) {
                            echo $resultados[1]->{225}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleBgP" colspan="5">Accidentes de trayecto o viales</td>
                <td class="cent" colspan="1"><span id="accTrayectoSiSpan">
                        <?php
                        if ($resultados[1]->{229}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent" colspan="1"><span id="accTrayectoNoSpan">
                        <?php
                        if ($resultados[1]->{229}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td colspan="6"><span id="accTrayectoCualesSpan">
                        <?php
                        if (isset($resultados[1]->{226}->NOTAS)) {
                            echo $resultados[1]->{226}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="9"><span id="accTrayectoSecuelasSpan">
                        <?php
                        if (isset($resultados[1]->{227}->NOTAS)) {
                            echo $resultados[1]->{227}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td style="text-align: center; vertical-align: middle;" colspan="2"><span id="accTrayectoIppSpan">
                        <?php
                        if (isset($resultados[1]->{228}->NOTAS)) {
                            echo $resultados[1]->{228}->NOTAS;
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td class="tittleCenterBgB" colspan="6" rowspan="1">Puesto en sus empleos anteriores</td>
                <td>A&ntilde;os</td>
                <td colspan="15" rowspan="1">En sus trabajos anteriores ha estado expuesto a algunos de los siguientes casos:</td>
                <td class="textCentered">S&iacute;</td>
                <td class="textCentered">No</td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan1">
                        <?php
                        if (isset($resultados[1]->{284}->NOTAS)) {
                            echo $resultados[1]->{284}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan1">
                        <?php
                        if (isset($resultados[1]->{285}->NOTAS)) {
                            echo $resultados[1]->{285}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="15" rowspan="1">Productos químicos (polvos, humos, neblina, vapores, aerosoles):</td>
                <td class="cent"><span id="productosQuimicosSiSpan">
                        $resultados[1]->{61}->RESPUESTA == "Sí"
                    </span></td>
                <td class="cent"><span id="productosQuimicosNoSpan">
                        <?php
                        if ($resultados[1]->{61}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Temperaturas elevadas extremas o bajas extremas o vibraciones:</td>
                <td class="cent"><span id="tempElevadasSiSpan">
                        <?php
                        if ($resultados[1]->{203}->RESPUESTA == "Sí" || $resultados[1]->{204}->RESPUESTA == "Sí" || $resultados[1]->{205}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="tempElevadasNoSpan">
                        <?php
                        if ($resultados[1]->{203}->RESPUESTA == "No" || $resultados[1]->{204}->RESPUESTA == "No" || $resultados[1]->{205}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan2">
                        <?php
                        if (isset($resultados[1]->{286}->NOTAS)) {
                            echo $resultados[1]->{286}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan2">
                        <?php
                        if (isset($resultados[1]->{287}->NOTAS)) {
                            echo $resultados[1]->{287}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="15" rowspan="1">Áreas con niveles elevados de ruido:</td>
                <td class="cent"><span id="nivelesRuidoSiSpan">
                        <?php
                        if ($resultados[1]->{60}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="nivelesRuidoNoSpan">
                        <?php
                        if ($resultados[1]->{60}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Levantamiento de cargas pesadas y repetitivas:</td>
                <td class="cent"><span id="cargasPesadasSiSpan">
                        <?php
                        if ($resultados[1]->{206}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="cargasPesadasNoSpan">
                        <?php
                        if ($resultados[1]->{206}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan3">
                        <?php
                        if (isset($resultados[1]->{288}->NOTAS)) {
                            echo $resultados[1]->{288}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan3">
                        <?php
                        if (isset($resultados[1]->{289}->NOTAS)) {
                            echo $resultados[1]->{289}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="15" rowspan="1">Trabajos manuales repetitivos:</td>
                <td class="cent"><span id="trabajosManualesSiSpan">
                        <?php
                        if ($resultados[1]->{207}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="trabajosManualesNoSpan">
                        <?php
                        if ($resultados[1]->{207}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Agentes biológicos (bacterias, virus, hongos u otros):</td>
                <td class="cent"><span id="agentesBiologicosSiSpan">
                        <?php
                        if ($resultados[1]->{208}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="agentesBiologicosNoSpan">
                        <?php
                        if ($resultados[1]->{208}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="6" rowspan="2"><span id="puestoEmpleoAntSpan4">
                        <?php
                        if (isset($resultados[1]->{290}->NOTAS)) {
                            echo $resultados[1]->{290}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="1" rowspan="2"><span id="puestoEmpleoAntAnyosSpan4">
                        <?php
                        if (isset($resultados[1]->{291}->NOTAS)) {
                            echo $resultados[1]->{291}->NOTAS;
                        }
                        ?>
                    </span></td>
                <td colspan="15" rowspan="1">Radiaciones (rayos X, láser, infrarrojos, UV u otros):</td>
                <td class="cent"><span id="radiacionesSiSpan">
                        <?php
                        if ($resultados[1]->{66}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="radiacionesNoSpan">
                        <?php
                        if ($resultados[1]->{66}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="15" rowspan="1">Trabajo bajo estrés, ambientes cerrados, rolar turnos, tiempo extra:</td>
                <td class="cent"><span id="estresAmbientesSiSpan">
                        <?php
                        if ($resultados[1]->{209}->RESPUESTA == "Sí") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
                <td class="cent"><span id="estresAmbientesNoSpan">
                        <?php
                        if ($resultados[1]->{209}->RESPUESTA == "No") {
                            echo 'x';
                        }
                        ?>
                    </span></td>
            </tr>
            <tr>
                <td colspan="24">Doy fe de que las respuestas son verídicas y correctas de acuerdo a mi leal saber y entender.</td>
            </tr>
            <tr>
                <td colspan="16">Acepto y entiendo que cualquier declaración falsa será motivo de mi despido o recesión de contrato.</td>
                <td class="textCentered" colspan="8"><span id="firmaAspiranteSpan">
                        <?php
                        //pendiente
                        ?>
                        __________________</span></td>
            </tr>
            <tr>
                <td colspan="16">Formato 5 -1</td>
                <td class="textCentered" colspan="8">Firma del aspirante</td>
            </tr>
        </tbody>
    </table>
</body>

</html>