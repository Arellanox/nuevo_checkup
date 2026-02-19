<?php
require_once "../api/config/cors.php";
require_once "../api/config/auth.php";

$master = requireAuth();
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$api = $request['api'] ?? null;
$message = 'Operación Exitosa';
$code = 200;

switch ($api) {
    case 0: # Obtener lista de clientes a crédito con saldos
        // Este SP obtiene clientes de la categoría CRÉDITO (ID 1.2) con sus saldos calculados
        $response = $master->getByProcedureWithFecthAssoc('sp_cxc_clientes_listado', []);
        break;

    case 1: # Obtener historial de pagos CxC
        $response = $master->getByProcedureWithFecthAssoc('sp_cxc_pagos_listado', [1]); // 1 = activo
        break;

    case 2: # Registrar nuevo pago
        $params = getParams($request, [
            'cliente_id', 
            'factura_numero', 
            'factura_referencia',
            'metodo_pago',
            'monto_pagado',
            'fecha_pago',
            'usuario_registro',
            'notas'
        ]);
        $res = $master->getByProcedureWithFecthAssoc('sp_cxc_pago_registrar', $params);
        $response = ['id' => $res[0]['id'] ?? null];
        break;

    case 3: # Eliminar pago (soft delete)
        $pagoId = $request['pago_id'] ?? null;
        if (!$pagoId) {
            $code = 400;
            $message = 'pago_id requerido';
            $response = [];
        } else {
            $res = $master->getByProcedureWithFecthAssoc('sp_cxc_pago_eliminar', [$pagoId]);
            $response = ['id' => $res[0]['id'] ?? null];
        }
        break;

    case 4: # Subir factura PDF (multipart/form-data)
        // TODO: Implementar upload de archivos
        // Por ahora retorna éxito simulado
        $pagoId = $request['pago_id'] ?? null;
        $response = ['uploaded' => true, 'pago_id' => $pagoId];
        break;

    case 5: # Obtener saldo de un cliente específico
        $clienteId = $request['cliente_id'] ?? null;
        if (!$clienteId) {
            $code = 400;
            $message = 'cliente_id requerido';
            $response = [];
        } else {
            $res = $master->getByProcedureWithFecthAssoc('sp_cxc_cliente_saldo', [$clienteId]);
            $response = $res[0] ?? null;
        }
        break;

    case 6: # Actualizar pago existente
        $params = getParams($request, [
            'id',
            'factura_numero',
            'factura_referencia',
            'metodo_pago',
            'monto_pagado',
            'fecha_pago',
            'notas'
        ]);
        $res = $master->getByProcedureWithFecthAssoc('sp_cxc_pago_actualizar', $params);
        $response = ['id' => $res[0]['id'] ?? null];
        break;

    default:
        $code = 400;
        $response = [];
        $debugInfo = "Received API: " . json_encode($api) . ". Payload: " . substr($json, 0, 100);
        $message = 'Operación Fallida. ' . $debugInfo;
        break;
}

function getParams($source, $keys): array {
    return array_map(function ($key) use ($source) {
        return $source[$key] ?? null;
    }, $keys);
}

http_response_code($code);
header('Content-Type: application/json');
echo json_encode(["response" => ["message" => $message, "data" => $response, "code" => $code]]);
