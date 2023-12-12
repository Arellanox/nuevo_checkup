<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de interpretación de Historia Clinica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 165px 10px;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin-top: 60px;
            margin-bottom: 40px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: -175px;
            left: 25px;
            right: 25px;
            height: 220px;
            margin-top: 0;
        }

        .footer {
            position: fixed;
            bottom: -200px;
            left: 25px;
            right: 25px;
            height: 220px;
            /* background-color: pink; */
        }

        a {
            position: fixed;
            padding: 0px;
            top: -15px;
            left: 40px
        }

        .footer .page:after {
            content: counter(page);
        }

        /* Saltar a nueva pagina */
        .break {
            page-break-after: always;
        }

        /* Content */
        .invoice-content {
            border-radius: 4px;
            padding-bottom: 10px;
            padding-right: 30px;
            padding-left: 30px;
            text-align: justify;
            text-justify: inter-word;
            /* background-color: pink; */
        }


        h1 {
            font-size: 22px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h2 {
            font-size: 15px;
            margin-top: 18px;
            /* margin-bottom: 10px; */
            text-align: center;
            background-color: rgba(215, 222, 228, 0.748);
            /* padding-top: 10px; */
        }

        h3 {
            font-size: 16px;
            margin-top: 2px;
            margin-bottom: 2px;
        }

        h4 {
            font-size: 14px;
            margin-top: 2px;
            margin-bottom: 2px;
            line-height: 1;
        }

        h5 {
            font-size: 12.5px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        p {
            font-size: 12px;
            line-height: 1;
        }

        strong {
            font-size: 12px;
            /* line-height: 1.3; */
            margin-top: 0.5em;
            margin-bottom: 0.5em;

        }

        .align-center {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
            /* table-layout:fixed; */
        }

        th,
        td {
            width: 100%;
            max-width: 100%;
            word-break: break-all;
        }

        /* Para divisiones de 3 encabezado*/
        .col-left {
            width: 44%;
            max-width: 44%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-center {
            width: 32%;
            max-width: 32%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 24%;
            max-width: 24%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        /* divisiones de 3 footer */
        .col-foot-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
            font-size: 12px;
        }

        .col-foot-two {
            width: 40%;
            max-width: 40%;
            text-align: center;
            font-size: 12px;
        }

        .col-foot-three {
            width: 30%;
            max-width: 30%;
            text-align: right;
            font-size: 12px;
        }

        /* Para divisiones de 4 */
        .result {
            font-size: 12px
        }

        /* diviciones de 2 */
        .col-izq {
            width: 30%;
            max-width: 30%;
            text-align: center;
        }

        .col-der {
            width: 70%;
            max-width: 70%;
            text-align: left;
        }

        /* Fivisiones de cinco */
        .col-one {
            width: 30%;
            max-width: 30%;
            text-align: left;
        }

        .col-two {
            width: 20%;
            max-width: 20%;
            text-align: right;
        }

        .col-three {
            width: 25%;
            max-width: 25%;
            text-align: center;

        }

        .col-four {
            width: 25%;
            max-width: 25%;
            text-align: center;
        }

        .invoice-content>.table-ant {
            border-collapse: collapse;
            width: 100%;
        }


        .invoice-content>.table-ant>.th,
        .td {
            padding: 4px;
            text-align: center !important;
            border-bottom: 1px solid #ddd;
        }

        .invoice-content>.table-ant>.th {
            background-color: #f2f2f2;
            font-weight: bold;
        }


        /* Estilos para la tabla de audiometria tonal */
        .tonal>.table-tonal {
            border-collapse: collapse;
            width: 70%;
        }

        .tonal>.table-tonal>.th-tonal,
        .td-tonal {
            border: 2px solid black;
            padding: 2px;
            text-align: center;
        }

        .tonal>.table-tonal>.th-tonal {
            background-color: #f2f2f2;
        }

        /* termina estilos para tabla de audiometria tonal */


        /* Estilos de tabla de audiometria */
        .img-audiometria table {
            width: 100%;
            border-collapse: collapse;
        }

        .img-audiometria th,
        .img-audiometria td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        .img-audiometria th {
            background-color: #e1e6ea;
            color: black;
        }

        .img-audiometria img {
            max-width: 100%;
            height: auto;
        }

        /* Fin de estilos de audiometria */
    </style>
</head>

<?php

// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('../pdf/public/assets/firma_audio.png');
$encode_firma = base64_encode($ruta_firma);


?>

<body>
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Información del paciente';
        $subtitulo = 'Valoración prequirúrgica';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_AUDIO;
        include 'includes/header.php';
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        $footerDoctor = 'Dra. Leonor Alvarado-Cortés <br>UJAT - Cédula profesional: 584962 
                        <br>Certified Occupational Hearing Conservationist <br>CAOHC ID NUMBER: 516334';

        include 'includes/footer.php';
        ?>
    </div>


    <!-- body -->
    <div class="invoice-content">
        <!-- Antecedentes del paciente -->
        <div id="antecedentes">
            <h2 style="padding:0px !important;">Antecedentes</h2>
            <div class="content">
                <table class="" style="max-width:10px !important; font-size:9;">
                    <tbody class="">
                        <tr class="">
                            <td class="" style='max-width:190px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES PERSONALES PATOLÓGICOS:</label>
                                    <label class=""> QUISTE SIMPLE DE OVARIO DIAGNOSTICADO HACE 6 MESES, SIN TRATAMIENTO, OBESIDAD GII</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES QURÚRGICOS:</label>
                                    <label class=""> SI CUALES NO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ANTECEDENTES DE FRACTURAS:</label>
                                    <label class=""> SI CUALES NO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> HOSPITALIZACIONES PREVIAS:</label>
                                    <label class=""> SI CUALES NO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ALERGIAS:</label>
                                    <label class=""> SI CUALES NO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> TABAQUISMO:</label>
                                    <label class=""> SI CANTIDAD NO DESDE CUANDO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ALCOHOLISMO:</label>
                                    <label class=""> SI CANTIDAD Y FRECUENCIA NO DESDE CUANDO </label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> TOXICOMANIAS:</label>
                                    <label class=""> SI CUAL Y FRECUENCIA NO DESDE CUANDO </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Cirugia programada -->
        <div class="cirugia">
            <h2 style="padding:0px !important;">Cirugía Programada: LIPOESCULTURA</h2>
            <div class="content">
                <p id="back_cirugia" style="font-size: 9; line-height:1.2em;">
                    TENSIÓN ARTERIAL 120/83 MMHG FRECUENCIA CARDIACA: 66 LATIDOS POR MINUTO FRECUENCIA RESPIRATORIA: 20 RESPIRACIONES POR MINUTO TEMPERATURA 35.8°C SATURACIÓN DE OXÍEGNO 96%
                </p>
            </div>
        </div>
        <!-- Exploracion fisiica -->
        <div class="exploracion_fisica">
            <h2 style="padding:0px !important;">Exploracion Fisica</h2>
            <p id="exploracion_fisica" style="font-size: 9; line-height:1.2em;">
                GLASGOW 15, CONSCIENTE Y ORIENTADA EN SUS TRES ESFERAS NEUROLOGICAS, TIEMPO, ESPACIO Y PERSONA, ADECUADA PIGMENTACION Y ESTADO HIDRICO DE MUCOSAS Y TEGUMENTOS, PUPILAS NORMOREFLEXICAS AL ESTIMULO LUMINOSO, CUELLO SIN ADENOPATIAS PALPABLES, SIN INGURGITACION YUGULAR, TORAX ESTRUCTURALMENTE INTEGRO, CON ADECUADA MECANICA VENTILATORIA, CAMPOS PULMONARES BIEN VENTILADOS, ADECUADA TRANSMISION DE LA VOZ, SIN ALTERACIONES A LA PERCUSION, NO HAY ESTERTORES O AGREGADOS, RUIDOS CARDIACOS DE ADECUADO RITMO, TONO E INTENSIDAD, ABDOMEN GLOBOSO A EXPENSAS DE PANICULO ADIPOSO, BLANDO Y DEPRESIBLE, NO DOLOROSO A LA PALPACION, CON PERISTALSIS PRESENTE, NORMOAUDIBLE, SIN DATOS DE IRRITACION PERITONEAL, EXPLORACION GENITAL DIFERIDA, EXTREMIDADES EUTERMICAS, EUTROFICAS, CON LLENADO CAPILAR DE DOS SEGUNDOS, ROTS ++, DANIELS 5/5.
            </p>
        </div>
        <div class="break"></div>
        <!-- Laboratorios -->
        <div class="laboratorios">
            <h2 style="padding:0px !important;">Laboratorios</h2>
            <p style="font-size: 9; line-height:1.2em;">
                <strong>FECHA 28/11/2023:</strong> HB 13.9 HTO 41 LEUCOS 7.500 LINFOS 36 NEUTROS 59 PLAQUETAS 215,000 GLUCOSA 78 UREA 17 BUN 7.99 CREAT 0.70 AC URICO 4.2 CT 213 TG 148 SODIO 137 POTASIO 3.6 CLORO 102 CALCIO 9.5 MG 2 FOSFORO 3.19 BT 0.54 BD 0.18 BI 0.36 AST 17 ALT 21 DHL 176 PROTEINAS TOTALE S7 ALBUMINA 3.94 GGT 24 TP 13 INR 0.98 TPT 31 GRUPO Y RH O POSITIVO, VIH NEGATIVO, ANT P24 NEGATIVO <strong>SE PUEDE TOMAR DEL SISTEMA AUTOMÁTICAMENTE.</strong>
            </p>
            <br>
            <div class="content">
                <table class="" style="max-width:10px !important; font-size:9;">
                    <tbody class="">
                        <tr class="">
                            <td class="" style='max-width:190px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> ELECTROCARDIOFRAMA 12 DERIVACIONES :</label>
                                    <label class=""> CON CALIBRACION ESTANDAR RITMO SINUSAL, CON FRECUENCIA CARDIACA DE 60 LPM, CON EJE CARDICO 60° NO SE OBSERVAN BLOQUEOS DE RAMA, QRS 0.08S QTC 360 NO HAY BLOQUEOS DE RAMA, SIN ALTERACIONES EN LA ONDA T, NO HAY DATOS DE ISQUEMIA LESION O NECROSIS, SOKOLOW 17, NO CUMPLE CRITERIOS PARA HVI, EKG NORMAL.</label>
                                </div>
                            </td>
                        </tr>
                        <tr class="">
                            <td class="" style='max-width:180px;'>
                                <div class="d-flex">
                                    <label class="h7" style="font-weight: bold;"> RADIOGRAFÍA DE TORAX:</label>
                                    <label class=""> TEJIDOS BLANDOS Y OSEOS ESTRUCTURALMENTE INTEGROS, SIN SOLUCIONES DE CONTINUIDAD, SE OBSERVA TRAQUEA CENTRAL CON COLUMNA DE AIRE VISIBLE, CAMPOS PULMONARES SIN INFILTRADOS O CONSOLIDACIONES, SILUETA CARDIACA DE ADECUADO TAMAÑO, SIN ALTERACIONES, SE OBSERVAN AMBOS ANGULOS CARDIOFRENICOS Y COSTODIAFRAGMATICOS. </label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Riesgos quirurgico -->
        <div class="riesgos_quirurgicos">
            <h2 style="padding:0px !important;">Riesgos Quirúrgico</h2>
            <div class="content">
                <div class="content">
                    <table class="" style="max-width:10px !important; font-size:9;">
                        <tbody class="">
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">ASA:</label>
                                        <label class=""> Select.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GOLDMAN:</label>
                                        <label class=""> Select.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA RESPIRATORIO :</label>
                                        <label class=""> 0.2% DE RIESGO PARA REQUERIR VENTILACION MECANICA POR 48HRS POSTERIOR A CIRUGIA, PRACTICAMENTE NULO</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA NEUMONIA:</label>
                                        <label class=""> 0.2% DE DESARROLLAR NEUMONIA POSTERIOR AL PROCEDIMIENTO</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GUPTA CARDIOVASCULAR:</label>
                                        <label class="">TIENE UN RIESGO DE 0% DE PRESENTAR IAM DURANTE EL PROCEDIMIENTO O HASTA 30 DIAS POSTERIOR AL MISMO.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">GENEVA:</label>
                                        <label class=""> BAJO RIESGO PARA TEV</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">CAPRINI :</label>
                                        <label class=""> RIESGO MODERADO PARA TEV.</label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="">
                                <td class="" style='max-width:190px;'>
                                    <div class="d-flex">
                                        <label class="h7" style="font-weight: bold;">STOP- BANG :</label>
                                        <label class=""> BAJO RIESGO DE SAOS.</label>
                                    </div>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="break"></div>
        <!-- Recomendaciones -->
        <div class="recomendaciones">
            <h2 style="padding:0px !important;">Recomendaciones</h2>
            <div class="content">
                <div class="recomendacion_general">
                    <p style="font-size: 9; line-height:1.2em;">
                        PACIENTE SALUDABLE CON ADECUADO ESTADO DE SALUD EN GENERAL, SIN COMORBILIDADES, SUS LABORATORIOS DENTRO DE PARAMETROS NORMALES, SE RECOMIENDA A LA PACIENTE EVITAR INGERIR ASPIRINA Y DERIVADOS UNA SEMANA PREVIA A PROCEDIMIENTOS, LOS SCORES PREDICTORES CON BAJO RIESGO PARA DESARROLLAR COMPLICACIONES TROMBOEMBOLICAS SE RECOMIENDA LA PROFILAXIS MECANICA Y PUEDEN CONSIDERARSE DOSIS BAJAS DE HEPARINA DE BAJO PESO MOLECULAR.
                    </p>
                </div>
                <div class="list">
                    <p>
                        1. AYUNO 8 HRS PREVIAS A LA CIRUGIA
                        <br> <br>
                        2. EVITAR SOBRECARGA HIDRICA, SE RECOMIENDA CANALIZAR CON SOL. HARTMANN DURANTE EL PROCEDIMIENTO, GUIAR REANIMACION POR METAS (MANTENER PAM >65MMHG, DIURESIS > 0.5 A 1.5ML/KG/HRA, BALANCES NEUTROS O DISCRETAMENTE NEGATIVOS.)
                        <br> <br>
                        3. ENOXAPARINA 40MG SC CADA 24 HRS, INICIAR 24 HRS POSTERIOR A LA CIRUGIA
                        <br> <br>
                        4. MEDIAS DE COMPRESION INTERMEDIA 20 A 30MMHG
                        <br> <br>
                        5. DEAMBULACION TEMPRANA
                        <br> <br>
                        6. MANTENER 1 PG EN RESERVA PARA QUIROFANO
                        <br> <br>
                        7. ANALGESIA DE ACUERDO A LA OMS, INICIAR CON PARACETAMOL 1GR IV CADA 8 HRS
                        <br> <br>
                        8. GRACIAS
                    </p>
                </div>
            </div>
        </div>
    </div>

</body>



</html>