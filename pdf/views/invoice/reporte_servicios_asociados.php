<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pacientes BIMO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style> <?php require_once __DIR__.'/assets/estado_cuenta.css'; ?> </style>

</head>
<body>
<header>
    <?php
        $titulo = 'DIAGNOSTICO BIOMOLECULAR SA DE CV';
        $subtitle = 'Reporte de Servicios/Estudios';

        $ruta_logo = file_get_contents('../pdf/public/assets/logotipo.png');
        $logo_enconde = base64_encode($ruta_logo);

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
    <div class="header">
        <table>
            <thead>
            <tr class="titulo">
                <th>
                    <?= "<img class='float-logo' src='data:image/png;base64, " . $logo_enconde . "' height='55' >"; ?>
                    <?= $titulo ?>
                </th>
            </tr>
            <tr class="subtitle">
                <th>
                    <?= $subtitle ?>
                </th>
            </tr>
            </thead>
        </table>
    </div>
</header>
<main>
    <?php
//    echo '<pre>';
//    print_r(array_slice($resultados->reporte, 0, 5)); // solo los primeros 5 registros
//    echo '</pre>';
//
//    if (isset($resultados->reporte) && is_array($resultados->reporte)) {
//        echo "✅ Sí existe reporte con " . count($resultados->reporte) . " registros";
//    } else {
//        echo "⚠️ No se encontró la propiedad 'reporte' dentro de resultados";
//    }
    ?>

    <table class="tb-estado-cuenta">
        <thead>
        <tr>
            <th colspan="1">#</th>
            <th colspan="3">Servicios</th>
            <th colspan="4">Abreviatura</th>
            <th colspan="2">Costo</th>
            <th colspan="2">Total</th>
            <th colspan="4">Diagnostica</th>
            <th colspan="3">Orthin</th>
            <th colspan="3">Biogenica</th>
        </tr>
        </thead>
        <tbody>
        <?php if(isset($resultados->reporte)): ?>
            <?php foreach(array_slice($resultados->reporte, 0, 690) as $item): ?>
                <tr>
                    <td colspan="1"><?= $item->COUNT ?></td>
                    <td colspan="3"><?= $item->DESCRIPCION ?></td>
                    <td colspan="4"><?= $item->ABREVIATURA ?></td>
                    <td colspan="2"><?= formatCurrency($item->COSTO ?? 0) ?></td>
                    <td colspan="2"><?= formatCurrency($item->PRECIO_VENTA ?? 0) ?></td>
                    <td colspan="4"><?= formatCurrency($item->PRECIO_DIAGNOSTICA ?? 0) ?></td>
                    <td colspan="3"><?= formatCurrency($item->PRECIO_ORTHIN ?? 0) ?></td>
                    <td colspan="3"><?= formatCurrency($item->PRECIO_BIOGENICA ?? 0) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="22">
                    Sin información.
                    <?php var_dump($resultados) ?>
                </td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>
</body>
</html>