<?php
$fecha_inicial = $_POST['fecha_inicial'];
$fecha_final = $_POST['fecha_final'];

/**
 * @throws DateMalformedStringException
 */
function formatFecha($fecha): string
{
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp'); // Forzar español en diferentes sistemas
    $date = new DateTime($fecha);
    return strtoupper(strftime('%e DE %B DEL %Y', $date->getTimestamp()));
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
    <title>Reporte de Ventas BIMO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style> <?php require_once __DIR__.'/assets/estado_cuenta.css'; ?> </style>
</head>
<body>
<!-- header -->
<header>
    <?php
    $titulo = 'DIAGNOSTICO BIOMOLECULAR SA DE CV';

    if(isset($resultados->franquicia)) {
        $franquicia = $resultados->franquicia;
        $franquicia = $franquicia[0];

        $subtitle = 'REPORTE DE VENTAS  | '.$franquicia->RAZON_SOCIAL.' | DEL '
            .formatFecha($fecha_inicial) .' AL '.formatFecha($fecha_final);
    }else {
        $subtitle = 'REPORTE DE VENTAS  | DIAGNOSTICO BIOMOLECULAR SA DE CV | DEL '
            .formatFecha($fecha_inicial) .' AL '.formatFecha($fecha_final);
    }

    include 'layouts/header/header_estado_cuenta.php';
    ?>
</header>

<main>
    <table class="tb-estado-cuenta">
        <thead>
        <tr>
            <th colspan="2">Prefolio</th>
            <th colspan="3">Paciente.</th>
            <th colspan="3">Area</th>
            <th colspan="4">Servicios</th>
            <th colspan="2">Procedencia</th>
            <th colspan="2">No. Proveedor</th>
            <th colspan="2">No. Factura</th>
            <th colspan="2">Costo</th>
            <th colspan="2">Precio Venta</th>
        </tr>
        </thead>
        <tbody>
        <!-- CONTENIDO -->

        <?php if(isset($resultados->reporte)): ?>
            <?php foreach($resultados->reporte as $item): ?>
                <!-- OBTENCIÓN DE RESULTADOS -->
                <?php
                    $subtotal += floatval($item->COSTO ?? 0);
                    $total += floatval($item->PRECIO_VENTA ?? 0);
                ?>

                <tr>
                    <td colspan="2"><?= $item->PREFOLIO ?></td>
                    <td colspan="3"><?= $item->PACIENTE ?></td>
                    <td colspan="3"><?= $item->AREA ?></td>
                    <td colspan="4"><?= $item->SERVICIO ?></td>
                    <td colspan="2"><?= $item->PROCEDENCIA ?></td>
                    <td colspan="2"><?= $item->NUM_PROVEEDOR ?></td>
                    <td colspan="2"><?= $item->NUM_FACTURA ?></td>
                    <td colspan="2"><?= formatCurrency($item->COSTO ?? 0) ?></td>
                    <td colspan="2"><?= formatCurrency($item->PRECIO_VENTA ?? 0) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- RESULTADOS -->
        <tr class="salto_linea">
            <td colspan="22" class="space-white"></td>
        </tr>
        <tr class="resultado">
            <td colspan="17" class="space-white"></td>
            <td colspan="2">Total Costos</td>
            <td colspan="3"><?= formatCurrency($subtotal ?? 0) ?></td>
        </tr>
        <tr class="resultado">
            <td colspan="17" class="space-white"></td>
            <td colspan="2">Total Precio Venta</td>
            <td colspan="3"><?= formatCurrency($total ?? 0) ?></td>
        </tr>
        </tbody>
    </table>
</main>
<footer>
    <?php include 'layouts/footer/footer_estado_cuenta.php'; ?>
</footer>
</body>
</html>