<style>
    @page {
        margin: 80px 10px 94px 10px;
    }

    /* No modificar el margin */

    .body-certificado {
        padding: 10px 30px 10px 30px;
        margin: 0px 50px;
    }

    .body-certificado p {
        font-size: 13px;
    }

    .body-certificado h1 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado h2 {
        padding: none !important;
        margin: none !important;
    }

    .body-certificado h3 {
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

    .body-certificado input {
        font-size: 13px;
        padding: none !important;
        margin: none !important;
        border: none !important;
        border-bottom: 1px solid black !important;
    }

    .body-certificado label {
        font-size: 13px;
    }

    .body-certificado .fotogragfia {
        height: 100px;
        width: 120px;
        border: 2px solid black !important;
    }

    .body-certificado .pulgares-container {
        /* margin-left: auto; */
        display: flex;
    }

    .body-certificado .pulgares {
        height: 100px;
        width: 150px;
        border: 2px solid black !important;
    }

    .body-certificado .border {
        border: 2px solid black !important;
        border-top: none !important;
    }

    .campos-rellenar table td,
    .fotografia_pulgares table td {
        border: none !important;
    }

    .body-certificado .linea {
        width: 100%;
        border-bottom: 1px solid black;
        height: 1px !important;
    }

    .body-certificado .rfc {
        height: 30px !important;
        border: 2px solid black !important;
        border-top: none !important;
    }

    .body-certificado .curp {
        height: 30px !important;
        border: 2px solid black !important;
        border-top: none !important;
    }

    .body-certificado .border-b {
        border-bottom: 2px solid black !important;
    }

    .body-certificado .border-t {
        border-top: 1px solid black !important;
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

// echo "<pre>";
// var_dump($cuerpo);
// echo "</pre>";
// exit;

// Arreglo para rellenar el PDF para el certificado de poe
$poe = array(
    "paciente" => array(
        // Nombre completoss
        "px" => "nombre_completo",
        // Nombre por partes
        "nombre" => array(
            "nombres" => "",
            "materno" => "",
            "paterno" => "",
        ),
        "curp" => array(),
        "puesto" => "",
        "tipo_examen" => "",
        "lugar" => "",
        "fecha" => "",
        "procedencia" => "",
        "es_sera" => "",
        "apto" => "",
    ),
    "informe_detallado" => "",
    "resultados" => array(
        "APNP" => "",
        "vacunas_aplicadas" => "",
        "APP" => "",
        "infeccion_previa" => "",
        "alergias" => "",
        "accidentes_enfermedades" => "",
        "interveciones_quirurgica" => "",
    ),
    "signos_vitales" => array(
        "talla" => "",
        "peso" => "",
        "tension_arterial" => "",
        "frecuencia_respiratoria" => "",
        "temperatura" => "",
        "pulso" => "",
        "exploracion_fisica" => ""
    ),
    "examenes_laboratorio" => array(
        "serie_roja" => "",
        "serie_blanca" => "",
        "serie_trombocitaria" => "",
        "pruebas_bioquimicas" => ""
    ),
    "normalidad_psiquica_fisica" => "",
    "conclusiones" => "",
    "encabezado" => "Espacio para el nombre del Servicio Médico o del Médico encargado de la vigilancia médica.
        Dirección completa y teléfono de contacto // Edgar David Vázquez Paz, Boulevard Adolfo Ruiz
        Cortines 1344, Piso 2 Suite 245. Col. Tabasco 2000, C.P. 86035 Villahermosa, Centro, Tabasco.
        Tel. 993 500029",
);
?>

<!-- Body -->
<div class="body-certificado">
    <div class="subtitle">
        <h3 class="center">FICHA DE REGISTRO PARA CANDIDATOS Y PERSONAL OCUPACIONALMENTE EXPUESTO</h3>
    </div>
    <div class="body">
        <!-- Datos general del trabajador -->
        <div class="datos-trabajador" style="margin-top: 30px;">
            <h3>A.1 Datos generales del trabajador</h3>
            <div class="trabajador-body" style="margin-top: 5px;">
                <!-- Lugar y fecha -->
                <label class="none-p">Lugar y fecha:</label>
                <input type="text" value="">
                <!-- Fotografia y pulgares -->
                <div class="fotografia_pulgares" style="margin-top: 10px;">
                    <table>
                        <tr>
                            <td class="none-p">
                                <div class="fotogragfia">
                                    <p class="none-p bold center">Fotografía</p>
                                </div>
                            </td>
                            <td class="none-p" style="display: flex; justify-content:end; ">
                                <div class="pulgares">
                                </div>
                            </td>
                            <td class="none-p">
                                <div class="pulgares" style="border-left: none !important;">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td class=" none-p" style="display: flex; justify-content:end; ">
                                <div class="border" style="width: 150px;">
                                    <p class="none-p bold center">Pulgar izquierdo</p>
                                </div>
                            </td>
                            <td class=" none-p">
                                <div class="border" style="width: 150px; border-left: none !important;">
                                    <p class="none-p bold center">Pulgar derecho</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="none-p" colspan="2">
                                <p class="none-p center">Huellas dactilares</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!--  datos del trabajador -->
                <div class="campos-rellenar" style="margin-top: 4px;">
                    <!-- Inputs para rellenar la informacion -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p">Juan</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p center">Juan</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p center">Juan</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Linea divisora -->
                    <div class="linea"></div>
                    <!-- Labels de los inputs -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p bold">Apellido paterno</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p bold center">Apellido materno</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p bold center" style="margin-left: 40px !important;">Nombre(s)</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- edad y sexo -->
                <div class="campos-rellenar" style="margin-top: 10px;">
                    <!-- Inputs -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td class="none-p" style="display: flex;">
                                    <p class="none-p  center" style=" width:60px;">59 años </p>
                                </td>
                                <td class="none-p" style="width: 30%;">
                                    <p class="none-p center">
                                        <span style="margin-right: 30px;">Femenino</span>
                                        <strong>(X)</strong>
                                        <span>Masculino</span>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- labels -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p" style="display: flex;">
                                    <p class="none-p bold center" style="border-top: 1px solid black; width:60px;">Edad</p>
                                </td>
                                <td class="none-p" style="width: 30%;">
                                    <p class="none-p bold center" style="border-top: 1px solid black;">Sexo</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- lugar de nacimiento y fecha de nacimiento -->
                <div class="campos-rellenar" style="margin-top: 3px;">
                    <!-- Inputs -->
                    <div class="inputs">
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p  center">Lugar de nacimiento</p>
                                </td>
                                <td>
                                    <p class="none-p center">05 / octubre /1964</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Labels -->
                    <div class="labels">
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p bold center" style="border-top: 1px solid black !important;">Lugar de nacimiento</p>
                                </td>
                                <td>
                                    <p class="none-p bold center" style="border-top: 1px solid black !important;">Fecha de nacimiento (dd/mm/aaaa)</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- RFC Y CURP -->
                <div class="campos-rellenar" style="margin-top: 7px;">
                    <!-- Inputs -->
                    <table>
                        <tr>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="rfc"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="border-b"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                            <td class="curp"></td>
                        </tr>
                    </table>
                    <!-- Labels -->
                    <table>
                        <tr>
                            <td>
                                <p class="bold center none-p">
                                    RFC
                                </p>
                            </td>
                            <td>
                                <p class="bold center none-p">
                                    CURP
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Escolaridad  maxima -->
                <div class="campos-rellenar" style="margin-top: 7px;">
                    <!-- Input -->
                    <table>
                        <tr>
                            <td style="border-bottom: 1px solid black !important;">

                            </td>
                        </tr>
                    </table>
                    <!-- Labels -->
                    <table>
                        <tr>
                            <td>
                                <p class="none-p center"> Escolaridad máxima</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Direccion particular -->
                <div class="campos-rellenar" style="margin-top: 7px;">
                    <p class="none-p"> Dirección particular:</p>
                    <!-- Inputs para rellenar la informacion -->
                    <div class="inputs" style="margin-top: 10px;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p center"></p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p center"></p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p center"></p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!-- Linea divisora -->
                    <div class="linea"></div>
                    <!-- Labels de los inputs -->
                    <div class="labels" style="display: flex; width:100%;">
                        <table>
                            <tr>
                                <td class="none-p">
                                    <p class="none-p  center">Calle</p>
                                </td>
                                <td class="none-p">
                                    <p class="none-p  center">Número</p>

                                </td>
                                <td class="none-p">
                                    <p class="none-p  center" style="margin-left: 40px !important;">Colonia</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Ciudad, Codigo postal, estado, telefono particular -->
                <div class="campos-rellenar" style="margin-top: 7px;">
                    <!-- Inputs -->
                    <table>
                        <tr>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                            <td class="center">
                                <p class="none-p">

                                </p>
                            </td>
                        </tr>
                    </table>
                    <!-- Label -->
                    <table>
                        <tr class="border-t">
                            <td>
                                <p class="center none-p">
                                    Ciudad
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Código Postal
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Estado
                                </p>
                            </td>
                            <td>
                                <p class="center none-p">
                                    Télefono particular
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- Area, Cargo, Telefono de la empresa -->
                <div class="campos-rellenar" style="margin-top: 20px;">
                    <div class="area">
                        <label class="none-p">Área de trabajo propuesta:</label>
                        <input type="text" value="">
                    </div>
                    <div class="cargo" style="margin-top: 10px;">
                        <label class="none-p">Cargo propuesto:</label>
                        <input type="text" value="">
                    </div>
                    <div class="telefono_empresa" style="margin-top: 10px;">
                        <label class="none-p">Teléfono de la empresa contratante:</label>
                        <input type="text" value="">
                    </div>
                </div>
                <!-- Nomre, firma del candidato a personal -->
                <div class="campos-rellenar" style="margin-top: 30px;">
                    <div class="candidato_firma_nombre">
                        <!-- Input -->
                        <table style="padding:0px 60px 0px 60px;">
                            <tr>
                                <td style="border-bottom: 1px solid black !important;">

                                </td>
                            </tr>
                        </table>
                        <!-- Labels -->
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p center"> Nombre y firma del candidato a personal ocupacionalmente expuesto</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="encargado_seguridad_radiologica" style="margin-top: 30px;">
                        <!-- Input -->
                        <table style="padding:0px 60px 0px 60px;">
                            <tr>
                                <td style="border-bottom: 1px solid black !important;">

                                </td>
                            </tr>
                        </table>
                        <!-- Labels -->
                        <table>
                            <tr>
                                <td>
                                    <p class="none-p center"> Nombre y firma del Encargado de Seguridad Radiológica o del Representante Lega</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Salto de pagina -->
        <div class="break"></div>
        <!-- Examen medico para el candidato a personal ocupacinalmente expuesto -->
        <div class="examen-medico">
            <div class="body">
                <div class="header-examen" style="margin-bottom: 30px;">
                    <p class="center bold">
                        EXAMEN MÉDICO PARA EL CANDIDATO A PERSONAL OCUPACIONALMENTE EXPUESTO
                    </p>
                    <p class="center" style="line-height: 30px;">
                        NORMA OFICIAL MEXICANA 026-NUCL-2011, Vigilancia Médica del Personal Ocupacionalmente Expuesto a Radiaciones Ionizantes
                    </p>
                    <p class="center bold">
                        APÉNDICE NORMATIVO B
                    </p>
                    <p style="text-align: right !important;">
                        Villahermosa, Tabasco a 09 de Octubre de 2023
                    </p>
                </div>
                <div class="body-examen">
                    <div class="input-label" style="margin-bottom: 15px;">
                        <label class="bold">Nombre del candidato:</label>
                        <label>Lázaro Francisco Santiago Delgado</label>
                    </div>
                    <div class="input-label" style="margin-bottom: 15px;">
                        <label class="bold">Tipo de Examen Médico Ocupacional:</label>
                        <label>de Ingreso</label>
                    </div>
                    <div class="input-label">
                        <label class="bold">Puesto:</label>
                        <label>Técnico en disparos</label>
                    </div>
                    <div class="label">
                        <p>A quien corresponda,</p>
                    </div>
                    <div class="text">
                        <p class="justify" style="line-height: 20px;">
                            Me complace comunicarme con ustedes en relación con el candidato <strong>Lázaro Francisco Delgado</strong>
                            Santiago, quien ha sido sometido recientemente a un examen médico ocupacional, como parte
                            del proceso de selección de su empresa. Como médico a cargo de la evaluación, deseo
                            proporcionarles un informe detallado sobre los resultados de dicha evaluación, de acuerdo con
                            los requisitos médicos y en cumplimiento a lo establecido al apéndice normativo B de la NOM-
                            026-NUCL-2011, Vigilancia Médica del Personal Ocupacionalmente Expuesto a Radiaciones
                            Ionizantes y/o la normatividad aplicable de salud en el trabajo
                        </p>
                    </div>
                    <!-- Resultados del examen de medico ocupacional -->
                    <div class="label">
                        <p class="bold">
                            Resultados del Examen Médico Ocupacional:
                        </p>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Antecedentes Personales no Patológicos (APNP):</label>
                            <label class="justify" style="line-height: 20px;">
                                Historia de tabaquismo desde hace 30 años.
                                Consumo 7 cigarrillos diariamente. Consumo ocasional de alcohol. Realiza ejercicio aeróbico
                                durante alrededor 40 minutos 6 días a la semana (caminata)
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Vacunas Aplicadas:</label>
                            <label class="justify" style="line-height: 20px;">
                                El candidato presenta un historial de vacunación completo de acuerdo con
                                las recomendaciones de salud pública.
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Antecedentes Personales Patológicos (APP):</label>
                            <label class="justify" style="line-height: 20px;">
                                Niega alergias a medicamentos, alimentos o
                                condiciones medioambientales. Historia de fractura nasal hace 35 años, no refiere secuelas.
                                Convive don diabetes mellitus tipo II con diagnóstico desde hace 26 años, actualmente bajo
                                tratamiento con medidas higiénico-dietéticas y farmacológico con Metformina y Glibenclamida.
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Infecciones Previas:</label>
                            <label class="justify" style="line-height: 20px;">
                                El candidato no refiere haber tenido episodios previos de infecciones en el
                                año en curso.
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Alergias:</label>
                            <label class="justify" style="line-height: 20px;">
                                El trabajador no reporta alergias a medicamentos, alimentos y/o condiciones
                                medioambientales.
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Accidentes y Enfermedades de Trabajo:</label>
                            <label class="justify" style="line-height: 20px;">
                                El candidato no refiere antecedentes de accidentes o
                                enfermedades profesional.
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Intervenciones Quirúrgicas:</label>
                            <label class="justify" style="line-height: 20px;">
                                El candidato no refiere haberse sometido a intervenciones
                                quirúrgicas
                            </label>
                        </div>
                    </div>
                    <!-- Signos vitales y Exploracion por aparato y sistemas -->
                    <div class="label" style="margin-bottom: 20px;">
                        <p class="bold none-p">
                            Signos Vitales y Exploración por Aparatos y Sistemas:
                        </p>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Talla:</label>
                            <label class="justify" style="line-height: 20px;">
                                168cm
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Peso:</label>
                            <label class="justify" style="line-height: 20px;">
                                55.4kg
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Tensión Arterial (TA):</label>
                            <label class="justify" style="line-height: 20px;">
                                12/80 mmHg
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Frecuencia Respiratoria (FR):</label>
                            <label class="justify" style="line-height: 20px;">
                                16 respiraciones por minuto
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Temperatura: </label>
                            <label class="justify" style="line-height: 20px;">
                                36.5 °C
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Pulso: </label>
                            <label class="justify" style="line-height: 20px;">
                                81 latidos por minuto
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Exploración física: </label>
                            <label class="justify" style="line-height: 20px;">
                                En la exploración física por aparatos y sistemas, no hay hallazgos de
                                significancia médico-ocupacional.
                            </label>
                        </div>
                    </div>
                    <!-- Examenes de laboratorio -->
                    <div class="label" style="margin-bottom:10px;">
                        <p class="bold none-p">
                            Exámenes de Laboratorio:
                        </p>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Serie Roja:</label>
                            <label class="justify" style="line-height: 20px;">
                                Sin hallazgos de significancia médico-ocupacional
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Serie Blanca:</label>
                            <label class="justify" style="line-height: 20px;">
                                Sin hallazgos de significancia médico-ocupacional
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Serie Trombocitaria:</label>
                            <label class="justify" style="line-height: 20px;">
                                Sin hallazgos de significancia médico-ocupacional
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Pruebas Bioquímicas:</label>
                            <label class="justify" style="line-height: 20px;">
                                Glucosa 218mg/dl, Urea 30.5mg/dl, Bun 14.25mg/dl, Creatinina sérica 0.50 mg/dl, Colesterol
                                total 136mg/dl, Triglicéridos 79mg/dl
                            </label>
                        </div>
                    </div>
                    <!-- Normalidad Psiquica y fisica -->
                    <div class="normalidad">
                        <p class="bold">
                            Normalidad Psíquica y Física:
                        </p>
                        <p class="justify" style="line-height: 20px;">
                            El candidato <strong>Lázaro Francisco Santiago Delgado</strong> ha demostrado normalidad psíquica y física.
                            Presenta agudeza en los sentidos y facilidad de expresión, lo que le permite comunicarse de
                            manera efectiva. Su capacidad física es adecuada para las funciones requeridas en el puesto, con
                            destreza de movimientos necesaria para llevar a cabo sus tareas de manera eficiente.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Salto de pagina -->
        <div class="break"></div>
        <div class="conclusiones">
            <p class="bold">
                Conclusiones:
            </p>
            <p class="justify" style="line-height: 20px;">
                Basado en los resultados de la evaluación médica y el historial médico del candidato Lázaro
                Francisco Santiago Delgado, considero que se encuentra apto y en condiciones de salud
                adecuadas para ocupar el puesto de Técnico en Disparos en su VINCO. No existen
                contraindicaciones médicas significativas que limiten su capacidad para desempeñar las
                funciones requeridas.
                <br>
                <br>

                Quedo a su disposición para cualquier consulta adicional y para proporcionar información
                adicional si así se requiere. Agradezco la oportunidad de colaborar en este proceso de selección
                y contribuir a la salud ocupacional de su empresa.
                <br>
                <br>
                <br>
                Atentamente,
            </p>
            <style>
                .medico-firma table td {
                    border: none !important;
                }
            </style>
            <div class="medico-firma" style="margin-top: 50px;">
                <!-- Input -->
                <table style="padding:0px 60px 0px 60px;">
                    <tr>
                        <td style="border-bottom: 1px solid black !important;">
                            <p class="bold center">
                                Edgar David Vázquez Paz, Cédula Profesional 8233685
                                Médico Especialista en Salud Ocupacional
                            </p>
                        </td>
                    </tr>
                </table>
                <!-- Labels -->
                <table>
                    <tr>
                        <td>
                            <p class="none-p center"> Nombre, firma y cédula profesional del médico</p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- Salto de pagina -->
        <div class="break"></div>
        <div class="certificado-medico">
            <p class="bold center">
                CERTIFICADO MÉDICO
            </p>
            <table>
                <tr>
                    <td colspan="4">
                        <p class="justify none-p">
                            Espacio para el nombre del Servicio Médico o del Médico encargado de la vigilancia médica.
                            Dirección completa y teléfono de contacto // Edgar David Vázquez Paz, Boulevard Adolfo Ruiz
                            Cortines 1344, Piso 2 Suite 245. Col. Tabasco 2000, C.P. 86035 Villahermosa, Centro, Tabasco.
                            Tel. 993 500029
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="none-p justify">
                            <strong>Lugar:</strong> Villahermosa, Tabasco, México
                        </p>
                    </td>
                    <td colspan="2">
                        <p class="none-p justify">
                            <strong>Fecha:</strong> 09 de Octubre de 2023
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="border: none; border-left:1px solid black;">
                        <p class="none-p"></p>
                    </td>
                    <td style="border: none;">
                        <p class="none-p center">Apellido paterno</p>
                    </td>
                    <td style="border: none;">
                        <p class="none-p center">Apellido materno</p>
                    </td>
                    <td style="border: none; border-right:1px solid black;">
                        <p class="none-p center">Nombre</p>
                    </td>
                </tr>
                <tr>
                    <td style="border: none; border-left:1px solid black;">
                        <p class="none-p">Nombre:</p>
                    </td>
                    <td style="border: none;">
                        <p class=" none-p bold center">Santiago</p>
                    </td>
                    <td style="border: none;">
                        <p class=" none-p bold center">Delgado</p>
                    </td>
                    <td style="border: none; border-right:1px solid black;">
                        <p class=" none-p bold center">Lázaro Francisco</p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="none-p">
                            Se le ha realizado el examen médico:
                            <br>
                            <br>
                            De ingreso <strong>(X)</strong>
                            <br>
                            <br>
                            Periódico
                            <br>
                            <br>
                            Especial
                            <br>
                            <br>
                            Otro examen (especificar):
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p>Quién es / será considerado personal ocupacionalmente expuesto a radiaciones ionizantes
                            en la empresa o compañía: <strong>VINCO</strong>
                        </p>
                        <p class="none-p center">
                            (Nombre o denominación social del titular de la licencia, autorización o permiso)
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="none-p justify">
                            Con base en la información clínica obtenida y al historial laboral disponible, se califica al
                            interesado como clínicamente:
                            <br>
                            <br>
                            <span style="color: green;">Apto</span> <strong>(X)</strong>
                            <br>
                            <br>
                            No apto
                            <br>
                            <br>
                            Apto en determinadas condiciones
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="none-p justify">
                            En los casos de "Apto en determinadas condiciones", indicar las condiciones específicas de
                            conformidad con lo establecido en el numeral 5 de la NOM-026-NUCL-2011, Vigilancia médica
                            del personal ocupacionalmente expuesto a radiaciones ionizantes:
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="none-p center bold">
                            Edgar David Vázquez Paz // 8233685 DGP
                        </p>
                    </td>
                    <td colspan="2">
                        <p class="none-p center"></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <p class="none-p center">
                            Nombre del médico y cédula profesional
                        </p>
                    </td>
                    <td colspan="2">
                        <p class="none-p center">Firma del médico</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>