<?php
require_once "../clases/master_class.php";

$master = new Master();

// Leer la entrada JSON
$inputData = file_get_contents('php://input');
$datos = json_decode($inputData, true);

// Registrar la entrada en el log
# $master->setLog($inputData, "asafasd");

if (json_last_error() !== JSON_ERROR_NONE) {
    // Error en el formato JSON recibido
    $response = [
        'status' => 'error',
        'message' => 'Datos JSON inválidos.',
        'details' => json_last_error_msg()
    ];
    echo json_encode($response);
    exit;
}

// Verificar que se haya recibido el campo 'datos'
if (!isset($datos['datos'])) {
    $response = [
        'status' => 'error',
        'message' => 'Falta el campo "datos" en la solicitud.'
    ];
    echo json_encode($response);
    exit;
}

try {
    // Insertar datos mediante el procedimiento almacenado
    $result = $master->insertByProcedure('sp_pseudo_interface', [
        json_encode($datos['datos'])
    ]);

    // Preparar la respuesta
    $response = [
        'status' => 'success',
        'message' => $_SERVER['SERVER_NAME'] . ": ¡ SOLICITUD PROCESADA !",
        'result' => $result
    ];
} catch (Exception $e) {
    // Manejo de excepciones
    error_log("Error al procesar la solicitud: " . $e->getMessage());
    $response = [
        'status' => 'error',
        'message' => 'Error al procesar la solicitud.',
        'details' => $e->getMessage()
    ];
}

// Devolver la respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
