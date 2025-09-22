<?php
$pacientes = []; // Inicializamos un array para almacenar los pacientes agrupados con sus estudios
$numeracion = 1; // Contador para la columna de numeración en la tabla
$accountTotalAmount = 0;

foreach ($resultados as $resultado) {
    // Generamos una clave única basada en el nombre completo para evitar duplicados
    $pacienteKey = md5($resultado->PACIENTE_NOMBRE.$resultado->ID_SERVICIO);

    // Si el paciente aún no está en la lista, lo agregamos con su información básica
    if (!isset($pacientes[$pacienteKey])) {
        $pacientes[$pacienteKey] = [
            'nombre' => $resultado->PACIENTE_NOMBRE,
            'sexo' => $resultado->PACIENTE_GENERO,
            'edad' => intval($resultado->PACIENTE_EDAD),
            'estudios' => [], // Inicializamos un array para almacenar sus estudios
            'precio_general' => formatCurrency($resultado->GRUPO_PRECIO ?? $resultado->SERVICIO_PRECIO ?? 0) ?? 'No existe un registro en maquilas/lista de precios.',
            'detalle_estudios' => $resultado->DETALLES_ESTUDIOS,
            'envio_completo' => $resultado->ENVIO_COMPLETO,
            'grupo_detalles' => [
                'nombre' => $resultado->GRUPO_LAB_ESTUDIO_NOMBRE,
                'clave' => $resultado->GRUPO_LAB_ESTUDIO_CLAVE,
                'precio'=> $resultado->GRUPO_PRECIO,
            ]
        ];

        $accountTotalAmount += $resultado->GRUPO_PRECIO ?? $resultado->SERVICIO_PRECIO ?? 0;
    }

    // Agregamos el estudio a la lista de estudios del paciente
    $pacientes[$pacienteKey]['estudios'][] = [
        'servicio' => $resultado->SERVICIO, // Nombre del estudio
        'servicio_clave' => $resultado->SERVICIO_ABREVIATURA, // Clave del estudio
        'precio' => formatCurrency($resultado->GRUPO_PRECIO ?? $resultado->SERVICIO_PRECIO ?? 0) ?? 'No definido'
        // Puedes reemplazar esto con el precio real si está disponible en los datos
    ];

    $pacientes[$pacienteKey]['count_estudio'] += 1;
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
