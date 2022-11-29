<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Etiquetas</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans&display=swap" rel="stylesheet"> 

    <style>
        *{
            margin: 0;
            padding: 0;
        }
        body{
            font-family: 'Noto Sans', sans-serif;
			font-size: 6px;
			width: 50mm;
            max-width: 50mm;
            height: 25mm;
            max-height: 25mm; 
		}

        table{
            text-align:justify ;
        }

        .etiqueta{
            margin: 1px;
        }

        .break {
            page-break-after: avoid;
        }
    </style>
</head>
<body>
    <div class="etiqueta">
        <table>
        <?php
            foreach ($data->estudios as $key => $estudio) {
                echo "  <tr>
                            <label>"
                                .date('Y-m-d')."
                            </label>
                            <p>". $estudio->recipiente ."</p>
                            <p>". $data->nombre ."</p>
                            <p>". $estudio->clave ."</p>
                            <p>Aqui va el codigo de barras</p>
                        </tr>";
                        // <img src='data:image/svg+xml;base64,".base64_encode($barcode)."' />
            }
        ?>
        </table>
    </div>
</body>
</html>