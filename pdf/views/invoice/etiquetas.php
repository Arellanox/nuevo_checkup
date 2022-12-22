
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
			font-size: 7px;
			width: 50mm;
            max-width: 50mm;
            height: 25mm;
            max-height: 25mm; 
		}

        table{
            text-align:justify ;
        }

        .label{
            margin: 1px;
        }

        .break {
            page-break-after: avoid;
        }
    </style>
</head>
<body>
    <?php
    $ruta = file_get_contents('../pdf/public/assets/barcode.png');
    $encode = base64_encode($ruta);
    ?>
    <div class="label">
        <table>
        <?php
            $recipientes = $resultados->contenedores;
            foreach ($recipientes as $a => $recipiente) {
                echo "  <tr>
                            <label>"
                                . $resultados->fecha_hora_toma ."
                            </label>
                            <p>". $recipiente->contenedor ."</p>
                            <p>". $resultados->nombre . "</p>
                            <p>" . $resultados->edad . " años - " . $resultados->sexo .  "</p>";
                $etiqueta = '';
                foreach ($recipiente->estudios as $b => $estudio) {
                    $etiqueta = $etiqueta . $estudio->clave . ", "; 
                }
                echo    "<p> <img src='data:image/png;base64," .  $barcode .  " width='50px' height='20px'></p> <p>". $etiqueta ."</p>";
            }
        ?>
        </table>
    </div>
</body>
</html>