<?php
// Obtener la fecha y hora actual
$fecha_actual = date('Y-m-d H:i:s');

// Restar 6 horas
// $fecha_impresion = date('Y-m-d H:i:s', strtotime($fecha_actual . ' -6 hours'));

# codificar logo bimo
$img64 = base64_encode(file_get_contents('https://bimo-lab.com/archivos/sistema/bimo_banner.png'));
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Formulario de confirmación de datos</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        border-bottom: 1px solid #ccc;
    }
    th {
        text-align: left;
        background-color: #f2f2f2;
    }
    .logo {
        text-align: center;
        margin-bottom: 20px;
    }
    .signature {
        margin-top: 40px;
        border-top: 1px solid #ccc;
        padding-top: 20px;
    }
    .signature label {
        font-weight: bold;
    }
    .signature input[type="text"] {
        width: 100%;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #000;
    }
    .footer {
        text-align: right;
        margin-top: 20px;
    }
</style>
</head>
<body>
<div class="container">
    <div class="logo">
        <img src="data:image/png;base64,<?php echo $img64; ?>" alt="bimo Checkups" width="200">
    </div>
    <h1 style="text-align: center;">Formulario de confirmación de datos</h1>
    <table>
        <tr>
            <th>Datos</th>
            <th>Información</th>
        </tr>
        <tr>
            <td>Nombre</td>
            <td><?php echo $resultados->NOMBRE; ?></td>
        </tr>
        <tr>
            <td>Correo 1</td>
            <td><?php echo $resultados->CORREO; ?></td>
        </tr>
        <tr>
            <td>Correo 2</td>
            <td><?php echo $resultados->CORREO_2; ?></td>
        </tr>
        <tr>
            <td>Teléfono</td>
            <td><?php echo $resultados->CELULAR; ?></td>
        </tr>
        <tr>
            <td>Fecha de nacimiento</td>
            <td><?php echo $resultados->NACIMIENTO; ?></td>
        </tr>
        <tr>
            <td>CURP</td>
            <td><?php echo $resultados->CURP; ?></td>
        </tr>
        <tr>
            <td>Pasaporte</td>
            <td><?php echo $resultados->PASAPORTE; ?></td>
        </tr>
        <tr>
            <td>RFC</td>
            <td><?php echo $resultados->RFC; ?></td>
        </tr>
        <!-- Agrega más filas según los datos proporcionados -->
    </table>
    <div class="signature">
        <p>Por favor, firme a continuación para confirmar que los datos proporcionados son correctos y actualizados:</p>
        <label for="firma">Firma:</label>
        <input type="text" id="firma" name="firma" required>
    </div>
    <div class="footer">
        <p>Fecha de impresión: <?php echo $fecha_actual; ?></p>
    </div>
</div>
</body>
</html>
