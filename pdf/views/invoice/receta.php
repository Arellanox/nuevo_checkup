<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        @page {
            /* margin: 165px 10px; */
            /* size: 21.59cm 18cm; */
            margin: 1cm;

        }

        /* Saltar a nueva pagina */
        .break {
            page-break-after: always;
        }

        /* Content */
        .invoice-content {
            position: relative;
            top: 160px;
            border-radius: 4px;
            padding-bottom: 5px;
            padding-right: 30px;
            padding-left: 30px;
            text-align: justify;
            text-justify: inter-word;

            /* background-color: red; */
     
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

        /* p {
            font-size: 12px;
            line-height: 1;
        } */

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
            width: 42%;
            max-width: 42%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-center {
            width: 28%;
            max-width: 41%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 26%;
            max-width: 17%;
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
            width: 100%;
            max-width: 1000%;
            text-align: left;
            /* background-color: red; */
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

        .table {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
            font-size: 12px;
        }

        .table>tr,
        .table>tr>td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;

        }

        .table>tr {
            background-color: #f2f2f2;
        }

        .pregunta-row,
        .tratamiento-titulo {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 1.5px;
            text-align: left;
            font-size: 12px;
            z-index: -1;
        }

        .respuesta-row,
        .comentario-row {
            background-color: #fff;
            padding: 0.5em;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 13px;
            z-index: -1;
        }

        .respuesta2-row {
            background-color: #fff;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 11px;
            z-index: -1;
        }

        /* cuerpo del tratamiento */
        .tratamiento {
            background-color: #fff;
            font-size: 14px;
        }

        .tratamiento-cuerpo {

            padding: 0.2em;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 12px;
            /* z-index: -1; */

        }

        /* para la marca de agua */
        .contenido-sobre-marca {
            position: relative;
            z-index: 1;
            /* Encima de la marca de agua */
        }

        .signos-vitales {
            font-size: 10px;
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px; /* Espacio entre los elementos */
        }

        .signos1 {
          font-size: 12px;
        }

        .bold{
            font-size: 12px;
            font-weight: bold;
        }
        body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    font-size: 12px;
}

/* Cada contenedor ocupa la mitad de la página */
.half-page {
        position: relative;
        height: 45%; /* Ajustado para que cada sección ocupe la mitad de la página */
        margin-bottom: 1%;
        padding: 10px;
        border: 1px solid #000;
    }

/* Línea punteada que divide la receta de la copia */
.linea-punteada {
        border-top: 1px dashed black;
        margin: 5px 0;
    }

/* Contenido del medicamento */
.medicamento {
    margin-bottom: 3px;
}

/* Estilo de la marca de agua para la copia */
.marca-agua {
        position: absolute;
        font-size: 72px;
        color: rgba(200, 200, 200, 0.4); /* Color gris claro con transparencia */
        transform: rotate(-30deg);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg); /* Centra y rota la marca de agua */
        z-index: -1; /* Coloca la marca detrás del contenido */
    }


/* Salto de página para imprimir */
.page-break {
    page-break-after: always;
}

.page-number {
        position: center;
        bottom: 0;
        text-align: center;
    }
    .content {
        margin-bottom: 5px; /* Reduce el espacio inferior entre contenido y footer */
        margin-left: 5px;
    }
    .footer {
        position: absolute;
        bottom: 0;
        width: 100%;
        text-align: center;
        font-size: 9px;
        padding: 10px;
        right: 0px;
    }
    .footer strong {
        font-size: 9px;
    }


    </style>

</head>

<?php
// print_r($pie);
// exit;
/*$dataDoc = $pie['datos_medicos'][0];
$footerDoctor = $dataDoc['NOMBRE_COMPLETO'] . '<br>' . $dataDoc['UNIVERSIDAD'] . '- Cédula profesional: ' . $dataDoc['CEDULA'];*/



/*switch ($dataDoc['ID_USUARIO']) {
    case 84:
        $nombre_doctor = "Dr. Ibis De la Cruz Hernández";
        $especialidades = "Infectologia y Medicina Interna";
        $cedulas = "UJAT Ced. Prof. 6118720. Med. Interna 09995591. UNAM Infectología 10532710";
        $footerDoctor = "Dr. Ibis De la Cruz Hernández <br> UNAM Infectología - Cédula Profesional: 10532710";
        break;
    default:
        $nombre_doctor = $dataDoc['NOMBRE_COMPLETO'];
        $especialidades = $dataDoc['CARRERA'];
        $cedulas = $dataDoc['UNIVERSIDAD'] . ' Ced. Prof. ' . $dataDoc['CEDULA'];
        break;
}*/

