<?php
    // $ruta = file_get_contents('../pdf/public/assets/icono_reporte_checkup.png');
    // $encode = base64_encode($ruta);

    $datosPaciente = [
        'NOMBRE' => 'Juan Pérez Martínez',
        'CURP' => 'PEMJ850612HDFRNN09',
        'FECHA_NACIMIENTO' => '12/06/1985',
        'EDAD' => '39 años',
        'DIRECCION' => 'Av. Reforma 123, Col. Centro, CDMX',
        'TELEFONO' => '55 1234 5678',
        'CORREO' => 'juan.perez@example.com',
        'SEXO' => 'Masculino',
        'ESTADO_CIVIL' => 'Casado',
        'TIPO_SANGRE' => 'O+',
        'NUMERO_IMSS' => '12345678901'
    ];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Examen Médico</title>
    <style>
        <?php include 'assets/examen_medico.css'; ?>
        .break {
            page-break-after: always;
        }

        .footer .page:after {
            content: counter(page);
        }
    </style>
</head>
<body>
    <header class="header">
        <?php include 'layouts/header/header_examen_medico.php'; ?>
    </header>
    <main>
        <h1 style="font-weight: bold; font-size: 14px">
            Examen Médico de Adminisión
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/Paciente.php'; ?>

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            1. Historia Familiar
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/Historia.php'; ?>

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            2. Hábitos de higiene, salud, nutricionales y de vivienda.
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/Habitos.php'; ?>

        <div class="break"></div> <!-- SALTO DE PÁGINA -->

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            3. Antecedentes personales
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/AntecedentesPersonales.php'; ?>

        <div class="break"></div> <!-- SALTO DE PÁGINA -->

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            4. Antecedentes Laborales
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/AntecedentesLaborales.php'; ?>

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            5. Interrogatorio por aparatos y sistemas
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/AparatosSistemas.php'; ?>

        <h1 style="font-weight: bold; font-size: 14px; margin: 20px 0">
            6. Exploración física
        </h1>
        <?php include 'layouts/tables/ExmaneMedico/ExploracionFisica.php'; ?>
        <?php include 'layouts/tables/ExmaneMedico/ExploracionFisicaExtremidades.php'; ?>
        <?php include 'layouts/tables/ExmaneMedico/ExploracionFisicaInterpretacion.php'; ?>

        <?php include 'layouts/tables/ExmaneMedico/Firma.php'; ?>
    </main>
    <footer class="footer">
        <?php include 'layouts/footer/footer_examen_medico.php'; ?>
    </footer>
</body>
</html>