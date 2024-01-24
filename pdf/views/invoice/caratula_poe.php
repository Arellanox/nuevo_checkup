    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado Médico</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin-top: 60px;
            margin-bottom: 30px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .break {
            page-break-after: always;
        }

        .footer .page:after {
            content: counter(page);
        }
    </style>
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
    // var_dump($resultados);
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
    <!-- header -->
    <div class="header">
        <?php
        include "includes/certificados/encabezados/encabezado_particular.php";
        ?>
    </div>
    <!-- Cuerpo -->
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
                    <input style="width: 270px !important;" type="text" value="Villahermosa Tabasco a <?php echo $poe['fecha_actual'] ?>">
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
                                        <p class="none-p">
                                            <?php
                                            # apellido paterno
                                            echo $poe['paciente']['nombre']['paterno']
                                            ?>
                                        </p>
                                    </td>
                                    <td class="none-p">
                                        <p class="none-p center">
                                            <?php
                                            # apellido materno
                                            echo $poe['paciente']['nombre']['materno'];
                                            ?>
                                        </p>

                                    </td>
                                    <td class="none-p">
                                        <p class="none-p center">
                                            <?php
                                            # nombres
                                            echo $poe['paciente']['nombre']['nombres']
                                            ?>
                                        </p>
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
                                        <p class="none-p  center" style=" width:60px;">
                                            <?php
                                            # edad
                                            echo $poe['paciente']['edad'];
                                            ?>
                                        </p>
                                    </td>
                                    <td class="none-p" style="width: 30%;">
                                        <p class="none-p center">
                                            <?php if ($poe['paciente']['sexo'] === 2) : ?>
                                                <strong>(X)</strong>
                                            <?php endif; ?>
                                            <span style="margin-right: 30px;">Femenino</span>
                                            <?php if ($poe['paciente']['sexo'] === 1) : ?>
                                                <strong>(X)</strong>
                                            <?php endif; ?>
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
                                        <p class="none-p  center"></p>
                                    </td>
                                    <td>
                                        <p class="none-p center">

                                            <?php
                                            # fecha de nacimiento
                                            echo $poe['paciente']['fecha_nacimiento'];
                                            ?>
                                        </p>
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
                                <!-- Rfc del paciente -->
                                <?php foreach ($poe['paciente']['rfc'] as $key => $value) : ?>
                                    <td class="rfc"><?php echo $value ?></td>
                                <?php endforeach; ?>
                                <td class="border-b"></td>
                                <td class="border-b"></td>
                                <td class="border-b"></td>
                                <td class="border-b"></td>
                                <td class="border-b"></td>
                                <!-- Curp del paciente -->
                                <?php foreach ($poe['paciente']['curp'] as $key => $value) : ?>
                                    <td class="curp"><?php echo $value ?></td>
                                <?php endforeach; ?>
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
                                        <p class="none-p center">
                                            <?php
                                            # calle 
                                            echo $poe['domicilio']['calle']
                                            ?>
                                        </p>
                                    </td>
                                    <td class="none-p">
                                        <p class="none-p center">
                                            <?php
                                            # Numero exterior 
                                            echo $poe['domicilio']['exterior']
                                            ?>
                                        </p>

                                    </td>
                                    <td class="none-p">
                                        <p class="none-p center">
                                            <?php
                                            # colonia
                                            echo $poe['domicilio']['colonia']
                                            ?>
                                        </p>
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
                                        <?php
                                        # ciudad 
                                        echo $poe['domicilio']['ciudad']
                                        ?>
                                    </p>
                                </td>
                                <td class="center">
                                    <p class="none-p">
                                        <?php
                                        # codigo postal
                                        echo $poe['domicilio']['codigo']
                                        ?>
                                    </p>
                                </td>
                                <td class="center">
                                    <p class="none-p">
                                        <?php
                                        # estado 
                                        echo $poe['domicilio']['estado']
                                        ?>
                                    </p>
                                </td>
                                <td class="center">
                                    <p class="none-p">
                                        <?php
                                        # telefono particular 
                                        echo $poe['domicilio']['telefono']
                                        ?>
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
        </div>
    </div>
    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        include "includes/certificados/encabezados/footer_certificados.php";
        ?>
    </div>

    <style>
        .cuadro-intermedio {
            display: none !important;
        }
    </style>