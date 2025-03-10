<?php
require_once "../clases/QR_class.php";
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
//  echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($encabezado->PREFOLIO, $generator::TYPE_CODE_128)) . '">';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etiquetas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            font-size: 8px;
            width: 50mm;
            max-width: 50mm;
            height: 25mm;
            max-height: 25mm;
            margin: 1px 5px 0px;
            /* list-style: circle; */
            /* background-color: aqua; */
        }

        p {
            white-space: normal;
            word-break: break-all;
        }

        .header {
            position: fixed;
            top: -2px;
            left: 2px;
            right: 2px;
            height: 3px;
            margin-top: 0;
            /*-30px*/
            /* background-color: aqua; */
        }

        .footer {
            position: fixed;
            bottom: -2px;
            left: 2px;
            right: 2px;
            height: 3px;
            /* background-color: magenta; */
        }

        table {
            width: 100%;
            max-width: 100%;
            text-align: justify;
            margin: auto;
            white-space: normal;
            word-break: break-all;
        }

        th,
        td {
            width: 100%;
            max-width: 90px;
            table-layout: fixed;
            /* border: 1px solid; */
        }

        .label {
            text-justify: inter-word;
            /* margin: 0px 5px 0px; */
        }

        .break {
            page-break-after: always;
        }

        .barras{
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
    </div>
    <div class="footer">
        <!-- Etiquetas no tiene footer -->
    </div>
    <div class="label">
        <?php
        $count = count($resultados->CONTENEDORES);
        $i = 0;

        $recipientes = $resultados;

        // Crear prefolio con QR
        $qrObject = new QR($recipientes->PREFOLIO, 0);
    
        foreach ($recipientes->CONTENEDORES as $a => $recipiente) {
            echo "<table>";
            echo "<tr>
                        <td>
                            <p style='font-size: 7px;'><span style='font-weight:bold;'>" . $recipiente->CONTENEDOR . " (" . $recipiente->MUESTRA . ")</span> | " . $recipientes->FECHA_TOMA . "</p>
                            <p style='font-size: 7px;'>" . $recipientes->NOMBRE . "</p>
                            <p style='font-size: 7px;'>" . $recipientes->EDAD . " | " . $recipientes->SEXO . "</p>
                            <p style='padding-bottom:3px; position: absolute; '>" . $recipiente->MAQUILA_ABR . "</p>
                        </td>
                    </tr>";
            echo " </table>";

            // QRCODE
            echo "<div style='
            position:absolute; 
            top:35px; 
            left:10px; 
            z-index: -9999;
            width:20%;
            '>";
                echo "<img width='40px' height='40px' src='" . $qrObject->create() . "'>";
            echo "</div>";

            // BARCODE
            echo "<div style='
            right:-80px; 
            position:relative;
            '><img  width='100px' height='30px'  src='data:image/png;base64," . base64_encode($generator->getBarcode(substr($recipientes->PREFOLIO,-6), $generator::TYPE_CODE_128)) . "></div>";

            echo "<div style='top:20px; position:absolute; right:10px; left:100px; font-size: 40px'>
                <p>
                    <span style='font-size: 12px'>
                    {$recipientes->PREFOLIO}
                    </span>
                </p>
             </div>";

            
            $etiqueta = '';
            foreach ($recipiente->ESTUDIOS as $b => $estudio) {
                $etiqueta = $etiqueta . $estudio->ABREVIATURA . ", ";
            }
            echo "   
                    <p style='font-size: 7px; padding-right:2px; padding-top:2px'>" . $etiqueta . "</p>";

            $i++;
        }

        ?>


    </div>
</body>

</html>