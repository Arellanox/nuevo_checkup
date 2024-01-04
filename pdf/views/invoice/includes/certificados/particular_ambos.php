<style>
    @page {
        margin: 80px 10px 94px 10px;
    }
</style>



<style>
    .body-certificado {
        padding: 10px 80px 10px 80px;
    }

    .body-certificado p {
        font-size: 15px;
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
        font-size: 15px;
    }

    .body-certificado .res {
        font-size: 13px !important;
    }

    .body-certificado .left {
        padding-left: 30px !important;
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

# variables donde esta toda la informacion para el certificado de particulares
$resultado = convertirObjetoAArray($resultados[0]->DATA_BASE);
$cuerpo = convertirObjetoAArray($resultados[0]->CUERPO);
$medico = convertirObjetoAArray($resultados[0]->MEDICO_INFO);
$servicios = convertirObjetoAArray($resultado['SERVICIOS']);



# arreglo para rellenar el certificado de particulares
$particular = array(
    "Hallazgo" => $cuerpo['hallazgo_encontrados'],
    "signos_vitales" => $resultados[0]->SIGNOS_VITALES_REPORTE,
    "exploracion_fisica" => $cuerpo['exploracion_fisica'],
    "Estudios" => array(
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
        "espirometria" => $cuerpo['espirometria'],
        "prueba_esfuerzo" => $cuerpo['prueba_esfuerzo'],
        "rx_tele_torax" => "Estudio de torax de aspecto normal",
        "rx_lumbar_anteroposterior" =>  $servicios['COLUMNA LUMBAR ANTEROPOSTERIOR']->INTERPRETACION,
        "rx_lumbar_lateral" => $servicios['COLUMNA LUMBAR LATERAL']->INTERPRETACION,
        "ultrasonido_abdominal" => $servicios['ULTRASONIDO DE ABDOMEN COMPLETO']->INTERPRETACION,
        "ultrasonido_doppler_bilateral" => $servicios['DOPPLER CAROTIDEO BILATERAL']->INTERPRETACION,
        "mastografia" => $cuerpo['mastrografia'],
        "citologia_vaginal" => $cuerpo['citologia_vaginal'],
    ),
    "Laboratorio" => array(
        "biometria_hematica" => $cuerpo['biometria_hematica'],
        "quimica_sanguinea" => $resultado['LABORATORIO']->QUIMICA_SANGUINEA_TEXT,
        "perfil_tiroideo" => $resultado['LABORATORIO']->PERFIL_TIROIDEO_TEXT,
        "examen_general_orina" => $cuerpo['examen_general_orina']
    ),
    "diagnostico" => $resultado['HISTORIA']->DIAGNOSTICO,
    "recomendaciones" => $resultado['HISTORIA']->RECOMENDACIONES,
    "medico" => array(
        "nombre" => $medico['INFO_UNIVERSIDAD'][0]->NOMBRE_COMPLETO,
        "profesion" => $medico['INFO_UNIVERSIDAD'][0]->PROFESION,
        "cedula" => $medico['INFO_UNIVERSIDAD'][0]->CEDULA,
        "firma" => "",
        "especialidades" => $medico['INFO_ESPECIALIDAD'][0]->CEDULA
    ),
    "paciente" => $resultados[0]->PX
);

// echo "<pre>";
// var_dump($cuerpo);
// echo "</pre>";

?>


<!-- Contenedor -->
<div class="body-certificado">
    <!-- Certificado Medico -->
    <div class="certificado-medico">
        <h1 style="text-align: center;">Certificado Médico</h1>
        <div class="body" style="margin-top: 20px;">
            <p class="none-p">
                La Médico Cirujano que suscribe adscrita a ésta Institución y registrada con Cédula
                Profesional número <?php echo $particular['medico']['cedula'] ?> ante la Dirección General de Profesiones. Certifica que:
            </p>
            <p class="none-p" style="text-align: center;"> Practicó examen médico a:</p>
            <p class="none-p" style="font-weight: bold; text-decoration:underline; text-align:center;">
                <?php
                # nombre del paciente
                echo $particular['paciente'];
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
                    # esto no se que es xd
                    echo $particular['Hallazgo'];
                    ?>
                </p>
            </div>
            <div class="signos-vitales">
                <p class="justify">
                    Signos vitales:
                    <span style="font-size: 12px !important;">
                        <?php echo $particular['signos_vitales'] ?>
                    </span>
                </p>
            </div>
            <div class="exploracion-fisica">
                <p class="justify">
                    <?php
                    # exploracion fisica
                    echo $particular['exploracion_fisica'];
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="break"></div>
    <!--   Resultados -->
    <div class="resultados" style="padding:none !important; margin:0 !important;">
        <p style="padding:none !important; margin:0 !important;">Los estudios complementarios presentan los siguientes resultados:</p>
        <!-- Table One  -->
        <table style="padding:none !important; margin:0 !important;">
            <tr>
                <td colspan="4">Valoración oftalmológica</td>
            </tr>
            <tr>
                <td class="res">
                    Agudeza visual <?php echo $particular['Estudios']['agudeza_visual']['Descripción'] ?>:
                    <br>
                    OD:<?php echo $particular['Estudios']['agudeza_visual']['OD'] ?>
                    <br>
                    OI: <?php echo $particular['Estudios']['agudeza_visual']['OI'] ?>
                </td>
                <td class="res">
                    Visión cercana Tarjeta de
                    Rosenbaum Jaeger <?php echo $particular['Estudios']['Jaeger']['Descripcion'] ?>
                    <br>
                    1: <?php echo $particular['Estudios']['Jaeger']['1'] ?>
                    <br>
                    Visión Cromática:
                    <?php
                    # resultado de vision cromatica
                    echo $particular['Estudios']['Jaeger']['vision_cromatica']
                    ?>
                </td>
                <td class="res">
                    Fondo de
                    Ojo:
                    <br>
                    <?php
                    # resultado de fondo de ojos
                    echo $particular['Estudios']['fondo_ojo']
                    ?>
                </td>
                <td class="res">
                    Segmento Anterior
                    <?php
                    # resultado de segemento anterior
                    echo $particular['Estudios']['segemento_anterior']
                    ?>
                    <br>
                    Segmento Posterior:
                    <?php
                    # resultado de segemento posterior
                    echo $particular['Estudios']['segemento_posterior']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDx:
                    <?php
                    # resultado de valoracion oftalmologica
                    echo $particular['Estudios']['valoracion_ofatlmolgica'];
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
                    echo $particular['Estudios']['audiometria'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Espirometria</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    IDX:
                    <?php
                    # resultado de espirometria
                    echo $particular['Estudios']['espirometria'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Prueba de esfuerzo</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado prueba de esfuerzo
                    echo $particular['Estudios']['prueba_esfuerzo'];
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
                    echo $particular['Estudios']['rx_tele_torax'];
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
                    echo $particular['Estudios']['rx_lumbar_anteroposterior'];
                    echo "<br>";
                    echo '- ' .  $particular['Estudios']['rx_lumbar_lateral'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Ultrasonido Abdominal</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado de ultrasonido abdominal
                    echo $particular['Estudios']['ultrasonido_abdominal']
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Ultrasonido Doppler Carotideo Bilateral</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    -
                    <?php
                    # resultado de ultrasonido doppler
                    echo $particular['Estudios']['ultrasonido_doppler_bilateral']
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Mastrografía</td>
            </tr>
            <tr>
                <td class="res left" colspan="4">
                    <?php
                    # resultado d   e mastografia
                    echo $particular['Estudios']['mastografia'];
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan="4">Citología Vaginal</td>
            </tr>
            <tr>
                <td class="res" colspan="4">
                    <?php
                    # resultado de citologia vaginal
                    echo $particular['Estudios']['citologia_vaginal']
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
                    echo $particular['Laboratorio']['biometria_hematica']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Química sanguínea</td>
                <td class="res justify">
                    <?php
                    # resultado quimica sanguinea
                    echo $particular['Laboratorio']['quimica_sanguinea']
                    ?>
                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Perfil Tiroideo</td>
                <td class="res justify">
                    <?php
                    # resultado de perfil tiroideo
                    echo $particular['Laboratorio']['perfil_tiroideo']
                    ?>

                </td>
            </tr>
            <tr>
                <td class="res" style="width: 50%;">Examen General de Orina</td>
                <td class="res justify">
                    <?php
                    # resultado de examen general de orina
                    echo $particular['Laboratorio']['examen_general_orina']
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
            paciente cuenta con los siguientes diagnósticos: <strong>
                <?php
                # diagnostico 
                echo $particular['diagnostico'];
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
                    echo $particular['recomendaciones']
                    ?>
                </td>
            </tr>
        </table>
        <div class="medico" style="margin-top: 50px;">
            <p class=" center">
                <strong>ATENTAMENTE:</strong>
            </p>
            <p class="none-p center">
                <strong>
                    <?php
                    # nombre de la doctora
                    echo $particular['medico']['nombre'];
                    ?>
                </strong>
            </p>
            <p class="none-p center">
                <?php
                # profesion
                echo $particular['medico']['profesion'];
                ?>
            </p>
            <p class="none-p center">
                Cédula profesional:
                <?php
                # cedula
                echo $particular['medico']['cedula'];
                ?>
            </p>
            <p class="none-p center">
                Certificación
                <?php
                # certificacion
                echo $particular['medico']['especialidad'];
                ?>
            </p>
        </div>
    </div>
</div>