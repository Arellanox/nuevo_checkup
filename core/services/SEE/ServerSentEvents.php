<?php
/**
 * Servidor SSE Optimizado con Heartbeat y Reconexión
 *
 * Características:
 * - Heartbeat cada 30 segundos
 * - Detección de conexiones perdidas
 * - Optimización de recursos
 * - Logs detallados
 * - Manejo de errores robusto
 */

// Configuración inicial
ini_set('max_execution_time', 0);
ini_set('memory_limit', '64M');
ignore_user_abort(false);

include __DIR__.'/config.php';

// Headers SSE
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Pragma: no-cache');
header('Expires: 0');
header('Connection: keep-alive');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Cache-Control');
header('X-Accel-Buffering: no'); // Para Nginx

// Configuración
$user_id = intval($_GET['user_id'] ?? 0);
$ultimo_id = intval($_GET['ultimo_id'] ?? 0);
$timestamp = intval($_GET['timestamp'] ?? time());

// Configuración de intervalos
$intervalo_consulta = 20; // 3 segundos base
$intervalo_heartbeat = 40; // 30 segundos
$intervalo_maximo = 15; // 15 segundos máximo entre consultas
$timeout_cliente = 300; // 5 minutos timeout total

// Variables de estado
$inicio_conexion = time();
$ultimo_heartbeat = time();
$sin_cambios_consecutivos = 0;
$max_sin_cambios = 10;
$intervalo_actual = $intervalo_consulta;

// Función para escribir logs
function escribirLog($mensaje, $nivel = 'INFO') {
    $log_dir = __DIR__ . '/logs';
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true);
    }

    $log_file = $log_dir . '/sse_' . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] [{$nivel}] {$mensaje}\n";

    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
}

// Función para enviar eventos SSE
function enviarEvento($evento, $datos = null, $id = null) {
    if ($id !== null) {
        echo "id: {$id}\n";
    }

    echo "event: {$evento}\n";

    if ($datos !== null) {
        echo "data: " . json_encode($datos) . "\n";
    }

    echo "\n";

    ob_flush();
    flush();
}

// Función para cerrar sesiones cURL
function flushAndCloseCurls($ch)
{
    ob_flush(); // Enviar salida al cliente
    flush(); // Limpiar el búfer de salida
    curl_close($ch); // Cerrar la sesión cURL
}

// Función para verificar si el cliente sigue conectado
function verificarConexionCliente(): bool
{
    return connection_status() === CONNECTION_NORMAL && !connection_aborted();
}

// Función para obtener notificaciones
function obtenerNotificaciones($user_id, $ultimo_id, $current_url) {
    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => "{$current_url}/api/notificaciones_api.php",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode([
            'api' => 1,
            'ultimo_id' => $ultimo_id,
            'user_id' => $user_id
        ]),
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_TIMEOUT => 5,
        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'SSE-NotificationServer/1.0'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    if ($response === false || !empty($error)) {
        escribirLog("Error cURL: {$error}", 'ERROR');
        flushAndCloseCurls($ch);
        return false;
    }

    if ($httpCode !== 200) {
        escribirLog("HTTP Error: {$httpCode}", 'ERROR');
        flushAndCloseCurls($ch);
        return false;
    }

    $data = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        escribirLog("JSON Error: " . json_last_error_msg(), 'ERROR');
        flushAndCloseCurls($ch);
        return false;
    }

    flushAndCloseCurls($ch);

    return $data;
}

// Función para enviar heartbeat
function enviarHeartbeat(): bool
{
    global $ultimo_heartbeat;
    $ahora = time();

    if ($ahora - $ultimo_heartbeat >= 40) { // 30 segundos
        enviarEvento('heartbeat', [
            'timestamp' => $ahora,
            'server_time' => date('Y-m-d H:i:s')
        ]);
        $ultimo_heartbeat = $ahora;
        return true;
    }
    return false;
}

// Validar parámetros
if (!$user_id) {
    enviarEvento('error', ['message' => 'User ID requerido', 'code' => 'INVALID_USER_ID']);
    escribirLog("Error: User ID no válido", 'ERROR');
    exit;
}

// Log de inicio
escribirLog("Iniciando SSE - Usuario: {$user_id}, Último ID: {$ultimo_id}");

// Enviar confirmación de conexión
enviarEvento('connected', [
    'user_id' => $user_id,
    'ultimo_id' => $ultimo_id,
    'timestamp' => time(),
    'server_time' => date('Y-m-d H:i:s')
]);