if (isset($resultados[2][0]->BY_MEDICO_ID)) {
    if ($resultados[2][0]->BY_MEDICO_ID == 53) { // Beatriz
        $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
        $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';
    } else if ($resultados[2][0]->BY_MEDICO_ID == 119) { // Cesar
        $ruta_firma = file_get_contents("../pdf/public/assets/firma_cesar.png");
        $footerDoctor = 'Dr. César Mauricio Calderón Alipi <br>UANL - Cédula profesional: 6406214';
    } else { // CUALQUIER OTRO MEDICO
        $dataDoc = $pie['datos_medicos'][0];
        $nombre_doctor = $dataDoc['NOMBRE_COMPLETO'];
        $especialidades = $dataDoc['CARRERA'];
        $cedulas = $dataDoc['UNIVERSIDAD'] . ' Ced. Pro. ' . $dataDoc['CEDULA'];
        $footerDoctor = $dataDoc['NOMBRE_COMPLETO'] . '<br>' . $dataDoc['UNIVERSIDAD'] . '- Cédula profesional: ' . $dataDoc['CEDULA'];
    }

    $encode_firma = base64_encode($ruta_firma);
} else {
    // cual otro medico que esta en la sesion actual
     echo "otro medico";
    $dataDoc = $pie['datos_medicos'][0];
    $nombre_doctor = $dataDoc['NOMBRE_COMPLETO'];
    $especialidades = $dataDoc['CARRERA'];
    $cedulas = $dataDoc['UNIVERSIDAD'] . ' Ced. Pro. ' . $dataDoc['CEDULA'];
    $footerDoctor = $dataDoc['NOMBRE_COMPLETO'] . '<br>' . $dataDoc['UNIVERSIDAD'] . '- Cédula profesional: ' . $dataDoc['CEDULA'];
}

//Signos vitales
$data = json_decode($resultados[2][0]->SIGNOS, true);
foreach ($data as $signos){

    $signos_edad = $signos['EDAD'];
    $signos_sexo = $signos['SEXO'];
    $signos_alergias = $signos['ALERGIAS'];
    $signos_talla = $signos['TALLA'];
    $signos_peso = $signos['PESO'];
    $signos_imc = $signos['IMC'];
    $signos_temperatura = $signos['TEMPERATURA'];
    $signos_presionArterial = $signos['PRESION_ARTERIAL'];
}




// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
// $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
// $encode_firma = base64_encode($ruta_firma);

$folio = ((array)($resultados[1][0]))['FOLIO'];

?>

