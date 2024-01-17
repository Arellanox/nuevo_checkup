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
$signos_vitales = convertirObjetoAArray($resultados[0]->SIGNOS_VITALES_POE);

$curp_array = str_split($resultados[0]->CURP);
$rfc_array = str_split($resultados[0]->RFC);
$genero = strtolower($resultados[0]->GENERO);

$examen_id = $cuerpo['realizado_examen_medico'];

switch ($examen_id) {
    case '1':
        $examen_texto = "De ingreso";
        break;
    case '2':
        $examen_texto = "Periodico";
        break;
    case '3':
        $examen_texto = "Especial";
        break;
    case '3':
        $examen_texto = $cuerpo['examen_otro'];
        break;
    default:
        # code...
        break;
}


// echo "<pre>";
// var_dump($cuerpo);
// echo "</pre>";
// exit;


// Arreglo para rellenar el PDF para el certificado de poe
$poe = array(
    "fecha_actual" => formatear_fecha($resultados[0]->current_fecha),
    "paciente" => array(
        // Nombre completoss
        "px" => $resultados[0]->PX,
        // Nombre por partes
        "nombre" => array(
            "nombres" => $resultados[0]->NOMBRES,
            "materno" => $resultados[0]->MATERNO,
            "paterno" => $resultados[0]->PATERNO,
        ),
        "curp" => $curp_array,
        "rfc" => $rfc_array,
        "puesto" => $resultados[0]->PUESTO,
        "edad" => $resultados[0]->EDAD_L,
        "fecha_nacimiento" => formatear_fecha($resultados[0]->fecha_nacimiento),
        "sexo" => $genero === "masculino" ? 1 : 2,
        "tipo_examen" => $examen_id,
        "tipo_examen_text" => $examen_texto,
        "lugar" => "Villahermosa, Tabasco, México",
        "fecha" => "09 de Octubre de 2023",
        "procedencia" => $resultados[0]->PROCEDENCIA,
        "quien_es" => $cuerpo['quien_es'],
        "apto" => $cuerpo['calificacion_apto'],
    ),
    "domicilio" => array(
        "calle" => $resultados[0]->CALLE,
        "exterior" => $resultados[0]->EXTERIOR,
        "colonia" => $resultados[0]->COLONIA,
        "ciudad" => $resultados[0]->MUNICIPIO,
        "codigo" => $resultados[0]->POSTAL,
        "estado" => $resultados[0]->ESTADO,
        "telefono" =>  $resultados[0]->CELULAR
    ),
    "informe_detallado" => $cuerpo['informacion_detallada'],
    "resultados" => array(
        "APNP" => $cuerpo['antecedentes_personales_no_patologicos'],
        "vacunas_aplicadas" => $cuerpo['vacunas_aplicadas'],
        "APP" => $cuerpo['antecedentes_personales_patologicos'],
        "infeccion_previa" => $cuerpo['infeccion_previas'],
        "alergias" => $cuerpo['alergias'],
        "accidentes_enfermedades" => $cuerpo['accidentes_enfermedades_trabajo'],
        "interveciones_quirurgica" => $cuerpo['intervenciones_quirurgicas'],
    ),
    "signos_vitales" => array(
        "talla" => $signos_vitales[1]->VALOR . ' ' . $signos_vitales[1]->MEDIDA,
        "peso" => $signos_vitales[2]->VALOR . ' ' . $signos_vitales[2]->MEDIDA,
        "tension_arterial" => $signos_vitales[6]->VALOR . '/' . $signos_vitales[7]->VALOR . ' ' . $signos_vitales[7]->MEDIDA,
        "frecuencia_respiratoria" => $signos_vitales[5]->VALOR . ' ' . $signos_vitales[5]->MEDIDA,
        "temperatura" => $signos_vitales[4]->VALOR . ' ' . $signos_vitales[4]->MEDIDA,
        "pulso" => $signos_vitales[8]->VALOR . ' ' . $signos_vitales[8]->MEDIDA,
        "exploracion_fisica" => $cuerpo['exploracion_fisica']
    ),
    "examenes_laboratorio" => array(
        "serie_roja" => $cuerpo['serie_roja'],
        "serie_blanca" => $cuerpo['serie_blanca'],
        "serie_trombocitaria" => $cuerpo['serie_trombocitaria'],
        "pruebas_bioquimicas" => $resultado['LABORATORIO']->QUIMICA_SANGUINEA_TEXT
    ),
    "normalidad_psiquica_fisica" => $cuerpo['interpretacion'],
    "conclusiones" => $cuerpo['conclusiones'],
    "encabezado" => "Espacio para el nombre del Servicio Médico o del Médico encargado de la vigilancia médica.
        Dirección completa y teléfono de contacto // Edgar David Vázquez Paz, Boulevard Adolfo Ruiz
        Cortines 1344, Piso 2 Suite 245. Col. Tabasco 2000, C.P. 86035 Villahermosa, Centro, Tabasco.
        Tel. 993 500029",
);
?>