// Loop principal
while (true) {
    $ahora = time();

    // Verificar timeout del cliente
    if ($ahora - $inicio_conexion > $timeout_cliente) {
        escribirLog("Timeout del cliente alcanzado ({$timeout_cliente}s)", 'WARNING');
        enviarEvento('timeout', [
            'message' => 'Timeout del cliente alcanzado',
            'duration' => $timeout_cliente
        ]);
        break;
    }

    // Verificar si el cliente sigue conectado
    if (!verificarConexionCliente()) {
        escribirLog("Cliente desconectado - Usuario: {$user_id}", 'INFO');
        break;
    }

    // Enviar heartbeat si es necesario
    if (enviarHeartbeat()) {
        escribirLog("Heartbeat enviado - Usuario: {$user_id}");
    }

    try {
        // Obtener notificaciones
        $datos = obtenerNotificaciones($user_id, $ultimo_id, $current_url);

        if ($datos === false) {
            // Error en la consulta
            $sin_cambios_consecutivos++;

            if ($sin_cambios_consecutivos >= $max_sin_cambios) {
                enviarEvento('error', [
                    'message' => 'Error persistente obteniendo notificaciones',
                    'code' => 'PERSISTENT_ERROR'
                ]);
                break;
            }
        } else {
            // Verificar si hay notificaciones nuevas
            $notificaciones = $datos['response']['data'] ?? [];

            if (!empty($notificaciones)) {
                $nuevo_ultimo_id = max(array_column($notificaciones, 'ID_NOTIFICACION'));

                if ($nuevo_ultimo_id > $ultimo_id) {
                    // Hay notificaciones nuevas
                    $notificaciones_nuevas = array_filter($notificaciones, function($n) use ($ultimo_id) {
                        return intval($n['ID_NOTIFICACION']) > $ultimo_id;
                    });

                    if (!empty($notificaciones_nuevas)) {
                        enviarEvento('notification', $datos, $nuevo_ultimo_id);
                        escribirLog("Notificaciones enviadas - Usuario: {$user_id}, Nuevas: " . count($notificaciones_nuevas));

                        $ultimo_id = $nuevo_ultimo_id;
                        $sin_cambios_consecutivos = 0;
                        $intervalo_actual = $intervalo_consulta; // Resetear intervalo
                    }
                } else {
                    // No hay notificaciones nuevas
                    $sin_cambios_consecutivos++;
                    escribirLog("No hay Notificaciones [NUEVO ULTIMO ID: {$nuevo_ultimo_id}]: ", 'WARINING');
                }
            } else {
                // No hay notificaciones
                $sin_cambios_consecutivos++;
                escribirLog("No hay Notificaciones", 'WARINING');
            }
        }

        // Ajustar intervalo dinámicamente
        if ($sin_cambios_consecutivos >= 3) {
            $intervalo_actual = min($intervalo_actual * 1.5, $intervalo_maximo);
        } else {
            $intervalo_actual = $intervalo_consulta;
        }

        // Log periódico de estado
        if ($ahora % 120 === 0) { // Cada 2 minuto
            $duracion = $ahora - $inicio_conexion;
            escribirLog("Estado SSE - Usuario: {$user_id}, Duración: {$duracion}s, Sin cambios: {$sin_cambios_consecutivos}, Intervalo: {$intervalo_actual}s");
        }

        // Esperar antes de la siguiente consulta
        sleep($intervalo_actual);
    } catch (Exception $e) {
        escribirLog("Excepción en loop principal: " . $e->getMessage(), 'ERROR');

        enviarEvento('error', [
            'message' => 'Error interno del servidor',
            'code' => 'INTERNAL_ERROR'
        ]);

        sleep($intervalo_actual);
    }

    // Limpiar buffer de salida para evitar acumulación
    ob_flush();
    flush();


    // Liberar memoria
    if (function_exists('gc_collect_cycles')) {
        gc_collect_cycles();
    }
}

// Cleanup final
$duracion_total = time() - $inicio_conexion;
escribirLog("Cerrando SSE - Usuario: {$user_id}, Duración total: {$duracion_total}s");

// Enviar evento de cierre
enviarEvento('close', [
    'message' => 'Conexión cerrada',
    'duration' => $duracion_total,
    'timestamp' => time()
]);

// Cerrar conexión
exit;