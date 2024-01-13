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
        font-size: 15px;
    }

    .body-certificado .res {
        font-size: 13px !important;
    }

    .body-certificado .left {
        padding-left: 30px !important;
    }

    .body-certificado .bg {
        padding: 6px;
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
        color: white !important;
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

function formatear_fecha($fecha)
{
    $timestamp = strtotime($fecha);

    $fmt = new IntlDateFormatter('es_ES', IntlDateFormatter::LONG, IntlDateFormatter::NONE);
    $fecha_formateada = $fmt->format($timestamp);

    return $fecha_formateada;
}

function obtenerDiferenciaFechas($fechaFinal)
{
    // Obtener la fecha actual sin hora, minutos ni segundos
    $fechaActual = new DateTime();
    $fechaActual->setTime(0, 0, 0);

    // Convertir la fecha final a objeto DateTime y establecer la hora a cero
    $fechaFinalObj = new DateTime($fechaFinal);
    $fechaFinalObj->setTime(0, 0, 0);

    // Calcular la diferencia entre las fechas
    $diferencia = $fechaActual->diff($fechaFinalObj);

    // Obtener la diferencia en años, meses y días
    $anos = $diferencia->y;
    $meses = $diferencia->m;
    $dias = $diferencia->d;

    if ($anos > 0) {
        return "$anos año" . ($anos > 1 ? 's' : '');
    } elseif ($meses > 0) {
        return "$meses mes" . ($meses > 1 ? 'es' : '');
    } else {
        return "$dias día" . ($dias > 1 ? 's' : '');
    }
}

# aqui se recibe la data
$cuerpo = convertirObjetoAArray($resultados[0]->CUERPO);
$medico = convertirObjetoAArray($resultados[0]->MEDICO_INFO);
$resultado = convertirObjetoAArray($resultados[0]->DATA_BASE);
$servicios = convertirObjetoAArray($resultado['SERVICIOS']);

$fecha_original = formatear_fecha($resultados[0]->fecha_resultado);

// echo "<pre>";
// var_dump($cuerpo['ap_lateral_columna']);
// echo "</pre>";
// exit;

# arreglo para rellenar el certificado de vinco
$expro = array(
    "paciente" => array(
        "nombre" => $resultados[0]->PX,
        "fecha" => $fecha_original,
        "lugar" => "Villahermosa, Tabasco.",
        "edad" => $resultados[0]->EDAD_L,
        "nacionalidad" => $resultados[0]->NACIONALIDAD
    ),
    "examen_medico" => array(
        "tipo" => $cuerpo['tipo_examen_medico'],
        "procedencia" => "EXPRO",
        "posicion" => $resultados[0]->PROFESION,
    ),
    "clasificacion" => $cuerpo['clasificacion_grado_salud'],
    "aptitud_trabajo" => $cuerpo['aptitud'],
    "vigencia" => obtenerDiferenciaFechas($cuerpo['vigencia_certificado']),
    "fecha_vencimiento" =>  formatear_fecha($cuerpo['vigencia_certificado']),
    "medico" => array(
        "nombre" => $medico['INFO_UNIVERSIDAD'][0]->NOMBRE_COMPLETO,
        "profesion" => $medico['INFO_UNIVERSIDAD'][0]->PROFESION,
        "cedula" => $medico['INFO_UNIVERSIDAD'][0]->CEDULA,
        "firma" => "",
        "especialidades" => $medico['INFO_ESPECIALIDAD'][0]->CEDULA
    ),
    "diagnostico" => $resultado['HISTORIA']->DIAGNOSTICO,
    "recomendaciones" => $resultado['HISTORIA']->RECOMENDACIONES
);
?>
<!-- Body -->
<div class="body-certificado">
    <!-- Tablas  1 -->
    <table>
        <tr>
            <td style="border-bottom: none;">
                <strong>
                    <?php
                    # nombre del medico
                    echo $expro['medico']['nombre'];
                    ?>
                </strong> <br>
                <span class="margin:20px 0px 20px 0px;">
                    <?php echo $expro['medico']['profesion'] ?>,
                    Ced. Prof. <?php echo $expro['medico']['cedula'] ?>,
                    Certificación <?php echo $expro['medico']['especialidades'] ?>
                </span>
            </td>
        </tr>
    </table>
    <table>
        <!-- Datos Generales -->
        <tr>
            <td colspan="10" class="bg center bold italic">DATOS GENERALES</td>
        </tr>
        <tr>
            <td colspan="5">
                LUGAR:
                <strong style="font-size: 14px;">
                    <?php
                    # lugar del usuario 
                    echo $expro['paciente']['lugar']
                    ?>
                </strong>
            </td>
            <td colspan="5">
                FECHA:
                <strong style="font-size: 14px;">
                    <?php
                    # fecha del paciente 
                    echo $expro['paciente']['fecha']
                    ?>
                </strong>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                NOMBRE:
                <strong style="font-size: 13px;">
                    <?php
                    # nombre del paciente
                    echo $expro['paciente']['nombre'];
                    ?>
                </strong>
            </td>
            <td colspan="2">
                EDAD:
                <strong style="font-size: 14px;">
                    <?php
                    # edad del paciente
                    echo $expro['paciente']['edad'];
                    ?>
                </strong>
            </td>
            <td colspan="4">
                NACIONALIDAD:
                <strong style="font-size: 14px;">
                    <?php
                    # nacionalidad del paciente
                    echo $expro['paciente']['nacionalidad']
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
            <td class="bold center">
                <?php if ($expro['examen_medico']['tipo'] == "1") : ?> X <?php endif ?>
            </td>
            <td>PERIODICO</td>
            <td class="bold center">
                <?php if ($expro['examen_medico']['tipo'] == "2") : ?> X <?php endif ?>
            </td>
            <td>EGRESO</td>
            <td class="bold center">
                <?php if ($expro['examen_medico']['tipo'] == "3") : ?> X <?php endif ?>
            </td>
            <td>ESPECIAL</td>
            <td class="bold center">
                <?php if ($expro['examen_medico']['tipo'] == "4") : ?> X <?php endif ?>
            </td>
            <td>OTRO:</td>
            <td class="bold center">
                <?php if ($expro['examen_medico']['tipo'] == "5") : ?> X <?php endif ?>
            </td>
        </tr>
        <tr>
            <td colspan="10">
                QUIEN ES/ SERA CONSIDERADO PERSONAL EN ACTIVO EN LA EMPRESA:
                <strong>
                    <?php
                    # procedencia
                    echo $expro['examen_medico']['procedencia']
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
                    echo $expro['examen_medico']['posicion']
                    ?>
                </strong>
            </td>
        </tr>
        <!-- Diagnostico -->
        <tr>
            <td colspan="10" class="bg center bold italic">DIAGNÓSTICO</td>
        </tr>
        <tr>
            <td colspan="1" class="center">1</td>
            <td colspan="4" class="center">Historia Clínica</td>
            <td colspan="1" class="center">7</td>
            <td colspan="4" class="center">Química sanguínea 24 elementos</td>
        </tr>
        <tr>
            <td colspan="1" class="center">2</td>
            <td colspan="4" class="center">Valoración médica </td>
            <td colspan="1" class="center">8</td>
            <td colspan="4" class="center">Etanol en sangre, Antidoping 5 elementos</td>
        </tr>
        <tr>
            <td colspan="1" class="center">3</td>
            <td colspan="4" class="center">Exploración física (signos vitales y somatometría) </td>
            <td colspan="1" class="center">9</td>
            <td colspan="4" class="center">Examen general de orina</td>
        </tr>
        <tr>
            <td colspan="1" class="center">4</td>
            <td colspan="4" class="center">Espirometría simple </td>
            <td colspan="1" class="center">10</td>
            <td colspan="4" class="center">Rx Tele de tórax, AP y lateral columna lumbar</td>
        </tr>
        <tr>
            <td colspan="1" class="center">5</td>
            <td colspan="4" class="center">Audiometría tonal </td>
            <td colspan="1" class="center">
                <!-- 11 Mostrar el siguiente numero si tiene o no -->
            </td>
            <td colspan="4" class="center">
                <!-- Electrocardiograma cuando es ingreso -->
            </td>
        </tr>
        <tr>
            <td colspan="1" class="center">6</td>
            <td colspan="4" class="center">Biometría hemática completa, Gpo. Y Rh</td>
            <td colspan="1" class="center">
                <!-- 12 Mostrar el siguiente numero si tiene o no -->
            </td>
            <td colspan="4" class="center">
                <!-- Inbody cuando es ingreso -->
            </td>
        </tr>
        <!-- APTITUDES PARA EL TRABAJO -->
        <tr>
            <td colspan="10" class="bg center bold italic">APTITUD DE TRABAJO</td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1" <?php if ($expro['aptitud_trabajo'] == "1") : ?> class="bg-black center" <?php endif ?> data="">
                <?php if ($expro['aptitud_trabajo'] == "1") : ?> X <?php endif ?>
            </td>
            <td colspan="8">
                APTO PARA TRABAJAR
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1" <?php if ($expro['aptitud_trabajo'] == "2") : ?> class="bg-black center" <?php endif ?> data="">
                <?php if ($expro['aptitud_trabajo'] == "2") : ?> X <?php endif ?>
            </td>
            <td colspan="8">
                APTO PARA TRABAJAR CON RESTRICCIONES
            </td>
        </tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="1" <?php if ($expro['aptitud_trabajo'] == "3") : ?> class="bg-black center" <?php endif ?> data="">
                <?php if ($expro['aptitud_trabajo'] == "3") : ?> X <?php endif ?>
            </td>
            <td colspan="8">
                NO APTO PARA TRABAJAR
            </td>
        </tr>
    </table>
    </table>
    <table style="width: 60%;" class="tabla2">
        <tr>
            <td style="border-top: none;" class="p  bg center bold italic"> VIGENCIA</td>
            <td style="border-top: none;" class="p">
                <?php
                # vigencia
                echo $expro['vigencia']
                ?>
            </td>
            <td style="border-top: none;" class="p  bg center bold italic"> FECHA DE
                VENCIMIENTO </td>
            <td style="border-top: none;" class="p">
                <?php
                # fecha de vencimiento
                echo $expro['fecha_vencimiento']
                ?>
            </td>
        </tr>
    </table>
    <!-- Salto de pagina -->
    <div class="break"></div>
    <!-- Tabla 2 -->
    <!-- Header Tabla 2 -->
    <table style="margin-top: 30px;">
        <tr>
            <td class="bg-gray center bold italic p" style="color: white; width:50%;">
                ESTUDIOS PARACLINICOS
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
                GLUCOSA
            </td>
            <td class="center">
                78 mg/dL
            </td>
            <td class="bold center">
                ESPIROMETRIA
            </td>
            <td class="center">
                Normal
            </td>
        </tr>
        <tr>
            <td class="bold center">
                COLESTEROL
            </td>
            <td class="center">
                299 mg/dL
            </td>
            <td class="bold center">
                AUDIOMETRIA
            </td>
            <td class="center">
                Hipoacusia leve bilateral
            </td>
        </tr>
        <tr>
            <td class="bold center">
                TRIGLICERIDOS
            </td>
            <td class="center">
                784 mg/d
            </td>
            <td class="bold center">
                RADIOGRAFÍAS
            </td>
            <td class="center">
                Tórax de aspecto normal. Columna
                lumbosacra normal
            </td>
        </tr>
        <tr>
            <td class="bold center">
                CREATININA
            </td>
            <td class="center">
                1.15 mg/dL
            </td>
            <td class="bold center">
                ETANOL
            </td>
            <td class="center">
                Negativo
            </td>
        </tr>
        <tr>
            <td class="bold center">
                EGO
            </td>
            <td class="center">
                Proteinuria
            </td>
            <td class="bold center">
                <!-- Mostrar Electrocardiograma para ingreso -->
            </td>
            <td class="center">
                <!-- Resultado de Electrocardiograma -->
            </td>
        </tr>
        <tr>
            <td class="bold center">
                ANTIDOPING
            </td>
            <td class="center">
                Negativo
            </td>
            <td class="bold center">

            </td>
            <td class="center">

            </td>
        </tr>
    </table>
    <!-- Tabla 3 -->
    <table style="margin-top: 30px;">
        <tr>
            <td class="bg-gray center bold italic p" style="color: white; width:50%;">
                DIAGNOSTICO
            </td>
            <td style="border: none;"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="left  ">
                <?php
                # diagnostico del paciente
                echo $expro['diagnostico'];
                ?>
            </td>
        </tr>
    </table>
    <!-- Tabla 4 -->
    <table>
        <tr>
            <td class="bg-gray center bold italic p" style="color: white; width:50%;">
                RECOMENDACIONES
            </td>
            <td style="border: none;"></td>
        </tr>
    </table>
    <table>
        <tr>
            <td class="  ">
                <?php
                # recomendaciones
                echo $expro['recomendaciones'];
                ?>
            </td>
        </tr>
    </table>
    <!-- Firma medico -->
    <div class="conclusion">
        <div class="medico" style="margin-top: 30px; ">
            <p class="bold none-p center">
                DRA. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ
            </p>
            <p class="bold none-p center">
                CED. PROF. 7796595
            </p>
        </div>
    </div>
</div>