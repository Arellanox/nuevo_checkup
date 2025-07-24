<?php
$pacientes = []; // Inicializamos un array para almacenar los pacientes agrupados con sus estudios
$numeracion = 1; // Contador para la columna de numeración en la tabla

foreach ($resultados as $resultado) {
    // Generamos una clave única basada en el nombre completo para evitar duplicados
    $pacienteKey = md5($resultado->PACIENTE_NOMBRE);

    // Si el paciente aún no está en la lista, lo agregamos con su información básica
    if (!isset($pacientes[$pacienteKey])) {
        $pacientes[$pacienteKey] = [
            'nombre' => $resultado->PACIENTE_NOMBRE,
            'sexo' => $resultado->PACIENTE_GENERO,
            'edad' => intval($resultado->PACIENTE_EDAD),
            'estudios' => [], // Inicializamos un array para almacenar sus estudios
            'precio_general' => formatCurrency($resultado->SERVICIO_PRECIO) ?? 'No definido',
            'detalle_estudios' => $resultado->DETALLES_ESTUDIOS
        ];
    }

    // Agregamos el estudio a la lista de estudios del paciente
    $pacientes[$pacienteKey]['estudios'][] = [
        'servicio' => $resultado->SERVICIO, // Nombre del estudio
        'servicio_clave' => $resultado->SERVICIO_ABREVIATURA, // Clave del estudio
        'precio' => formatCurrency($resultado->SERVICIO_PRECIO) ?? 'No definido' // Puedes reemplazar esto con el precio real si está disponible en los datos
    ];
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
