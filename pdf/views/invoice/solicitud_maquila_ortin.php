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
        table {
            table-layout: fixed;
        }
        header {
            height: 50px !important;
        }
    </style>
</head>
<body>
<!-- header -->
<div class="header">
    <?php
        $titulo = 'Solicitud de estudios por base';
        include 'layouts/header/header_solicitud_maquila_ortin.php';
    ?>
</div>

<main>
    <table class="table-studies-content">
        <thead style="background: #f0e3fd; border: 1px solid black">
            <tr>
                <th colspan="2" rowspan="2" style="font-size: 8px;">APELLIDO PATERNO</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">APELLIDO MATERNO</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">NOMBRE (S)</th>
                <th colspan="2" rowspan="1" style="font-size: 8px;">FECHA NACIMIENTO</th>
                <th colspan="2" rowspan="1" style="font-size: 8px;">SEXO</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">ID CONSECUTIVO</th>
                <th colspan="2" rowspan="1" style="font-size: 8px;">FECHA SOLICITUD</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">CENTRO DE PROCESAMIENTO</th>
                <th colspan="1" rowspan="2" style="font-size: 8px;">
                    <p style="transform: rotate(-90deg); white-space: nowrap; width: 10px;">USO LAB 1</p>
                </th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">CLAVE DE CLIENTE</th>
                <th colspan="1" rowspan="2" style="font-size: 8px;">
                    <p style="transform: rotate(-90deg); white-space: nowrap;">USO LAB 2</p>
                </th>
                <th colspan="1" rowspan="2" style="font-size: 8px;">
                    <p style="transform: rotate(-90deg); white-space: nowrap;">USO LAB 3</p>
                </th>
                <th colspan="1" rowspan="2" style="font-size: 8px;">
                    <p style="transform: rotate(-90deg); white-space: nowrap;">USO LAB 4</p>
                </th>
                <th colspan="1" rowspan="2" style="font-size: 8px;">
                    <p style="transform: rotate(-90deg); white-space: nowrap;">USO LAB 5</p>
                </th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">MEDICO</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">ID PACIENTE</th>
                <th colspan="2" rowspan="1" style="font-size: 8px;">FECHA DE TOMA TE MUESTRA</th>
                <th colspan="2" rowspan="1" style="font-size: 8px;">HORA DE TOMA DE MUESTRA</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">OBERSACIONES</th>
                <th colspan="2" rowspan="2" style="font-size: 8px;">CLAVE (S) DE ESTUDIO (S)</th>
            </tr>
            <tr>
                <th colspan="2">(dd/mm/aaaa)</th>
                <th colspan="2">(M / F)</th>
                <th colspan="2">(dd/mm/aaaa)</th>
                <th colspan="2">(dd/mm/aaaa)</th>
                <th colspan="2">(hh:mm)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pacientes as $paciente): ?>
                <?php if ($paciente['envio_completo'] == 1): ?>
                    <!-- Solo mostramos la fila del grupo/servicio -->
                    <tr>
                        <td colspan="2"><?= $paciente['pac_paterno'] ?></td>
                        <td colspan="2"><?= $paciente['pac_materno'] ?></td>
                        <td colspan="2"><?= $paciente['pac_nombre'] ?></td>
                        <td colspan="2"></td>
                        <td colspan="2"><?= $paciente['sexo'] === 'FEMENINO' ? 'F': 'M' ?></td>
                        <td colspan="2"></td>
                        <td colspan="2"><?= date("Y-m-d") ?></td></td>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="2"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="1"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                        <td colspan="2"><?= $paciente['grupo_detalles']['clave'] ?? '' ?></td>
                    </tr>
                <?php else: ?>
                    <!-- Mostramos todos los estudios individuales -->
                    <?php foreach ($paciente['detalle_estudios'] as $index => $estudio): ?>
                        <tr>
                            <?php if ($index === 0): ?>
                                <!-- En la primera fila mostramos los datos del paciente -->
                                <td colspan="2"><?= $paciente['pac_paterno'] ?></td>
                                <td colspan="2"><?= $paciente['pac_materno'] ?></td>
                                <td colspan="2"><?= $paciente['pac_nombre'] ?></td>
                                <td colspan="2"></td>
                                <td colspan="2"><?= $paciente['sexo'] === 'FEMENINO' ? 'F': 'M' ?></td>
                                <td colspan="2"></td>
                                <td colspan="2"><?= date("Y-m-d") ?></td>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"><?= $estudio->ABREVIATURA_ESTUDIO ?></td>
                            <?php else: ?>
                                <!-- Dejamos vacíos los datos ya mostrados en la primera fila -->
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="2"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="1"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"></td>
                                <td colspan="2"><?= $estudio->ABREVIATURA_ESTUDIO ?></td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

</body>
