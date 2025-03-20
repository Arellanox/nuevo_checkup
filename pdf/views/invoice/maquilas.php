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
                    <?php for($i = 0; $i < 27; $i++): ?>
                        <tr>
                            <td colspan="1"><?= $i ?></td>
                            <td colspan="4">JIMENEZ RUIZ MAYRA LETICIA</td>
                            <td colspan="1">F</td>
                            <td colspan="1"></td>
                            <td colspan="1">31</td>
                            <td colspan="1"></td>
                            <td colspan="4">Vitamina D (25 Hidroxivitamina D)</td>
                            <td colspan="2">VITD</td>
                            <td colspan="3"> $ 485.00</td>
                        </tr>
                    <?php endfor; ?>
                    <tr>
                        <td colspan="18">
                            Nota: Cultivo de cicatriz de marcapasos. Correo oficial: recepcion@labdiagnostica.com ENVIAR MUESTRAS CON REFRIGERANTE. Abierto de lunes a domingo, las 24 horas. Tels. (993) 3122309 //
                            3129328 // 3144291 // 1864030. WhatsApp: (993) 2773332 (Días feriados, se prolongan algunos tiempos de entrega) Documento: RE-CC-08
                        </td>
                    </tr>
                    <tr class="table_footer_firma">
                        <td colspan="9">
                            <br>
                            <div class="firmas">
                                <p>Nombre y Firma</p>
                                <p>Envía</p>
                            </div>
                        </td>
                        <td colspan="9">
                            <br>
                            <div class="firmas">
                                <p>Nombre y Firma</p>
                                <p>Recibe</p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </main>

        <footer>
            <?php include 'layouts/footer/footer-diagnostica.php'; ?>
        </footer>
    </body>
</html>