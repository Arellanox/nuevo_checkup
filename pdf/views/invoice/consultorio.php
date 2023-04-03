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
            white-space: nowrap;
            word-break: break-all;
            /* table-layout:fixed; */
        }

        th, td {
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
            text-align: right;
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
        <h2 style="padding-bottom: 6px; padding-top: 6px;">ANTECEDENTES </h2>
        
        <?php
            foreach ($resultados->ANTECEDENTES as $key => $antecedente) {
                echo "<br><h4>". str_replace("_", " ", $key) ."</h4><hr>";

                // antecdentes por tipo
                foreach ($antecedente as $espoque) { //No se que sea el espoque (si es que así se escribe), pero me dicen que es algo parecido a la iguana
        ?>
                    <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
                        <tbody>
                            <tr>
                                <td class="col-der" style="border-bottom: none; ">
                                    <strong>
                                        <?php echo $espoque->ANTECEDENTE; ?>
                                    </strong>
                                </td>
                                <td class="col-izq" style="border-bottom: none">
                                    <?php echo $espoque->RESPUESTA; ?>
                                </td>
                            </tr>
        <?php           if (isset($espoque->NOTAS)) { ?>
                            <tr>
                                <td class="col-der" style="text-align:justify;"> 
                                    <strong>Nota: </strong> <?php echo $espoque->NOTAS; ?>
                                </td>
                                <td class="col-izq"></td>
                            </tr>
        <?php           } ?>
                        </tbody>
                    </table>
        <?php   
                }
            }
        ?>

        <div class="break">        </div>
        
        <!-- ANAMNESIS -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">ANAMNESIS </h2>

        <table class='result' style='padding-top: 1px; white-space:break-spaces; border-collapse: separate; border-spacing: 0 5px;'>
            <tbody>
                <?php
                    foreach ($resultados->ANAMNESIS as $anamnesis) {
                ?>
                    <tr>
                        <td class="col-der" style="border-bottom: none; ">
                            <strong>
                                <?php echo $anamnesis->SUBTIPO; ?>
                            </strong>
                        </td>
                        <td class="col-izq" style="border-bottom: none">
                            <?php echo (isset($anamnesis->RESPUESTA)) ? $anamnesis->RESPUESTA : '' ; ?>
                        </td>
                    </tr>
                <?php   if (isset($anamnesis->NOTAS)) { ?>
                        <tr>
                            <td class="col-der" style="text-align:justify;"> 
                                <strong>Nota: </strong> <?php echo $anamnesis->NOTAS; ?>
                            </td>
                            <td class="col-izq"></td>
                        </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
        
        <!-- ODONTOGRAMA -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">ODONTOGRAMA</h2>

        
        <?php
        if (isset($resultados->ODONTOGRAMA)) {
            $dientes_chunks = array_chunk($resultados->ODONTOGRAMA, 2);
            
            echo "<table>";
            foreach ($dientes_chunks as $chunk) {
                echo "<tr>";
                foreach ($chunk as $dientes) {
                    $diagnostico = isset($dientes->DIAGNOSTICO) ? $dientes->DIAGNOSTICO : '';
                    echo "<td>";
                    echo "<strong>". $dientes->PIEZA_DENTAL . " - CARA" . $dientes->CARA . "</strong><br>";
                    echo "<strong>Diagnóstico: " . $diagnostico ."<br>";
                    if (isset($dientes->TRATAMIENTO)) {
                        echo "<strong>Diagnostico:</strong> ". $dientes->TRATAMIENTO ."<br>";
                    }
                    if (isset($dientes->COMENTARIOS)) {
                        echo "<strong>Nota:</strong> ". $dientes->COMENTARIOS ."<br>";
                    }
                    echo "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        ?>


        <!-- NUTRICION -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">NUTRICION</h2>
        <?php
            if (isset($resultados->NUTRICION)) {
            $nutriLeche = $resultados->NUTRICION;
            echo "<table class='result' style='padding-top: 1px;'><thead><tr><th class='col-one'></th><th class='col-two'></th><th class='col-three'></th><th class='col-four'></th></tr></thead><tbody><tr><td><strong>Peso perdido: </strong>". $nutriLeche->PESO_PERDIDO ." </td><td><strong> Grasa: </strong>" .$nutriLeche->GRASA . "</td><td><strong>Cintura: </strong> " .$nutriLeche->CINTURA ." </td><td><strong>Agua:</strong> ".$nutriLeche->AGUA."</td></tr><tr><td colspan='2'><strong>Musculo:</strong>".$nutriLeche->ABDOMEN." </td><td colspan='2'><strong>Abdomen:</strong> ".$nutriLeche->ABDOMEN."</td></tr></tbody></table>";
            }
        ?>
        <div class="break;"></div>
        
        
        <!-- EXPLORACION_FISICA -->
        <h2 style="padding-bottom: 6px; padding-top: 6px;">EXPLORACIÓN FISICA</h2>
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