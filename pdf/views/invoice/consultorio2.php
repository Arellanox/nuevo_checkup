<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Consulta Médica</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet">  -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        @page {
            margin: 165px 10px;
        }
        .tratamiento-cuerpo {

            padding: 0.2em;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 13px;
            z-index: -1;

        }


        body {
            font-family: 'Roboto', sans-serif;
            margin-top: 70px;
            margin-bottom: 40px;
            font-size: 10px;
            /* background-color: gray; */
        }

        .header {
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            height: 220px;
            margin-top: 0;
        }

        .footer {
            position: fixed;
            bottom: -165px;
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
            width: 41%;
            max-width: 41%;
            text-align: left;
            font-size: 11px;
            margin-left: 2px;
        }

        .col-right {
            width: 17%;
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

        /*tabla de espiro */
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

        .pregunta-row {
            background-color: #f2f2f2;
            font-weight: bold;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        .respuesta-row,
        .comentario-row {
            background-color: #fff;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 13px;
        }

        .respuesta2-row {
            background-color: #fff;
            padding: 5px;
            border-bottom: 1px solid #ddd;
            border-top: 1px solid #ddd;
            font-size: 11px;
        }
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
// $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
/*if (isset($pie['datos_medicos'][0]['FIRMA'])) {
    $ruta_firma = file_get_contents($pie['datos_medicos'][0]['FIRMA']);
}
if (isset($ruta_firma))
    $encode_firma = base64_encode($ruta_firma);*/


?>

<body>
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Checkup Clínica y Prevención';
        $tituloPersonales = 'Informacón del paciente';
        $subtitulo = 'Historia Clínica';
        $encabezado->FECHA_RESULTADO = $encabezado->FECHA_RESULTADO_CONSULTA;
        include 'includes/header.php';
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        // $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';
        /*$nombre_doctor = $pie['datos_medicos']['0']['NOMBRE_COMPLETO'];
        $uni = $pie['datos_medicos']['0']['UNIVERSIDAD'];
        $cedula = $pie['datos_medicos']['0']['CEDULA'];

        $footerDoctor = "$nombre_doctor <br>$uni - Cédula profesional: $cedula";*/


        // if (isset($resultados[0][0]->MEDICO_ID)) {
        //     if ($resultados[0][0]->MEDICO_ID == 53) { // Beatriz
        //         $ruta_firma = file_get_contents('../pdf/public/assets/firma_beatriz.png');
        //         $footerDoctor = 'Dra. BEATRIZ ALEJANDRA RAMOS GONZÁLEZ <br>UJAT - Cédula profesional: 7796595';
        //     } else { // Cesar
        //         $ruta_firma = file_get_contents("../pdf/public/assets/firma_cesar.png");
        //         $footerDoctor = 'Dr. César Mauricio Calderón Alipi <br>UANL - Cédula profesional: 6406214';
        //     }

        //     $encode_firma = base64_encode($ruta_firma);
        // }

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
                $ruta_firma = $dataDoc['FIRMA'];
            }

            $encode_firma = base64_encode($ruta_firma);
        } else {
            // cual otro medico que esta en la sesion actual
            $dataDoc = $pie['datos_medicos'][0];
            $nombre_doctor = $dataDoc['NOMBRE_COMPLETO'];
            $especialidades = $dataDoc['CARRERA'];
            $cedulas = $dataDoc['UNIVERSIDAD'] . ' Ced. Pro. ' . $dataDoc['CEDULA'];
            $footerDoctor = $dataDoc['NOMBRE_COMPLETO'] . '<br>' . $dataDoc['UNIVERSIDAD'] . '- Cédula profesional: ' . $dataDoc['CEDULA'];
            $ruta_firma = $dataDoc['FIRMA'];
        }

        include 'includes/footer.php';
        ?>
    </div>


    <br>
    <!-- body -->
    <div class="invoice-content">

        <?php


        // if ($pie['folio'] === "DBMHC0001") {

        //     echo ('<pre>');
        //     var_dump($pie['datos_medicos']);
        //     echo ('</pre>');
        //     echo $footerDoctor;
        // }
        ?>
        <!-- Nota consulta -->
        <section id="card-nota-consulta">
            <table class="table">
                <thead>
                    <tr>
                        <td class="pregunta-row">Motivo de consulta</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="respuesta-row"><?php echo $resultados[0][0]->MOTIVO_CONSULTA; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Nota consulta -->
        <section id="card-nota-consulta">
            <table class="table">
                <thead>
                    <tr>
                        <td class="pregunta-row">Nota consulta</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="respuesta-row"><?php echo $resultados[0][0]->NOTAS_CONSULTA; ?></td>
                    </tr>
                </tbody>
            </table>
        </section>


        <!-- Exploracion fisica -->
        <section id="card-exploracion-clinica">
            <div id="notas-historial-consultorio">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="pregunta-row">Exploracion física</th>
                            <th class="pregunta-row"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($resultados[1]); $i++) : ?>
                            <tr>
                                <td class="respuesta-row"><?php echo $resultados[1][$i]->TIPO_EXPLORACION; ?></td>
                                <td class="comentario-row"><?php echo $resultados[1][$i]->EXPLORACION; ?></td>
                            </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Diagnosticos -->
        <section id="card-diagnostico">
            <div id="notas-historial-consultorio">
                <table class="table">
                    <thead>
                        <td class="pregunta-row">Diagnóstico</td>
                    </thead>
                    <tbody>
                        <?php $diagnosticoPrincipal = $resultados[0][0]->DIAGNOSTICO; ?>
                        <tr>
                            <td class="respuesta-row"><?php echo $diagnosticoPrincipal; ?></td>
                        </tr>
                        <?php
                        for ($i = 0; $i < count($resultados[0]); $i++) : ?>
                            <?php if ($resultados[0][$i]->DIAGNOSTICO != $diagnosticoPrincipal) : ?>
                                <?php $diagnosticoPrincipal = $resultados[0][$i]->DIAGNOSTICO; ?>
                                <tr>
                                    <td class="respuesta2-row"><?php echo $resultados[0][$i]->DIAGNOSTICO2; ?></td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td class="respuesta2-row"><?php echo $resultados[0][$i]->DIAGNOSTICO2; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="break"></div>
        <!-- Plan de tratamiento -->
        <section id="card-receta">
            <div>
                <div class="pregunta-row">Tratamiento:</div>
                <?php
                $medicamentos = $resultados[4];
                if(count($medicamentos)>0){
                // exit;
                    for ($i = 0; $i < count($medicamentos); $i++) {
                        $recetas = $medicamentos[$i];

                        // if ($resultados[0][$i] != $recetas->ID_RECETA) {
                            echo '
                            <div class="tratamiento-cuerpo">
                                <p>' . $recetas->NOMBRE_GENERICO . ', ' . $recetas->FORMA_FARMACEUTICA . ', ' . $recetas->DOSIS . ', ' . $recetas->PRESENTACION . '</p>
                                <p>' . $recetas->FRECUENCIA . ', ' . $recetas->VIA_DE_ADMINISTRACION . ' ' . $recetas->DURACION_DEL_TRATAMIENTO . ', ' . $recetas->INDICACIONES_PARA_EL_USO . '</p>
                            </div>';
                        // }
                    }
                }else{
                    echo '<p class="margin: 10px 15px; font-size: 14px">Ninguna </br></br></p>';
                }
                
                ?>
            </div>
        </section>

        <!-- Conclusiones -->
        <section id="card-plan-tratamiento">
            <table class="table">
                <thead>
                    <tr>
                        <th class="pregunta-row">Conclusiones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="respuesta-row"> <?php echo $resultados[0][0]->PLAN_TRATAMIENTO; ?> </td>
                    </tr>
                </tbody>
            </table>
        </section>


    </div>

</body>

</html>