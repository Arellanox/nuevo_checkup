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
            margin: 1.5cm;

        }

        body {
            font-family: 'Roboto', sans-serif;
            margin-top: -2px;
            margin-bottom: 1px;
            font-size: 10px;
            z-index: -1;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: 0;
            left: 25px;
            right: 25px;
            height: 160px;
            margin-top: 0;
            /* background-color: purple; */
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 25px;
            right: 25px;
            height: 200px;
            /* background-color: pink; */
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
            position: relative;
            top: 200px;
            border-radius: 4px;
            padding-bottom: 5px;
            padding-right: 30px;
            padding-left: 30px;
            text-align: justify;
            text-justify: inter-word;
     
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

        .table {
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: normal;
            word-break: break-all;
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
            padding: 10px;
            text-align: left;
            font-size: 14px;
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
            font-size: 13px;
        }

        .tratamiento-cuerpo {

            padding: 0.1em;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 13px;
            z-index: -1;

        }

        /* para la marca de agua */
        .marca-agua {
            position: fixed;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.2;
            font-size: 100px;
            color: #cccccc;
            z-index: 999;
            /* Detrás del contenido */
           
        }

        .contenido-sobre-marca {
            position: relative;
            z-index: 1;
            /* Encima de la marca de agua */
        }

        /* .signos-vitales {
            font-size: 12px;
        }
        .signos {
            position: fixed;
            top: 180px; 
            left: 25;
            right: 25;
            height: 160px;
            margin-top: 0;


        } */

        .signos-vitales {
            font-size: 12px;
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-between;
            align-items: center;
            gap: 10px; /* Espacio entre los elementos */
        }

        .signos {
            position: fixed;
            top: 190px; /* Ajusta según sea necesario */
            left: 25px; /* Añadir 'px' para las unidades */
            right: 25px; /* Añadir 'px' para las unidades */
            margin-top: 0;
        }

       
    </style>

</head>

<?php
// print_r($pie);
$dataDoc = $pie['datos_medicos'][0];
$footerDoctor = $dataDoc['NOMBRE_COMPLETO'] . '<br>' . $dataDoc['UNIVERSIDAD'] . '- Cédula profesional: ' . $dataDoc['CEDULA'];


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
    <!-- header -->
    <div class="header">

        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Información del paciente';
        $subtitulo = 'Receta de Medicamentos';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
        include 'includes/header_receta.php';
        ?>

    </div>


    <!-- Footer 1 chido -->
    <div class="footer">
        <?php

        #$footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';
        // $footerDoctor = $data['NOMBRE_COMPLETO'] . '<br>' . $data['UNIVERSIDAD'] . '- Cédula profesional: ' . $data['CEDULA'];

        include 'includes/footer_receta.php';
        ?>
    </div>
    <!-- Signos vitales -->
    <br>
    <!-- <div class="signos" style=" margin-bottom:100px;">
        <table class="signos-vitales">
            <tr>
                <td>Alergias: <strong><?php echo $signos_alergias; ?> </strong></td>
                <td>Talla: <strong><?php echo $signos_talla; ?> cm</strong></td>
                <td>Peso: <strong><?php echo $signos_peso; ?> Kg</strong></td>
                <td>IMC: <strong><?php echo $signos_imc; ?> </strong></td>
                <td>Temperatura: <strong><?php echo $signos_temperatura; ?> °C</strong></td>
                <td>TA: <strong><?php echo $signos_presionArterial; ?> </strong></td>
            </tr>
        </table>
    </div> -->
    <div class="signos" style="margin-bottom: 100px;">
        <div class="signos-vitales">
            <span>Alergias: <strong><?php echo $signos_alergias; ?></strong></span>
            <span>Talla: <strong><?php echo $signos_talla; ?> cm</strong></span>
            <span>Peso: <strong><?php echo $signos_peso; ?> Kg</strong></span>
            <span>IMC: <strong><?php echo $signos_imc; ?></strong></span>
            <span>Temperatura: <strong><?php echo $signos_temperatura; ?> °C</strong></span>
            <span>TA: <strong><?php echo $signos_presionArterial; ?></strong></span>
        </div>
    </div>


    <br>

    <!-- Body -->
    <?php

    $recetaPrincipal = '
            <div class="invoice-content row">
                <div>
                  <table class="table">
                    <thead>
                    <tr>
                          <td class="pregunta-row">Diagnóstico: <span class="respuesta-row">'.$resultados[2][0]->DIAGNOSTICO.'</span></td>
                    </tr>
                     </thead>
                     <!--<tbody>
                     <tr>
                          <td class="respuesta-row">' . $resultados[2][0]->DIAGNOSTICO . '</td>
                     </tr>
            </tbody>-->
        </table>
    </div>

    <div>
        <h4 class="tratamiento-titulo">Tratamiento:</h4>';

    for ($i = 0; $i < count($resultados[1]); $i++) {
        $recetas = $resultados[1][$i];

        if ($resultados[0][$i] != $recetas->ID_RECETA) {
            $recetaPrincipal .= '
            <div class="tratamiento-cuerpo">
                <p>' . $recetas->NOMBRE_GENERICO . ', ' . $recetas->FORMA_FARMACEUTICA . ', ' . $recetas->DOSIS . ', ' . $recetas->PRESENTACION . '</p>
                <p>' . $recetas->FRECUENCIA . ', ' . $recetas->VIA_DE_ADMINISTRACION . ' ' . $recetas->DURACION_DEL_TRATAMIENTO . ', ' . $recetas->INDICACIONES_PARA_EL_USO . '</p>
            </div>';
        }
    }
    $recetaPrincipal .= '
    </div>
    </div>';

    echo $recetaPrincipal;
    ?>

    <!-- copia -->
    <div class="break"></div>
    <br>
    <?php
    $recetaCopia = '


<div class="contenido-sobre-marca">
<div class="marca-agua">COPIA</div>
    <div class="invoice-content row">
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <td class="pregunta-row">Diagnóstico:<span class="respuesta-row">'. $resultados[2][0]->DIAGNOSTICO .'</span></td>
                    </tr>
                </thead>
                <!-- <tbody>
                    <tr>
                        <td class="respuesta-row">' . $resultados[2][0]->DIAGNOSTICO . '</td>
                    </tr>
                </tbody> -->
            </table>
        </div>

        <div>
            <h4 class="tratamiento-titulo">Tratamiento:</h4>
            <table class="table">
                <tbody>';

    foreach ($resultados[1] as $recetas) {
        if ($resultados[0][$i] != $recetas->ID_RECETA) {
            $recetaCopia .= '
                    <tr class="tratamiento-cuerpo">
                        <td>
                            <p>' . $recetas->NOMBRE_GENERICO . ', ' . $recetas->FORMA_FARMACEUTICA . ', ' . $recetas->DOSIS . '</p>
                            <p>' . $recetas->FRECUENCIA . ', ' . $recetas->VIA_DE_ADMINISTRACION . ' ' . $recetas->DURACION_DEL_TRATAMIENTO . ', ' . $recetas->INDICACIONES_PARA_EL_USO . '</p>
                        </td>
                    </tr>';
        }
    }

    $recetaCopia .= '
                </tbody>
            </table>
        </div>
    </div>
</div>';

    echo $recetaCopia;


    ?>

</body>

</html>