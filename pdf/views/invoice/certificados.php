<html>

<head>
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

</head>


<body>
    <!-- header -->
    <div class="header">
        <?php
        $encabezado = passdata($resultados->certificado)['encabezado'];
        if ($encabezado)
            include "includes/certificados/encabezados/$encabezado.php";
        ?>
    </div>

    <!-- Footer 1 chido -->
    <div class="footer">
        <?php
        $footer = passdata($resultados->certificado)['footer'];
        if ($footer)
            include "includes/certificados/encabezados/$footer.php";
        ?>
    </div>


    <!-- body -->
    <!-- <?php ?> -->
    <div class="invoice-content">
        <?php
        // $estudiosOtros = $areas;

        // print_r($resultados);
        include $_SERVER["DOCUMENT_ROOT"] . "/nuevo_checkup/pdf/views/invoice/includes/certificados/" . $resultados->certificado . ".php";

        ?>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var el = document.querySelector(".muestraBiomolecular");
                el.value = <?php echo $body[7]->resultado; ?>
            });
        </script>
    </div>
</body>


<?php

function passdata($indice)
{
    $estudios = [
        "slb_hombre" => [
            'encabezado' => 'encabezado_slb', // Coloca el nombre del encabezado
            'footer' => false // Indica que no conlleva
        ],
        "particular_ambos" => [
            'encabezado' => 'encabezado_particular',
            'footer' => 'footer_certificados',
        ],
        // "vinco_bimo" => [
        //     'encabezado' => 'encabezado_particular',
        //     'footer' => 'footer_certificados',
        // ],
        "vinco_general" => [
            'encabezado' => 'encabezado_particular',
            'footer' => 'footer_certificados',
        ],
        "expro_ingreso" => [
            'encabezado' => 'encabezado_expro',
            'footer' => 'footer_expro',
        ],
        "poe" => [
            'encabezado' => 'encabezado_particular',
            'footer' => 'footer_certificados',
        ],
    ];

    // echo $indice;

    return $estudios[$indice];
}
// function getPDF($name)
// {
//     ob_start();
//     return ob_get_clean();
//     // return $htmlPCR;
// }



?>

</html>