<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de interpretación de Electrocardiograma</title>
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
            width: 35%;
            max-width: 35%;
            text-align: left;
            font-size: 12px;
        }

        .col-right {
            width: 30%;
            max-width: 30%;
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


?>

<body>
    <!-- header -->
    <div class="header">
        <?php include 'includes/header.php'; ?>
    </div>

    <div class="footer">
    </div>


    <!-- body -->
    <div class="invoice-content">
        <!-- ANTECEDENTES -->
        <h4>ANTECEDENTES</h4>
        <hr>

        <?php
            foreach ($resultados->ANTECEDENTES as $antecedente) {
                echo "<strong>". $antecedente->ANTECEDENTE ."</strong>";
                echo "<p>". $antecedente->RESPUESTA ."</p>";
                if (isset($antecedente->NOTAS)) {
                    echo "<p><strong>Nota: </strong>". $antecedente->NOTAS . "</p>";
                }
            }
        ?>
        <!-- ANAMNESIS -->
        <h4>ANAMNESIS</h4>
        <hr>

        <?php
            foreach ($resultados->ANAMNESIS as $anamnesis) {
                echo "<strong>". $anamnesis->SUBTIPO ."</strong>";
                if (isset($anamnesis->RESPUESTA)) {
                    echo "<p>". $anamnesis->RESPUESTA ."</p>";
                }
                if (isset($anamnesis->NOTAS)) {
                    echo "<p><strong>Nota: </strong>". $anamnesis->NOTAS . "</p>";
                }
            }
        ?>

        <!-- ODONTOGRAMA -->
        <h4>ODONTOGRAMA</h4>
        <hr>

        <?php
            if (isset($resultados->ODONTROGRAMA)) {
                foreach ($resultados->ODONTOGRAMA as $dientes) {
                }
            }
        ?>

        <!-- NUTRICION -->
        <h4>NUTRICION</h4>
        <hr>

        <?php
            if (isset($resultados->NUTRICION)) {
            $nutriLeche = $resultados->NUTRICION;
            echo "<table class='result' style='padding-top: 1px;'><thead><tr><th class='col-one'></th><th class='col-two'></th><th class='col-three'></th><th class='col-four'></th></tr></thead><tbody><tr><td><strong>Peso perdido: </strong>". $nutriLeche->PESO_PERDIDO ." </td><td><strong> Grasa: </strong>" .$nutriLeche->GRASA . "</td><td><strong>Cintura: </strong> " .$nutriLeche->CINTURA ." </td><td><strong>Agua:</strong> ".$nutriLeche->AGUA."</td></tr><tr><td colspan='2'><strong>Musculo:</strong>".$nutriLeche->ABDOMEN." </td><td colspan='2'><strong>Abdomen:</strong> ".$nutriLeche->ABDOMEN."</td></tr></tbody></table>";
            }
        ?>
        
        <!-- EXPLORACION_FISICA -->
        <h4>EXPLORACIÓN FISICA</h4>
        <hr>

        <?php
            foreach ($resultados->EXPLORACION_FISICA as $exploracion) {
                echo "<strong>". $exploracion->PARTE_CUERPO ."</strong>";
                echo "<p>". $exploracion->EXPLORACION ."</p>";
                if (isset($exploracion->NOTAS)) {
                    echo "<p><strong>Nota: </strong>". $exploracion->NOTAS . "</p>";
                }
            }
        ?>
    </div>
</body>



</html>