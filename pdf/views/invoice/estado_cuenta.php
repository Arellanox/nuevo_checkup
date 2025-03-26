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
        $subtitle = 'ESTADO DE CUENTA  | HOSPITAL NUESTRA SEÑORA DE GUADALUPE | DEL 27 DE FEBRERO AL 2 DE MARZO DEL 2025';
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
            <th colspan="2">Cantidad</th>
            <th colspan="2">Unitario</th>
            <th colspan="2">Subtotal</th>
            <th colspan="2">Iva</th>
            <th colspan="2">Total</th>
            <th colspan="3">Fecha de Recepción</th>
            <th colspan="2">Factura</th>
        </tr>
        </thead>
        <tbody>
            <!-- CONTENIDO -->
            <tr>
                <td colspan="3">ALBERTO SOTO TEJERO</td>
                <td colspan="3">LABORATORIO CLÍNICO</td>
                <td colspan="4">UROCULTIVO</td>
                <td colspan="2">2025227AST661</td>
                <td colspan="2">1</td>
                <td colspan="2">$387.10</td>
                <td colspan="2">$360.00</td>
                <td colspan="2">$57.60</td>
                <td colspan="2">$417.60</td>
                <td colspan="3">27/02/2025, 8:29 a.m.</td>
                <td colspan="2">HNSG</td>
            </tr>

            <!-- RESULTADOS -->
            <tr class="salto_linea">
                <td colspan="27" class="space-white"></td>
            </tr>
            <tr class="resultado">
                <td colspan="22" class="space-white"></td>
                <td colspan="2">Subtotal</td>
                <td colspan="3">$ 360.00</td>
            </tr>
            <tr class="resultado">
                <td colspan="22" class="space-white"></td>
                <td colspan="2">IVA</td>
                <td colspan="3">$ 57.60</td>
            </tr>
            <tr class="resultado">
                <td colspan="22" class="space-white"></td>
                <td colspan="2">TOTAL</td>
                <td colspan="3">$ 417.60</td>
            </tr>
        </tbody>
    </table>
</main>

<footer>
    <?php include 'layouts/footer/footer_estado_cuenta.php'; ?>
</footer>
</body>
</html>