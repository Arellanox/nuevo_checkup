<?php
$pacientes = []; // Inicializamos un array para almacenar los pacientes agrupados con sus estudios
$numeracion = 1; // Contador para la columna de numeración en la tabla
$accountTotalAmount = 0;
$lastKey = 0;

foreach ($resultados[0] as $resultado) {
    // Generamos una clave única basada en el nombre completo para evitar duplicados (emulando un grupo)
    $pacienteKey = md5($resultado->PREFOLIO.$resultado->ID_SERVICIO);

    // Si el paciente aún no está en la lista, lo agregamos con su información básica
    if (!isset($pacientes[$pacienteKey])) {

        if ($lastKey != $resultado->PREFOLIO) {
            $lastKey = $resultado->PREFOLIO;
            $nombre = $resultado->PACIENTE_NOMBRE;
            $sexo = $resultado->PACIENTE_GENERO;
            $edad = intval($resultado->PACIENTE_EDAD);
        } else {
            $nombre = '';
            $sexo = '';
            $edad = '';
        }

        $pacientes[$pacienteKey] = [
            'prefolio' => $resultado->PREFOLIO,
            'nombre' => $nombre,
            'pac_nombre' => $resultado->PAC_NOMBRE,
            'pac_paterno' => $resultado->PAC_PATERNO,
            'pac_materno' => $resultado->PAC_MATERNO,
            'fecha_nacimiento' => $resultado->FECHA_NACIMIENTO,
            'id_paciente' => $resultado->PREFOLIO,
            'toma_muestra' => $resultado->FECHA_TOMA_MUESTRA,
            'medico' => $resultado->NOMBRE_MEDICO_TRATANTE,
            'sexo' => $sexo,
            'edad' => $edad,
            'detalle_estudios' => $resultado->DETALLES_ESTUDIOS,
            'envio_completo' => $resultado->ENVIO_COMPLETO,
            'obsercaciones' => $resultados->OBSERVACIONES,
            'grupo_detalles' => [
                'nombre' => $resultado->GRUPO_LAB_ESTUDIO_NOMBRE,
                'clave' => $resultado->GRUPO_LAB_ESTUDIO_CLAVE,
                'precio'=> formatCurrency($resultado->GRUPO_PRECIO ?? 0) ?? 'No existe un registro en maquilas/lista de precios.',
            ],
            'total_maquila' => $resultado->TOTAL_MAQUILA
        ];

        $accountTotalAmount += $resultado->TOTAL_MAQUILA ?? 0;
    }

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
