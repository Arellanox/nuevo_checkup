<?php

function verificarFechaImportante() {
    // Fecha actual en formato mes-día (ej. 05-10)
    $hoy = date('m-d');

    // Lista de fechas importantes asociadas con su archivo de animación
    $fechasImportantes = [
        '05-10' => 'dia-de-las-madres/index.php',
        // Puedes agregar más fechas aquí:
        // '12-25' => 'animaciones/navidad.php',
        // '01-01' => 'animaciones/ano_nuevo.php',
    ];

    // Verifica si la fecha actual es una fecha importante
    if (array_key_exists($hoy, $fechasImportantes)) {
        include $fechasImportantes[$hoy];
    }
}

verificarFechaImportante();