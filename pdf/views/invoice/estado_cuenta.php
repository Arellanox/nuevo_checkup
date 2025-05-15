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
    <title>Reporte de Pacientes BIMO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <style> <?php require_once __DIR__.'/assets/Estado_Cuentas.css'; ?> </style>
</head>
<body>
<!-- header -->
<header>
    <?php
        $titulo = 'DIAGNOSTICO BIOMOLECULAR SA DE CV';

        if(isset($resultados->franquicia)) {
            $franquicia = $resultados->franquicia;
            $franquicia = $franquicia[0];

            $subtitle = 'ESTADO DE CUENTA  | '.$franquicia->RAZON_SOCIAL.' | DEL '
                .formatFecha($fecha_inicial) .' AL '.formatFecha($fecha_final);
        }else {
            $subtitle = 'ESTADO DE CUENTA  | HOSPITAL NUESTRA SEÑORA DE GUADALUPE | DEL '
                .formatFecha($fecha_inicial) .' AL '.formatFecha($fecha_final);
        }

        include 'layouts/header/header_estado_cuenta.php';
    ?>
</header>

<main>
    <table class="tb-estado-cuenta">
        <thead>
        <tr>
            <th colspan="3">Paciente.</th>
            <th colspan="3">Area</th>
            <th colspan="4">Servicios</th>
            <th colspan="2">Prefolio</th>
            <th colspan="2"">Cantidad</th>
            <th colspan="3"">Unitario</th>
            <th colspan="3">Subtotal</th>
            <th colspan="3">Iva</th>
            <th colspan="3">Total</th>
            <th colspan="3">Fecha de Recepción</th>
            <th colspan="2">Factura</th>
        </tr>
        </thead>
        <tbody>
            <!-- CONTENIDO -->
            <?php if(isset($resultados->reporte)): ?>
                <?php foreach($resultados->reporte as $item): ?>
                    <!-- OBTENCIÓN DE RESULTADOS -->
                    <?php
                        $subtotal += floatval($item->SUBTOTAL);
                        $iva += floatval($item->IVA);
                        $total += floatval($item->TOTAL);
                    ?>

                    <tr>
                        <td colspan="3"><?= $item->PACIENTE ?></td>
                        <td colspan="3"><?= $item->AREA ?></td>
                        <td colspan="4"><?= $item->SERVICIOS ?></td>
                        <td colspan="2"><?= $item->PREFOLIO ?></td>
                        <td colspan="2"><?= $item->CANTIDAD ?></td>
                        <td colspan="3"><?= formatCurrency($item->PRECIO_UNITARIO) ?></td>
                        <td colspan="3"><?= formatCurrency($item->SUBTOTAL) ?></td>
                        <td colspan="3"><?= formatCurrency($item->IVA) ?></td>
                        <td colspan="3"><?= formatCurrency($item->TOTAL) ?></td>
                        <td colspan="3"><?= $item->FECHA_RECEPCION ?></td>
                        <td colspan="2"><?= $item->FACTURA ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- RESULTADOS -->
            <tr class="salto_linea">
                <td colspan="31" class="space-white"></td>
            </tr>
            <tr class="resultado">
                <td colspan="26" class="space-white"></td>
                <td colspan="2">Subtotal</td>
                <td colspan="3"><?= formatCurrency($subtotal ?? 0) ?></td>
            </tr>
            <tr class="resultado">
                <td colspan="26" class="space-white"></td>
                <td colspan="2">IVA</td>
                <td colspan="3"><?= formatCurrency($iva ?? 0) ?></td>
            </tr>
            <tr class="resultado">
                <td colspan="26" class="space-white"></td>
                <td colspan="2">TOTAL</td>
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