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

    <style>
        .header {
            position: fixed;
            top: -165px;
            left: 25px;
            right: 25px;
            height: 100px;
            margin-top: 0;
            box-sizing: content-box;
        }
        .header-container-bio {
            box-sizing: content-box;
            width: 100%;
            height: 100px;
            margin-top: 0;
        }
        .data-maquila-bio {
            max-width: 50px;
            border: 1px solid #3e3e3e;
            padding: 0 !important;
            margin: 0 !important;
        }
        .data-maquila-bio .data-result {
            background-color: #bfe4f3;
            margin: 0 1px;
            padding: 6px 0;
            text-align: center;
        }
        .data-maquila-bio .clave-maquila-bio .label,
        .data-maquila-bio .fecha-maquila-bio .label {
            text-align: center;
            margin: 0;
            padding: 5px 0 !important;
        }
        .data-maquila-bio .clave-maquila-bio .data-result,
        .data-maquila-bio .fecha-maquila-bio .data-result{
            font-weight: bold;
        }
    </style>
</head>
<body>
<!-- header -->
<div class="header">
    <?php
        $titulo = 'Maquilas para Laboratorios Diagnóstica';
        include 'layouts/header/header_solicitud_maquila_biogenica.php';
    ?>
</div>

<main>
    <table class="table-studies-content">
        <thead>
            <tr>
                <th colspan="1" style="border: 1px solid black">No.</th>
                <th colspan="4" style="border: 1px solid black">Paciente (Nombre, Apellidos)</th>
                <th colspan="2" style="border: 1px solid black">Sexo</th>
                <th colspan="2" style="border: 1px solid black">Clave</th>
                <th colspan="4" style="border: 1px solid black">Estudios</th>
                <th colspan="3" style="border: 1px solid black">Precio</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pacientes as $paciente): ?>
            <!-- Iteramos sobre los estudios de cada paciente -->


            <?php if ($paciente['envio_completo'] == 1): ?>
                <!-- Si está completo, solo mostramos la fila del grupo/servicio -->
                <tr>
                    <td colspan="1"><?= $numeracion ?></td>
                    <td colspan="4"><?= $paciente['nombre'] ?></td>
                    <td colspan="2"><?= $paciente['sexo'] === 'FEMENINO' ? 'F': 'M' ?></td>
                    <td colspan="2"><?= $paciente['grupo_detalles']['clave'] ?? '' ?></td>
                    <td colspan="4"><?= $paciente['grupo_detalles']['nombre'] ?? '' ?></td>
                    <td colspan="3"><?= $paciente['grupo_detalles']['precio'] ?></td>
                </tr>
            <?php else: ?>
                <!-- Si es parcial, mostramos todos los estudios -->
                <?php foreach ($paciente['detalle_estudios'] as $index => $estudio): ?>
                    <tr>
                        <?php if ($index === 0): ?>
                            <td colspan="1"><?= $numeracion ?></td>
                            <td colspan="4"><?= $paciente['nombre'] ?></td>
                            <td colspan="2"><?= $paciente['sexo'] === 'FEMENINO' ? 'F': 'M' ?></td>
                        <?php else: ?>
                            <td colspan="1"></td>
                            <td colspan="4"></td>
                            <td colspan="2"></td>
                        <?php endif; ?>

                        <td colspan="2"><?= $estudio->LAB_ESTUDIO_CLAVE ?></td> <!-- Clave del estudio -->
                        <td colspan="4"><?= $estudio->LAB_ESTUDIO_NOMBRE ?></td> <!-- Nombre del estudio -->
                        <td colspan="3"><?= $estudio->LAB_ALIAS_PRECIO ?></td>

                        <!--                        --><?php //if ($index === 0): ?>
                        <!--                            <td colspan="3">--><?php //= formatCurrency($paciente['total_maquila'] ?? 0) ?><!--</td>-->
                        <!--                        --><?php //else: ?>
                        <!--                            <td colspan="3">--><?php //= $estudio->PRECIO ?><!--</td>-->
                        <!--                        --><?php //endif; ?>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php $numeracion++; ?>
        <?php endforeach; ?>
            <tr>
                <td colspan="16" style="text-align: left; vertical-align: top; white-space: nowrap; padding: 5px; font-size: 11px; height: 50px">
                    <strong>Observaciones:</strong>
                </td>
            </tr>
            <tr>
                <td colspan="13" style="padding: 5px; font-size: 11px; line-height: 1.3; word-break: break-word; white-space: normal;">
                    Nota: Se deberá indicar la clave de estudios solicitados con base al catálogo de estudios.
                    <br>
                    En caso de estudios de orina de 24 h indicar el volumen de recolección.<br>
                    Las muestras deberán ser enviadas con refrigerante suficiente.<br>
                    Contacto: Recepción/9931216463/Área de maquilas/9931473798.
                </td>
                <td colspan="3" >
                    <strong>Total a pagar:</strong><br>
                    <span><?= formatCurrency($accountTotalAmount) ?></span>
                </td>
            </tr>

        </tbody>
    </table>
</main>