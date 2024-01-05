<style>
    @page {
        margin: 80px 10px 94px 10px;
    }

    .body-certificado {
        padding: 10px 30px 10px 30px;
    }

    .body-certificado p {
        font-size: 13px;
    }

    .body-certificado h1 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado .none-p {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado .center {
        text-align: center !important;
    }

    .body-certificado .justify {
        text-align: justify !important;
    }

    .body-certificado table {
        width: 100%;
        max-width: 100%;

        caption-side: bottom;
        border-collapse: collapse;
    }

    .body-certificado th,
    .body-certificado td {
        border: 1px solid black;
        width: 100%;
        max-width: 100%;
        word-break: break-all;
    }

    .body-certificado .border {
        border: 1px solid black;
    }

    .body-certificado td {
        padding: 2px;
        font-size: 13px;
    }

    .body-certificado .res {
        font-size: 13px !important;
    }

    .body-certificado .left {
        padding-left: 30px !important;
    }

    .body-certificado .bg {
        background-color: #e7e6e6 !important;
    }

    .body-certificado .bold {
        font-weight: bold !important;
    }

    .body-certificado .italic {
        font-style: italic !important;
    }

    .body-certificado .pb {
        padding-bottom: 20px !important;
    }

    .body-certificado .p {
        padding: 5px !important;
    }

    .body-certificado .tabla2 {
        margin-left: auto !important;
    }

    .body-certificado .bg-black {
        background-color: black !important;
    }

    .body-certificado .bg-gray {
        background-color: #757070 !important;
    }

    .body-certificado .title {
        position: absolute;
        top: -50px;
    }
</style>

<?php

function convertirObjetoAArray($objeto)
{
    if (is_object($objeto)) {
        // Opción 1: Utilizar el casting
        $array_resultante = (array) $objeto;

        // Opción 2: Utilizar get_object_vars
        // $array_resultante = get_object_vars($objeto);

        return $array_resultante;
    } else {
        // Si el argumento no es un objeto, puedes manejarlo de acuerdo a tus necesidades
        return array();
    }
}

# aqui se recibe la data
$cuerpo = convertirObjetoAArray($resultados[0]->CUERPO);
$medico = convertirObjetoAArray($resultados[0]->MEDICO_INFO);
$resultado = convertirObjetoAArray($resultados[0]->DATA_BASE);
$servicios = convertirObjetoAArray($resultado['SERVICIOS']);

// echo "<pre>";
// var_dump();
// echo "</pre>";
// exit;

# arreglo para rellenar el certificado de vinco
$vinco = array(
    "paciente" => array(
        "nombre" => $resultados[0]->PX,
        "fecha" => "07 octubre 2023",
        "lugar" => "Villahermosa, Tabasco.",
        "edad" => $resultados[0]->EDAD_L,
        "nacionalidad" => $resultado[0]->NACIONALIDAD
    ),
    "examen_medico" => array(
        "tipo" => $cuerpo['tipo_examen_medico'],
        "procedencia" => "VINCO",
        "posicion" => $resultados[0]->PROFESION,
    ),
    "diagnostico_tabla" => "PITIRIASIS VERSICOLOR EN PIERNA DERECHA",
    "clasificacion" => $cuerpo['clasificacion_grado_salud'],
    "aptitud_trabajo" => "1",
    "vigencia" => $cuerpo['vigencia_certificado'] . " AÑO",
    "fecha_vencimiento" => "06/10/2024",
    "estudios" => array(
        "Audiometria_tonal" => $cuerpo['audiometria_tonal'],
        "valoracion_visual" => $cuerpo['valoracion_visual'],
        "tele_torax" => $cuerpo['tele_torax'],
        "rx_lateral_columna" => "De aspecto normal",
        "electrocardiograma" => $cuerpo['electrocardiograma_analisis'],
        "inbody" => $cuerpo['inbody'],
        "signos_vitales_1" => $cuerpo['signos_vitales'],
        "biometria_hematica_completa"  => $cuerpo['biometria_hematica_analisis'],
        "quimica_sanguinea_6" => $cuerpo['quimica_6_elementos'],
        "perfil_droga_5" => $cuerpo['perfil_drogas_5_elementos'],
        "etanol_sangre" => $cuerpo['etanol_sangre'],
        "examen_orina" => $cuerpo['examen_general_orina']
    ),
    "medico" => array(
        "nombre" => $medico['INFO_UNIVERSIDAD'][0]->NOMBRE_COMPLETO,
        "profesion" => $medico['INFO_UNIVERSIDAD'][0]->PROFESION,
        "cedula" => $medico['INFO_UNIVERSIDAD'][0]->CEDULA,
        "firma" => "",
        "especialidades" => $medico['INFO_ESPECIALIDAD'][0]->CEDULA
    ),
    "Hallazgo" => $cuerpo['hallazgo_encontrados'],
    "signos_vitales" => $resultados[0]->SIGNOS_VITALES_REPORTE,
    "exploracion_fisica" => $cuerpo['exploracion_fisica'],
    "Estudios_2" => array(
        "agudeza_visual" => array(
            "Descripción" => $resultado['OFTALMOLGIA']->AGUDEZA_VISUAL->DESCRIPCION,
            "OD" => $resultado['OFTALMOLGIA']->AGUDEZA_VISUAL->OD,
            "OI" => $resultado['OFTALMOLGIA']->AGUDEZA_VISUAL->OI,
        ),
        "Jaeger" => array(
            "Descripcion" => $resultado['OFTALMOLGIA']->JEAGER->DESCRIPCION,
            "1" => $resultado['OFTALMOLGIA']->JEAGER->jaeger,
            "vision_cromatica" => $cuerpo['vision_cromatica'],
        ),
        "fondo_ojo" => $cuerpo['fondo_ojo'],
        "segemento_anterior" => $cuerpo['segmento_anterior'],
        "segemento_posterior" => $cuerpo['segmento_posterior'],
        "valoracion_ofatlmolgica" => $resultado['OFTALMOLGIA']->DIAGNOSTICO,
        "audiometria" => $cuerpo['audiometria'],
        "rx_tele_torax" => $servicios['TELE DE TÓRAX POSTERO ANTERIOR (PA)']->INTERPRETACION,
        "rx_lumbar_anteroposterior" =>  $servicios['COLUMNA LUMBAR ANTEROPOSTERIOR']->INTERPRETACION,
        "rx_lumbar_lateral" => $servicios['COLUMNA LUMBAR LATERAL']->INTERPRETACION,
        "ultrasonido_abdominal" => $servicios['ULTRASONIDO DE ABDOMEN COMPLETO']->INTERPRETACION,
        "ultrasonido_doppler_bilateral" => $servicios['DOPPLER CAROTIDEO BILATERAL']->INTERPRETACION,
        "electrocardiograma" => $cuerpo['electrocardiograma']
    ),
    "Laboratorio" => array(
        "biometria_hematica" => $cuerpo['biometria_hematica'],
        "quimica_sanguinea" => $resultado['LABORATORIO']->QUIMICA_SANGUINEA_TEXT,
        "examen_general_orina" => $cuerpo['examen_general_orina']
    ),
    "diagnostico" => $resultado['HISTORIA']->DIAGNOSTICO,
    "recomendaciones" => $resultado['HISTORIA']->RECOMENDACIONES
);
?>
<!-- Body -->
<div class="body-certificado">
    <!-- Header -->
    <div class="title">
        <p>
            CERTIFICADO <strong class="italic">MÉDICO</strong> <br>
            Resultado de evaluación médica laboral <br>
            Nombre de la <strong>empresa:</strong> <br>
            <strong>VINCO ENERGY SERVICES S.A. DE C.V</strong>
        </p>
    </div>
    <!-- Tabla 1 -->
    <table>
        <!-- Datos Generales -->
        <tr>
            <td colspan="10" class="bg center bold italic">DATOS GENERALES</td>
        </tr>
        <tr>
            <td colspan="5">
                LUGAR:
                <strong>
                    <?php
                    # lugar supongo que del paciente xd
                    echo $vinco['paciente']['lugar']
                    ?>
                </strong>
            </td>
            <td colspan="5">
                FECHA:
                <strong>
                    <?php
                    # sabra dios que fecha se requiere ahi
                    echo $vinco['paciente']['fecha']
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                NOMBRE:
                <strong>
                    <?php
                    # nombre del pacientes 
                    echo $vinco['paciente']['nombre'];
                    ?>
                </strong>
            </td>
            <td colspan="2">
                EDAD:
                <strong>
                    <?php
                    # edad
                    echo $vinco['paciente']['edad'];
                    ?>
                </strong>
            </td>
            <td colspan="4">
                NACIONALIDAD:
                <strong>
                    <?php
                    # nacionalidad
                    echo $vinco['paciente']['nacionalidad'];
                    ?>
                </strong>
            </td>
        </tr>
        <!-- Examen periodico -->
        <tr>
            <td colspan="10" class="bg center bold italic">TIPO DE EXAMEN MEDICO</td>
        </tr>
        <tr>
            <td>INGRESO</td>
            <td class="bold center"></td>
            <td>PERIODICO</td>
            <td class="bold center">X</td>
            <td>EGRESO</td>
            <td class="bold center"></td>
            <td>ESPECIAL</td>
            <td class="bold center"></td>
            <td>OTRO:</td>
            <td class="bold center"></td>
        </tr>
        <tr>
            <td colspan="10">
                QUIEN ES/ SERA CONSIDERADO PERSONAL EN ACTIVO EN LA EMPRESA:
                <strong>
                    <?php
                    # procedencia
                    echo $vinco['examen_medico']['procedencia']
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                EN LA POSICIÓN DE:
                <strong>
                    <?php
                    # no se que es pero es de que trabaja creo xd
                    echo $vinco['examen_medico']['posicion']
                    ?>
                </strong>
            </td>
        </tr>
        <!-- Diagnostico -->
        <tr>
            <td colspan="10" class="bg center bold italic">DIAGNÓSTICO</td>
        </tr>
        <tr>
            <td colspan="10" class="center bold italic pb">
                <?php
                # diagnostico
                echo $vinco['diagnostico_tabla']
                ?>
            </td>
        </tr>
        <tr>
            <td colspan="10" class="bg center bold italic">CLASIFICACIÓN EN GRADO DE SALUD </td>
        </tr>
        <tr>
            <td colspan="10" class="center bold italic pb">
                <?php
                # no se que es pero tiene un 1
                echo $vinco['clasificacion']
                ?>
            </td>
        </tr>
        <!-- APTITUDES PARA EL TRABAJO -->
        <tr>
            <td colspan="10" class="bg center bold italic">APTITUD DE TRABAJO</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1" class="bg-black"></td>
            <td colspan="8">
                APTO PARA TRABAJAR
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="8">
                APTO PARA TRABAJAR
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1"></td>
            <td colspan="8">
                NO APTO PARA TRABAJAR
            </td>
        </tr>
    </table>
    <!-- Extension de la tabla 1 -->
    <table style="width: 60%;" class="tabla2">
        <tr>
            <td style="border-top: none;" class="p  bg center bold italic"> VIGENCIA</td>
            <td style="border-top: none;" class="p">
                <?php
                # vigencia
                echo $vinco['vigencia']
                ?>
            </td>
            <td style="border-top: none;" class="p  bg center bold italic"> FECHA DE
                VENCIMIENTO </td>
            <td style="border-top: none;" class="p">
                <?php
                # fecha de vencimiento
                echo $vinco['fecha_vencimiento']
                ?>
            </td>
        </tr>
    </table>
    <!-- Tabla 2 -->
    <!-- Header Tabla 2 -->
    <table style="margin-top: 30px;">
        <tr>
            <td class="bg-gray center bold italic p" style="width: 50%;"></td>
            <td class="bg-gray center bold italic p" style="color: white; width:90%;">
                ESTUDIOS Y ANÁLISIS
                COMPLEMENTARIOS
            </td>
            <td style="border: none;"></td>
        </tr>
    </table>
    <table>

        <tr>
            <td class="bg p center bold italic">
                ESTUDIO
            </td>
            <td class="bg p center bold italic">
                RESULTADO
            </td>
            <td class="bg p center bold italic">
                ESTUDIO
            </td>
            <td class="bg p center bold italic">
                RESULTADO
            </td>
        </tr>
        <tr>
            <td class="bold center">
                Audiometría tonal
            </td>
            <td class="center">
                <?php
                # resultado de audiometria tonal
                echo $vinco['estudios']['Audiometria_tonal']
                ?>
            </td>
            <td class="bold center">
                Signos vitales
            </td>
            <td class="center">
                <?php
                # resultado de signos vitales
                echo $vinco['estudios']['signos_vitales_1']
                ?>
            </td>
        </tr>
        <tr>
            <td class="bold center">
                Valoración visual
            </td>
            <td class="center">
                <?php
                # resultado de valoración visual
                echo $vinco['estudios']['valoracion_visual']
                ?>
            </td>
            <td class="bold center">
                Biometría hemática
                completa
            </td>
            <td class="center">
                <?php
                # resultado de biometria hematica completa
                echo $vinco['estudios']['biometria_hematica_completa']
                ?>
            </td>
        </tr>
        <tr>
            <td class="bold center">
                Tele de tórax
            </td>
            <td class="center">
                <?php
                # resultado de tele de torax
                echo $vinco['estudios']['tele_torax']
                ?>
            </td>
            <td class="bold center">
                Química sanguínea 6
                elementos
            </td>
            <td class="center">
                <?php
                # resultado de quimica sanguineo 6 elementos
                echo $vinco['estudios']['quimica_sanguinea_6']
                ?>
            </td>

        </tr>
        <tr>
            <td class="bold center">
                Rx Ap y latera de columna
            </td>
            <td class="center">
                <?php
                # resultado de rx ap y latera de columna
                echo $vinco['estudios']['rx_lateral_columna']
                ?>
            </td>
            <td class="bold center">
                Perfil de drogas 5
                elementos
            </td>
            <td class="center">
                <?php
                # resultado de perfil de drogas 5 elementos
                echo $vinco['estudios']['perfil_droga_5']
                ?>
            </td>
        </tr>
        <tr>
            <td class="bold center">
                Electrocardiograma
            </td>
            <td class="center">
                <?php
                # resultado de electrocardiograma
                echo $vinco['estudios']['electrocardiograma']
                ?>
            </td>
            <td class="bold center">
                Etanol en sangre
            </td>
            <td class="center">
                <?php
                # resultado de etanol en sangre
                echo $vinco['estudios']['etanol_sangre']
                ?>
            </td>
        </tr>
        <tr>
            <td class="bold center">
                InBody
            </td>
            <td class="center">
                <?php
                # resultado de inbody
                echo $vinco['estudios']['inbody']
                ?>
            </td>
            <td class="bold center">
                Examen general de orina
            </td>
            <td class="center">
                <?php
                # resultado de examen general de orina
                echo $vinco['estudios']['examen_orina'];
                ?>
            </td>
        </tr>
    </table>
    <div class="conclusion">
        <div class="medico" style="margin-top: 30px; ">
            <p class="bold none-p center">
                <?php
                # nombre de la doctora
                echo $vinco['medico']['nombre']
                ?>
            </p>
            <p class="bold none-p center">
                Cédula profesional:
                <?php
                # cedula profesional
                echo $vinco['medico']['cedula']
                ?>
            </p>
            <p class="bold none-p center">
                Certificación
                <?php
                # certificacion de no se que
                echo $vinco['medico']['especialidades']
                ?>
            </p>
        </div>
    </div>
</div>




<!-- Van juntos -->

<div class="break"></div>
<!-- Segunda pagina -->

<style>
    /* @page {
        margin: 80px 10px 94px 10px;
    } */
</style>
<!-- Body -->
<style>
    .vinco_certificado_2 {
        padding: 10px 80px 10px 80px;
    }

    .vinco_certificado_2 p {
        font-size: 15px;
    }

    .vinco_certificado_2 h1 {
        padding: none !important;
        margin: none !important;
    }

    .vinco_certificado_2 .none-p {
        padding: none !important;
        margin: none !important;
    }

    .vinco_certificado_2 .center {
        text-align: center !important;
    }

    .vinco_certificado_2 .justify {
        text-align: justify !important;
    }

    .vinco_certificado_2 table {
        width: 100%;
        max-width: 100%;

        caption-side: bottom;
        border-collapse: collapse;
    }

    .vinco_certificado_2 th,
    .vinco_certificado_2 td {
        border: 1px solid black;
        width: 100%;
        max-width: 100%;
        word-break: break-all;
    }

    .vinco_certificado_2 .border {
        border: 1px solid black;
    }

    .vinco_certificado_2 td {
        padding: 2px;
        font-size: 15px;
    }

    .vinco_certificado_2 .res {
        font-size: 13px !important;
    }

    .vinco_certificado_2 .left {
        padding-left: 30px !important;
    }
</style>


<!-- Contenedor -->
<div class="vinco_certificado_2">
    <!-- Certificado Medico -->
    <div class="certificado-medico">
        <h1 style="text-align: center;">Certificado Médico</h1>
        <div class="body" style="margin-top: 20px;">
            <p class="none-p">
                La Médico Cirujano que suscribe adscrita a ésta Institución y registrada con Cédula
                Profesional número <?php echo $vinco['medico']['cedula'] ?> ante la Dirección General de Profesiones. Certifica que:
            </p>
            <p class="none-p" style="text-align: center;"> Practicó examen médico a:</p>
            <p class="none-p" style="font-weight: bold; text-decoration:underline; text-align:center;">
                <?php
                # nombre del paciente creo xd
                echo $vinco['paciente']['nombre']
                ?>
            </p>
        </div>
    </div>
    <!-- Hallazgos -->
    <div class="hallazgos" style="margin-top: 30px;">
        <!-- Subtitulo -->
        <p class="center">Encontrando:</p>
        <!-- Body -->
        <div class="body">
            <div class="informacion-paciente">
                <p class="justify">
                    <?php
                    # supongo que son los hallazgos
                    echo $vinco['Hallazgo']
                    ?>
                </p>
            </div>
            <div class="signos-vitales">
                <p class="justify">
                    Signos vitales:
                    <span style="font-size: 12px !important;">
                        <?php echo $vinco['signos_vitales'] ?>
                    </span>
                </p>
            </div>
            <div class="exploracion-fisica">
                <p class="justify">
                    <?php
                    # exploracion fisica
                    echo $vinco['exploracion_fisica']
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="break"></div>
    <!--   Resultados -->
    <div class="resultados">
        <p>Los estudios complementarios presentan los siguientes resultados:</p>
        <!-- Table One  -->
        <table>
            <tr>
                <td colspan="4">Valoración oftalmológica</td>
            </tr>
            <tr>
                <td class="res">
                    Agudeza visual <?php echo $vinco['Estudios_2']['agudeza_visual']['Descripción'] ?>:
                    <br>
                    OD:<?php echo $vinco['Estudios_2']['agudeza_visual']['OD'] ?>
                    <br>
                    OI: <?php echo $vinco['Estudios_2']['agudeza_visual']['OI'] ?>
                </td>
                <td class="res">
                    Visión cercana Tarjeta de
                    Rosenbaum Jaeger <?php echo $vinco['Estudios_2']['Jaeger']['Descripcion'] ?>
                    <br>
                    1: <?php echo $vinco['Estudios_2']['Jaeger']['1'] ?>
                    <br>
                    Visión Cromática:
                    <?php
                    # resultado de vision cromatica
                    echo $vinco['Estudios_2']['Jaeger']['vision_cromatica']
                    ?>
                </td>
                <td class="res">
                    Fondo de
                    Ojo:
                    <br>
                    <?php
                    # resultado de fondo de ojos
                    echo $vinco['Estudios_2']['fondo_ojo']
                    ?>
                </td>
                <td class="res">
                    Segmento Anterior
                    <?php
                    # resultado de segemento anterior
                    echo $vinco['Estudios_2']['segemento_anterior']
                    ?>
                    <br>
                    Segmento Posterior:
                    <?php
                    # resultado de segemento posterior
                    echo $vinco['Estudios_2']['segemento_posterior']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDx:
                    <?php
                    # resultado de valoracion oftalmologica
                    echo $vinco['Estudios_2']['valoracion_ofatlmolgica'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Audiometría</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDx:
                    <?php
                    # resultado de audiometria
                    echo $vinco['Estudios_2']['audiometria'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Rx Tele de tórax</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado rx prueba de tele de torax
                    echo $vinco['Estudios_2']['rx_tele_torax'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Rx de columna lumbar anteroposterior y lateral</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado rx columna lumbar anteroposterior y lateral
                    echo $vinco['Estudios_2']['rx_lumbar_anteroposterior'];
                    echo "<br>";
                    echo '- ' .  $vinco['Estudios_2']['rx_lumbar_lateral'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Electrocardiograma</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado de electrocardiograma
                    echo $vinco['Estudios_2']['electrocardiograma'];
                    ?>
                </td>
            </tr>
        </table>

        <!-- Table Two -->
        <table style="margin-top: 10px;">
            <tr>
                <td colspan="2">
                    Laboratorios
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Biometria Hemática</td>
                <td class="res justify">
                    <?php
                    # resultado de biometria hematica
                    echo $vinco['Laboratorio']['biometria_hematica']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Química sanguínea</td>
                <td class="res justify">
                    <?php
                    # resultado quimica sanguinea
                    echo $vinco['Laboratorio']['quimica_sanguinea']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Examen General de Orina</td>
                <td class="res justify">
                    <?php
                    # resultado de examen general de orina
                    echo $vinco['Laboratorio']['examen_general_orina']
                    ?>
                </td>
            </tr>
        </table>
    </div>


    <div class="break"></div>
    <!-- Conclusiones -->
    <div class="conclusion">
        <p class="justify">
            Por lo que, con los datos encontrados en su exploración y sus estudios, se concluye que el
            paciente cuenta con los siguientes diagnósticos:
            <strong>
                <?php
                # diagnostico 
                echo $vinco['diagnostico'];
                ?>
            </strong>
        </p>
        <p>
            Deberá observar las siguientes:
        </p>
        <table>
            <tr>
                <td>Recomendaciones</td>
            </tr>
            <tr>
                <td class="left">
                    <?php
                    # recomendaciones
                    echo $vinco['recomendaciones']
                    ?>
                </td>
            </tr>
        </table>
        <div class="medico" style="margin-top: 10px; ">
            <p class="none-p center">
                <strong>ATENTAMENTE:</strong>
            </p>
            <p class="none-p center">
                <strong>
                    <?php
                    # nombre de la doctora
                    echo $vinco['medico']['nombre'];
                    ?>
                </strong>
            </p>
            <p class="none-p center">
                <?php
                # profesion
                echo $vinco['medico']['profesion'];
                ?>
            </p>
            <p class="none-p center">
                Cédula profesional:
                <?php
                # cedula
                echo $vinco['medico']['cedula'];
                ?>
            </p>
            <p class="none-p center">
                Certificación
                <?php
                # certificacion
                echo $vinco['medico']['especialidad'];
                ?>
            </p>
        </div>
    </div>
</div>