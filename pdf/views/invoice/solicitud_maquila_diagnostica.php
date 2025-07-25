<?php require_once __DIR__.'/includes/solicitud_maquilas_config.php';  ?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Maquilas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style><?php require_once __DIR__.'/assets/diagnostica.css'; ?></style>
</head>
<body>
<!-- header -->
<header>
    <?php
        $titulo = 'Maquilas para Laboratorios Diagnóstica';
        include 'layouts/header/header_solicitud_maquila_diagnostica.php';
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
            <?php foreach ($paciente['detalle_estudios'] as $index => $estudio): ?>
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
                    <td colspan="4"><?= $estudio->NOMBRE_ESTUDIO ?></td> <!-- Nombre del estudio -->
                    <td colspan="2"><?= $estudio->ABREVIATURA_ESTUDIO ?></td> <!-- Clave del estudio -->

                    <?php if ($index === 0): ?>
                        <td colspan="3"><?= $paciente['precio_general'] ?></td> <!-- Precio general del paciente -->
                    <?php else: ?>
                        <td colspan="3"></td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            <?php $numeracion++; ?>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>

<footer>
    <?php include 'layouts/footer/footer_solicitud_maquila_diagnostica.php'; ?>
</footer>
</body>
</html>