
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
        *{
            margin: 0;
            padding: 0;
        }

        body{
            font-family: 'Roboto', sans-serif;
			font-size: 6px;
			width: 50mm;
            max-width: 50mm;
            height: 25mm;
            max-height: 25mm; 
            margin: 1px 5px 0px;
            /* list-style: circle; */
            /* background-color: aqua; */
		}

        .header { 
            position: fixed; 
            top: -2px;
            left: 2px; 
            right: 2px; 
            height: 3px; 
            margin-top: 0; /*-30px*/
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

        table{
            text-align:justify ;
        }
        
        .label{
            text-justify: inter-word;
            /* margin: 0px 5px 0px; */
        }

        .break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
    </div>
    <div class="footer">
    </div>
    <div class="label">
        <table>
        <?php
            $count = count($resultados->CONTENEDORES);
            $i = 0;

            $recipientes = $resultados;
            foreach ($recipientes->CONTENEDORES as $a => $recipiente) {
                echo "  <tr >
                            <td>
                                <label>"
                                    .   $recipientes->FECHA_TOMA ."
                                </label>
                                <p>".   $recipiente->CONTENEDOR . " (" . $recipiente->MUESTRA ." ) </p>
                                <p>".   $recipientes->NOMBRE . "</p>
                                <p>".   $recipientes->EDAD . " años - " . $recipientes->SEXO .  "</p>";
                    $etiqueta = '';
                    foreach ($recipiente->ESTUDIOS as $b => $estudio) {
                        $etiqueta = $etiqueta . $estudio->ABREVIATURA . ", "; 
                    }
                    echo    "   <p> <img src='data:image/png;base64," .  $barcode .  " width='50px' height='20px'></p> 
                                <p style='font-size: 7px; padding-right:2px;'>". $etiqueta ."</p>
                            </td>
                        </tr>";
                $i++;
            }
        ?>
        </table>
    </div>
</body>
</html>