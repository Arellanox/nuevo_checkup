<?php
$pacientes = []; // Inicializamos un array para almacenar los pacientes agrupados con sus estudios
$numeracion = 1; // Contador para la columna de numeración en la tabla


foreach ($resultados as $resultado) {
    // Construimos el nombre completo del paciente
    $nombreCompleto = trim($resultado->PACIENTE_NOMBRE . " " .
        $resultado->PACIENTE_APELLIDO_PATERNO . " " . $resultado->PACIENTE_APELLIDO_MATERNO);

    // Generamos una clave única basada en el nombre completo para evitar duplicados
    $pacienteKey = md5($nombreCompleto);

    // Si el paciente aún no está en la lista, lo agregamos con su información básica
    if (!isset($pacientes[$pacienteKey])) {
        $pacientes[$pacienteKey] = [
            'nombre' => $nombreCompleto,
            'sexo' => $resultado->PACIENTE_GENERO,
            'edad' => intval($resultado->PACIENTE_EDAD),
            'estudios' => [] // Inicializamos un array para almacenar sus estudios
        ];
    }


    // Agregamos el estudio a la lista de estudios del paciente
    $pacientes[$pacienteKey]['estudios'][] = [
        'servicio' => $resultado->SERVICIO, // Nombre del estudio
        'servicio_clave' => $resultado->SERVICIO_CLAVE, // Clave del estudio
        'precio' => formatCurrency($resultado->PRECIO) ?? 'No definido' // Puedes reemplazar esto con el precio real si está disponible en los datos
    ];
}


function formatCurrency($amount): string
{
    if (!is_numeric($amount)) {
        return 'Monto invalido o no registrado';
    }

    $amount = floatval($amount);

    $formattedAmount = number_format($amount, 2, '.', '');

    $parts = explode('.', $formattedAmount);

    $parts[0] = number_format($parts[0]);

    return '$' . implode('.', $parts);
}

?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Maquilas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style> <?php require_once __DIR__.'/assets/Diagnostica.css'; ?> </style>
</head>
<body>
<!-- header -->
<header>
    <?php
    $titulo = 'Maquilas para Laboratorios Diagnóstica';
    include 'layouts/header/header-diagnostica.php';
    ?>
</header>

<main>
    <table class="table-studies-content">
        <thead>
        <tr>
            <th colspan="1">No.</th>
            <th colspan="4">Paciente (Nombre, Apellidos)</th>
            <th colspan="2">Sexo</th>
            <th colspan="1">Edad</th>
            <th colspan="1">#</th>
            <th colspan="4">Estudios</th>
            <th colspan="2">Clave</th>
            <th colspan="3">Precio</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($pacientes as $paciente): ?>
            <!-- Iteramos sobre los estudios de cada paciente -->
            <?php foreach ($paciente['estudios'] as $index => $estudio): ?>
                <tr>
                    <?php if ($index === 0): ?>
                        <!-- En la primera fila mostramos los datos del paciente -->
                        <td colspan="1"><?= $numeracion ?></td>
                        <td colspan="4"><?= $paciente['nombre'] ?></td>
                        <td colspan="1"><?= $paciente['sexo'] === 'FEMENINO' ? 'F': '' ?></td>
                        <td colspan="1"><?= $paciente['sexo'] === 'MASCULINO' ? 'M': '' ?></td>
                        <td colspan="1"><?= $paciente['edad'] ?></td> <!-- Edad -->
                    <?php else: ?>
                        <!-- Dejamos vacíos los datos ya mostrados en la primera fila -->
                        <td colspan="1"></td>
                        <td colspan="4"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                    <?php endif; ?>
                    <td colspan="1"></td> <!-- Columna vacía según el formato -->
                    <td colspan="4"><?= $estudio['servicio'] ?></td> <!-- Nombre del estudio -->
                    <td colspan="2"><?= $estudio['servicio_clave'] ?></td> <!-- Clave del estudio -->
                    <td colspan="3"><?= $estudio['precio'] ?></td> <!-- Precio del estudio -->
                </tr>
            <?php endforeach; ?>
            <?php $numeracion++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<footer>
    <?php include 'layouts/footer/footer-diagnostica.php'; ?>
</footer>
</body>
</html>