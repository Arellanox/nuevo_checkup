<?php

/**
 * Server-Sent Events (SSE) para el envío de notificaciones en tiempo real.
 *
 * Este script mantiene una conexión abierta con el cliente y envía nuevas notificaciones
 * desde una API en intervalos de tiempo definidos. Utiliza cURL para obtener los datos
 * de la API y los transmite mediante eventos SSE.
 */

include __DIR__.'/config.php';
header('Content-Type: text/event-stream'); // Indica que el contenido es de eventos SSE
header('Cache-Control: no-cache'); // Evita el almacene en caché
header('Connection: keep-alive'); // Mantiene la conexión abierta

while (true) {
    // Inicializar una solicitud cURL
    $ch = curl_init("{$current_url}/api/notificaciones_api.php");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true, // Retornar la respuesta
        CURLOPT_POST => true, // Solicitud es de tipo POST
        CURLOPT_POSTFIELDS => json_encode([
            'api' => 1, //Parámetro de autenticación de API
            'ultimo_id' => $_GET['ultimo_id'] ?? 0, // Última notificación recibida por el cliente
            'user_id' => $_GET['user_id'] ?? 0 // ID del usuario
        ]),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'] // Establecer el encabezado JSON
    ]);
    $response = curl_exec($ch);

    if ($response === false) {
        //echo "Error en la solicitud cURL: " . curl_error($ch);
        echo "{$current_url}/api/notificaciones_api.php";
        flushAndCloseCurls($ch);
    }

    // Decodificar la respuesta JSON obtenida de la API
    $notificacion = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error al decodificar JSON: " . $response;
        flushAndCloseCurls($ch);
    }

    // Enviar los datos de la notificación al cliente si existen registros nuevos
    echo "data: " . json_encode($notificacion) . "\n\n";
    flushAndCloseCurls($ch);

    sleep(120); // Esperar 120 segundos //temporal
}

function flushAndCloseCurls($ch){
    ob_flush(); // Enviar salida al cliente
    flush(); // Limpiar el búfer de salida
    curl_close($ch); // Cerrar la sesión cURL
}