<body>
    <?php
    $medicamentosPorPagina = 3;
    $totalMedicamentos = count($resultados[1]);
    $numPaginas = ceil($totalMedicamentos / $medicamentosPorPagina);
    $medicamentoActual = 0;

    for ($pagina = 0; $pagina < $numPaginas; $pagina++) : ?>
        
        <!-- Contenedor de la Receta Original (mitad superior) -->
        <div class="half-page" id="receta-original">
            <div class="header">
                <?php 
                // $nombre_doctor = "Dr. Ibis De la Cruz Hernández";
                // $especialidades = "Infectologia y Medicina Interna";
                // $cedulas = "UJAT Ced. Prof. 6118720. Med. Interna 09995591. UNAM Infectología 10532710";
                $tituloPersonales = 'Receta de Medicamentos';
                $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
                include 'includes/header_receta.php'; ?>
            </div>
            <div class="content">
                
                <div class="signos1">
                    <div class="signos-vitales">
                        <span>Alergias: <strong><?php echo $signos_alergias; ?></strong></span>
                        <span>Talla: <strong><?php echo $signos_talla; ?> cm</strong></span>
                        <span>Peso: <strong><?php echo $signos_peso; ?> Kg</strong></span>
                        <span>IMC: <strong><?php echo $signos_imc; ?></strong></span>
                        <span>Temperatura: <strong><?php echo $signos_temperatura; ?> °C</strong></span>
                        <span>TA: <strong><?php echo $signos_presionArterial; ?></strong></span>
                    </div>
                </div>
                <p><strong>Diagnóstico:</strong> <?php echo $resultados[2][0]->DIAGNOSTICO; ?></p>
                
                <?php for ($i = 0; $i < $medicamentosPorPagina && $medicamentoActual < $totalMedicamentos; $i++, $medicamentoActual++) :
                    $medicamento = $resultados[1][$medicamentoActual];
                ?>
                    <div class="medicamento">
                        <span class="bold"><?php echo $medicamento->NOMBRE_GENERICO . ' (' . $medicamento->NOMBRE_COMERCIAL . '), ' . $medicamento->FORMA_FARMACEUTICA . ' ' . $medicamento->DOSIS . '. ' . $medicamento->PRESENTACION; ?></span><br>
                        <span><?php echo $medicamento->FRECUENCIA . '. ' . $medicamento->VIA_DE_ADMINISTRACION . '<br>' . $medicamento->DURACION_DEL_TRATAMIENTO . '. ' . $medicamento->INDICACIONES_PARA_EL_USO . '.'; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="footer">
                <table style="margin-top:0px;">
                    <tbody>
                        <tr class="col-foot-two">
                            <td colspan="10"></td>
                            <td colspan="2" style="text-align: left;">
                                <?php if (isset($encode_firma)) echo "<img style='position:absolute; right:25px; margin-top: -65px ' src='data:image/png;base64, " . $encode_firma . "' height='70px'> " ?>
                            </td>
                        </tr>
                        <tr class="col-foot-three" style="font-size: 13px;">
                            <td colspan="6" style="text-align: center; width: 50%; height: 50px;" id="qr"></td>
                            <td colspan="6" style="text-align: right; width: 50%;">
                                <strong style="font-size: 12px;"><?php if (isset($footerDoctor)) echo $footerDoctor; ?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <small>
                        <strong style="font-size: 9px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong><br>
                        <strong style="font-size: 9px;">Teléfonos: 993 634 0250, 993 634 6245</strong><br>
                        <strong style="font-size: 9px;">Correo electrónico:</strong>
                        <strong style="font-size: 9px;color: rgb(0, 78, 89);">resultados@bimo-lab.com</strong>
                    </small>
                    <br>
                    <span class="page-number" style="font-size: 9px;">Página: <span class="page"><?php echo $pagina + 1; ?></span></span>
                </span>
            </div>
        </div>

        <!-- Línea punteada para separar la receta de la copia -->
        <div class="linea-punteada"></div>

        <!-- Contenedor de la Copia (mitad inferior) -->
        <div class="half-page" id="copia">
            <div class="marca-agua">COPIA</div>
            <div class="header">
                <?php 
                // $nombre_doctor = "Dr. Ibis De la Cruz Hernández";
                // $especialidades = "Infectologia y Medicina Interna";
                // $cedulas = "UJAT Ced. Prof. 6118720. Med. Interna 09995591. UNAM Infectología 10532710";
                $tituloPersonales = 'Receta de Medicamentos';
                $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
                include 'includes/header_receta.php'; ?>
            </div>
            <div class="content">
                <div class="signos1">
                        <div class="signos-vitales">
                            <span>Alergias: <strong><?php echo $signos_alergias; ?></strong></span>
                            <span>Talla: <strong><?php echo $signos_talla; ?> cm</strong></span>
                            <span>Peso: <strong><?php echo $signos_peso; ?> Kg</strong></span>
                            <span>IMC: <strong><?php echo $signos_imc; ?></strong></span>
                            <span>Temperatura: <strong><?php echo $signos_temperatura; ?> °C</strong></span>
                            <span>TA: <strong><?php echo $signos_presionArterial; ?></strong></span>
                        </div>
                </div>
                <p><strong>Diagnóstico:</strong> <?php echo $resultados[2][0]->DIAGNOSTICO;?></p>
                
                <?php 
                $inicioCopia = $medicamentoActual - $medicamentosPorPagina;
                if ($medicamentoActual % 6 !=  0) {
                    $inicioCopia+=$pagina;
                } 
                for ($j = $inicioCopia; $j < $medicamentoActual; $j++) :
                    $medicamentoCopia = $resultados[1][$j];
                ?>
                    <div class="medicamento">
                        <span class="bold"><?php echo $medicamentoCopia->NOMBRE_GENERICO . ' (' . $medicamentoCopia->NOMBRE_COMERCIAL . '), ' . $medicamentoCopia->FORMA_FARMACEUTICA . ' ' . $medicamentoCopia->DOSIS . '. ' . $medicamentoCopia->PRESENTACION; ?></span><br>
                        <span><?php echo $medicamentoCopia->FRECUENCIA . '. ' . $medicamentoCopia->VIA_DE_ADMINISTRACION . '<br>' . $medicamentoCopia->DURACION_DEL_TRATAMIENTO . '. ' . $medicamentoCopia->INDICACIONES_PARA_EL_USO . '.'; ?></span>
                    </div>
                <?php endfor; ?>
            </div>
            <div class="footer">
                <table style="margin-top:0px;">
                    <tbody>
                        <tr class="col-foot-two">
                            <td colspan="10"></td>
                            <td colspan="2" style="text-align: left;">
                                <?php if (isset($encode_firma)) echo "<img style='position:absolute; right:25px; margin-top: -15px; min-width: 50px' src='data:image/png;base64, " . $encode_firma . "' height='50px'> " ?>
                            </td>
                        </tr>
                        <tr class="col-foot-three" style="font-size: 13px;">
                            <td colspan="6" style="text-align: center; width: 50%; height: 50px;" id="qr"></td>
                            <td colspan="6" style="text-align: right; width: 50%;">
                                <strong style="font-size: 12px;"><?php if (isset($footerDoctor)) echo $footerDoctor; ?></strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span style="display: flex; flex-direction: column; align-items: center; text-align: center;">
                    <small>
                        <strong style="font-size: 9px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas, Villahermosa Tabasco, C.P. 86079</strong><br>
                        <strong style="font-size: 9px;">Teléfonos: 993 634 0250, 993 634 6245</strong><br>
                        <strong style="font-size: 9px;">Correo electrónico:</strong>
                        <strong style="font-size: 9px;color: rgb(0, 78, 89);">resultados@bimo-lab.com</strong>
                    </small>
                    <br>
                    <span class="page-number" style="font-size: 9px;">Página: <span class="page"><?php echo $pagina + 1; ?></span></span>
                </span>
            </div>
        </div>

        <?php if ($pagina < $numPaginas - 1) : ?>
            <div class="page-break"></div>
        <?php endif; ?>

    <?php endfor; ?>
</body>
</html>