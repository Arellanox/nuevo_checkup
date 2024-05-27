<?php
$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Pacientes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 10px;
        }
        table {
            width: 100%;
            max-width: 70%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 1px;
            text-align: center;
            vertical-align: top;
            width: 25%; /* Cada celda ocupa un cuarto del ancho de la tabla */
        }
        .cell {
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 1px;
        }
        .patient-name {
            font-size: 0.8em;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .barcode {
            margin: 5px 0;
        }
        .barcode img {
            width: 80%;
            height: auto;
        }
        .barcode-text {
            font-size: 0.6em;
            color: #555;
            margin-bottom: 5px;
        }
        .legend {
            font-size: 1em;
            color: #2c3e50;
            font-weight: bold;
            margin-top: 5px;
            letter-spacing: 0.05em;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .legend span {
            width: 45%; /* Dos columnas con espacio entre ellas */
            margin: 2px 5px;
        }
    </style>
</head>
<body>
    <table>
        <?php
        $columns = 0;
        foreach($resultados as $resultado){
            if ($columns == 4){
                $columns = 0;
                echo "</tr>";
            }
            
            if($columns == 0){
                echo "<tr>";
            }  


            $barcode = $generator->getBarcode(substr($resultado->PREFOLIO, -6), $generator::TYPE_CODE_128);
        ?>

        <!-- COLUMNAS QUE CONTIENEN LA INFORMACION -->
            <td>
                <div class="cell">
                    <div class="patient-name"><?php echo $resultado->NOMBRE_COMPLETO; ?></div>
                    <div class="barcode">
                        <!-- <img src="data:image/png;base64,<?php base64_encode($generator->getBarcode($resultado->PREFOLIO, $generator::TYPE_CODE_128));  ?>" alt="Código de Barras"> -->
                        <img src="data:image/png;base64,<?php echo base64_encode($barcode); ?> >" alt="">

                    </div>
                    <div class="barcode-text"><?php echo $resultado->PREFOLIO; ?></div>
                    <div class="legend">
                     <?php
                        $codigos = explode(',',$resultado->CODIGOS);
                        
                        foreach($codigos as $codigo){
                            echo "<span>$codigo</span>";
                        }
                     ?>
                    </div>
                </div>
            </td>
            <!-- <td></td>
            <td></td>
            <td></td> -->
        <?php
            $columns++; 
        } // fin del foreach principal
        
        // completa las columnas previniendo que haya menos de 4 pacientes
        while($columns < 4){
            echo "<td></td>";
            $columns++;
        }

        ?>
        <!-- Añade más filas según sea necesario -->
    </table>
</body>
</html>
