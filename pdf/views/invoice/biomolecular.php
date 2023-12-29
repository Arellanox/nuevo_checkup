<html>

</html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Laboratorio Biomolecular</title>
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
            margin-bottom: 30px;
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
            bottom: -186px;
            left: 25px;
            right: 25px;
            height: 220px;
            /* background-color: pink; */
        }

        #qr a {
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
        }

        h5 {
            font-size: 12.5px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        p {
            font-size: 12px;
        }

        strong {
            font-size: 12px;
        }

        .align-center {
            text-align: center;
        }

        table {
            width: 100%;
            max-width: 100%;
            margin: auto;
            white-space: nowrap;
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
            width: 35%;
            max-width: 35%;
            text-align: left;
            font-size: 12px;
        }

        .col-center {
            width: 5%;
            max-width: 5%;
            text-align: left;
            font-size: 12px;
        }

        .col-right {
            width: 60%;
            max-width: 60%;
            text-align: left;
            font-size: 12px;
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
            text-align: left;
        }

        .col-der {
            width: 70%;
            max-width: 70%;
            text-align: center;
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
    </style>
</head>

<?php

// para el path del logo 
$ruta = file_get_contents('../pdf/public/assets/icono_reporte.png');
$encode = base64_encode($ruta);

// Para la firma se requiere mandar la "firma" tambien en base 64 e incrustarlo como en el ejemplo de arriba,
//los datos de abajo son meramente informativos y solo sirven para rellenar la informacion del documento
// echo '<img src="data:image/png;base64, '. $img_valido .'" alt="" height="75" >';

// path firma
$ruta_firma = file_get_contents('http://bimo-lab.com/pdf/logo/firma.png');
$encode_firma = base64_encode($ruta_firma);

//Reportes hechos
// var_dump($resultados);
// exit();
$areas = $resultados->areas[0];

// var_dump($resultados->areas);
// $areas = array_filter(json_decode($resultados->areas, true), function ($element) {
//     return $element['area'] == 'NINGUNA';
// });

// //Reportes automaticos
// // $areas_biomolecular = $resultados->areas[0];
// $areas_biomolecular = array_filter(json_decode($resultados->areas, true), function ($element) {
//     return $element['area'] == 'BIOLOGÍA MOLECULAR';
// });

// $areas = '';
// $areas_biomolecular = '';
// foreach ($resultado->areas as $key => $value) {
//     if ($value['area'] == 'BIOLOGÍA MOLECULAR') {
//         $areas_biomolecular = $resultado->areas[$key];
//     } else {
//         $areas = $resultado->areas[$key];
//     }
// }

?>

<body>
    <!-- header -->
    <div class="header">
        <?php
        $titulo = 'Laboratorio de Biología Molecular';
        $tituloPersonales = 'Biología Molecular';
        include 'includes/header_lab.php'; ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        $footerDoctor = 'Q.F.B. NERY FABIOLA ORNELAS RESENDIZ <br>UPCH - Cédula profesional: 09291445';
        include "includes/footer.php"; ?>
    </div>


    <!-- body -->
    <!-- <?php ?> -->
    <div class="invoice-content">
        <?php


        function eliminarKey($data, $key)
        {
            foreach ($data as $index => $value) {
                unset($data[$index]->estudios[$key]);
            }
            return $data;
        }

        function passdata($indice)
        {
            $estudios = [
                "PCR SARS-CoV-2" => 'pcr',
                "PCR SARS-CoV-2/INFLUENZA A Y B" => 'pcr',
                "PANEL RESPIRATORIO POR PCR" => 'PANEL21',
                "Ag. SARS-CoV-2" => 'antigeno',
                "VPH" => 'vph',
                "CITOLOGÍA" => 'CITOLOGIA',
                "rT-PCR-ETS" => 'PCR-ETS',
                "FTD Fiebre Tropical Multiplex" => 'FTDMultiplex',
                "PANEL RESPIRATORIO 22" => 'PANEL22',
                "PCR PARA MYCOBACTERIUM TUBERCULOSIS MDR Y XDR" => 'mycobacte_tuberculosis',
                "Prueba rT-PCR TICK BORNE DISEASES" => 'rt-PCR_TICK',
                "rT-PCR Panel Meningitis" => 'rT-PCR_PaMeningitis',
                "PCR HELICOBACTER PYLORI CON RESISTENCIA A CLARITROMICINA" => 'rT-PCR_pylari_claritromicina',
                "rT-PCR Entero-DR" => 'rt-PCR_Entero',
                'Ag. Virus Sincitial Respiratorio' => 'Ag-Virus_Respiratorio',
                'Prueba rT-PCR de VSR - CoviFlu' => 'pcr-vsr_coviflu'
            ];
            return $estudios[$indice] ?? null;
        }

        function procesarEstudio($json, $documentoRaiz)
        {

            $body_html = passdata($json->estudio);
            if ($body_html) {
                $body = $json->analitos; // Para obtener los resultados de cada uno
                include $documentoRaiz . "/nuevo_checkup/pdf/views/invoice/includes/biomolecular/" . $body_html . ".php";
            }
            return $body_html;
        }

        function realizarSaltoDePagina()
        {
            echo '<div class="break"></div>';
        }

        $documentoRaiz = $_SERVER["DOCUMENT_ROOT"];
        $estudiosOtros = $areas; // Asumiendo que $areas está definido en alguna parte
        $conteo = count($estudiosOtros->estudios);

        foreach ($estudiosOtros->estudios as $key => $json) {
            $body_html = procesarEstudio($json, $documentoRaiz);
            if ($body_html) {
                $resultados->areas = eliminarKey($resultados->areas, $key);

                if (($conteo - 1) > $key) {
                    realizarSaltoDePagina();
                }
            }
        }

        if (count($estudiosOtros->estudios)) {
            realizarSaltoDePagina();
            include $documentoRaiz . "/nuevo_checkup/pdf/views/invoice/includes/laboratorios_global.php";
        }



        // include $_SERVER["DOCUMENT_ROOT"] . "/nuevo_checkup/pdf/views/invoice/includes/formato_clinico.php";

        ?>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var el = document.querySelector(".muestraBiomolecular");
                el.value = <?php echo $body[7]->resultado; ?>
            });
        </script>
    </div>
</body>


</html>