<!-- Body -->
<div class="body-certificado">
    <div class="body">
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
                        Villahermosa Tabasco a <?php echo $poe['fecha_actual'] ?>
                    </p>
                </div>
                <div class="body-examen">
                    <div class="input-label" style="margin-bottom: 15px;">
                        <label class="bold">Nombre del candidato:</label>
                        <label>
                            <?php
                            # nombre del candidato
                            echo $poe['paciente']['px'];
                            ?>
                        </label>
                    </div>
                    <div class="input-label" style="margin-bottom: 15px;">
                        <label class="bold">Tipo de Examen Médico Ocupacional:</label>
                        <label>
                            <?php
                            # tipo de examen
                            echo $poe['paciente']['tipo_examen_text'];
                            ?>
                        </label>
                    </div>
                    <div class="input-label">
                        <label class="bold">Puesto:</label>
                        <label>
                            <?php
                            # puesto del candidato
                            echo $poe['paciente']['puesto'];
                            ?>
                        </label>
                    </div>
                    <div class="label">
                        <p>A quien corresponda,</p>
                    </div>
                    <div class="text">
                        <p class="justify" style="line-height: 20px;">
                            <?php
                            # informe detallado
                            echo $poe['informe_detallado'];
                            ?>
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
                                <?php
                                # resultado de ANPN
                                echo $poe['resultados']['APNP'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Vacunas Aplicadas:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de vacunas_aplicadas
                                echo $poe['resultados']['vacunas_aplicadas'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Antecedentes Personales Patológicos (APP):</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de APP
                                echo $poe['resultados']['APP'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Infecciones Previas:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de infeccion_previa
                                echo $poe['resultados']['infeccion_previa'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Alergias:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de alergias
                                echo $poe['resultados']['alergias'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Accidentes y Enfermedades de Trabajo:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de accidentes_enfermedades
                                echo $poe['resultados']['accidentes_enfermedades']
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 20px;">
                            <label class="bold">Intervenciones Quirúrgicas:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # resultado de interveciones_quirurgica
                                echo $poe['resultados']['interveciones_quirurgica']
                                ?>
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
                                <?php
                                # talla
                                echo $poe['signos_vitales']['talla'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Peso:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # peso
                                echo $poe['signos_vitales']['peso'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Tensión Arterial (TA):</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # tension_arterial
                                echo $poe['signos_vitales']['tension_arterial'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Frecuencia Respiratoria (FR):</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # frecuencia_respiratoria
                                echo $poe['signos_vitales']['frecuencia_respiratoria'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Temperatura: </label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # temperatura
                                echo $poe['signos_vitales']['temperatura'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Pulso: </label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # pulso
                                echo $poe['signos_vitales']['pulso'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Exploración física: </label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # exploracion_fisica
                                echo $poe['signos_vitales']['exploracion_fisica'];
                                ?>
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
                                <?php
                                # serie_roja
                                echo $poe['examenes_laboratorio']['serie_roja'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Serie Blanca:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # serie_blanca
                                echo $poe['examenes_laboratorio']['serie_blanca'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Serie Trombocitaria:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # serie_trombocitaria
                                echo $poe['examenes_laboratorio']['serie_trombocitaria'];
                                ?>
                            </label>
                        </div>
                        <div class="input-label" style="margin-bottom: 0px;">
                            <label class="bold">Pruebas Bioquímicas:</label>
                            <label class="justify" style="line-height: 20px;">
                                <?php
                                # pruebas_bioquimicas
                                echo $poe['examenes_laboratorio']['pruebas_bioquimicas'];
                                ?>
                            </label>
                        </div>
                    </div>
                    <!-- Normalidad Psiquica y fisica -->
                    <div class="normalidad">
                        <p class="bold">
                            Normalidad Psíquica y Física:
                        </p>
                        <p class="justify" style="line-height: 20px;">
                            <?php
                            # normalidad_psiquica_fisica
                            echo $poe['normalidad_psiquica_fisica'];
                            ?>
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
                <?php
                # conclusiones
                echo $poe['conclusiones'];
                ?>
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
                            <strong>Lugar:</strong>
                            <?php
                            # lugar
                            echo $poe['paciente']['lugar']
                            ?>
                        </p>
                    </td>
                    <td colspan="2">
                        <p class="none-p justify">
                            <strong>Fecha:</strong>
                            <?php
                            # fecha
                            echo $poe['fecha_actual']
                            ?>
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
                        <p class=" none-p bold center">
                            <?php
                            # paterno
                            echo $poe['paciente']['nombre']['paterno']
                            ?>
                        </p>
                    </td>
                    <td style="border: none;">
                        <p class=" none-p bold center">
                            <?php
                            # materno
                            echo $poe['paciente']['nombre']['materno']
                            ?>
                        </p>
                    </td>
                    <td style="border: none; border-right:1px solid black;">
                        <p class=" none-p bold center">
                            <?php
                            # nombres
                            echo $poe['paciente']['nombre']['nombres']
                            ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p class="none-p">
                            Se le ha realizado el examen médico:
                            <br>
                            <br>
                            De ingreso
                            <?php if ($poe['paciente']['tipo_examen'] === "1") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                            <br>
                            <br>
                            Periódico
                            <?php if ($poe['paciente']['tipo_examen'] === "2") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                            <br>
                            <br>
                            Especial
                            <?php if ($poe['paciente']['tipo_examen'] === "3") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                            <br>
                            <br>
                            Otro examen (especificar):
                            <?php if ($poe['paciente']['tipo_examen'] === "4") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <p>Quién <?php echo $poe['paciente']['quien_es'] ?> considerado personal ocupacionalmente expuesto a radiaciones ionizantes
                            en la empresa o compañía: <strong>
                                <?php
                                # procedencia
                                echo $poe['paciente']['procedencia'];
                                ?>
                            </strong>
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
                            <span style="color: green;">Apto</span>
                            <?php if ($poe['paciente']['apto'] === "1") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                            <br>
                            <br>
                            No apto
                            <?php if ($poe['paciente']['apto'] === "2") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
                            <br>
                            <br>
                            Apto en determinadas condiciones
                            <?php if ($poe['paciente']['apto'] === "3") : ?>
                                <strong>(X)</strong>
                            <?php endif; ?>
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