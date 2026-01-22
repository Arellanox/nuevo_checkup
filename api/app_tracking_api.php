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
    case 0: # Obtener proveedores
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_listado', [null, null]);
        break;

    case 1: # Obtener trabajadores (Activos)
        $workers = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_listado', [1]);
        $cats = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_atributos', []);

        foreach ($workers as &$worker) {
            $worker['categorias'] = [];
            foreach ($cats as $c) {
                if ($c['entidad_id'] == $worker['id']) {
                    $worker['categorias'][] = $c;
                }
            }
        }
        $response = $workers;
        break;
    case 2: # Crear proveedor
        $params = getParams($request, [
            'razon_social', 'nombre_contacto', 'telefono', 'correo', 'rfc',
            'banco', 'cuenta_clabe', 'tiene_credito', 'dias_credito', 'unidad_negocio_id'
        ]);
        
        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_crear', $params);
        $entityId = $res[0]['id'] ?? null;

        if ($entityId && !empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
            foreach ($request['clasificaciones'] as $c) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                    'PROVEEDOR', $entityId, $c['superId'], $c['catId'], $c['subId']
                ]);
            }
        }
        $response = ['id' => $entityId];
        break;

    case 3: # Crear Trabajador
        $params = getParams($request, [
            'nombre_completo', 'puesto', 'salario_diario', 'fecha_inicio',
            'curp', 'rfc', 'nss', 'telefono', 'correo', 'banco', 'cuenta_clabe'
        ]);

        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_crear', $params);
        $entityId = $res[0]['id'] ?? null;

        if ($entityId && !empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
             foreach ($request['clasificaciones'] as $c) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                    'TRABAJADOR', $entityId, $c['superId'], $c['catId'], $c['subId']
                ]);
            }
        }
        $response = ['id' => $entityId];
        break;

    case 4: # Crear Profesionales
        $params = getParams($request, [
            'nombre_completo', 'especialidad', 'modalidad_fiscal', 'monto_honorarios',
            'fecha_inicio', 'fecha_terminacion', 'domicilio', 'telefono', 'correo', 
            'observaciones', 'banco', 'cuenta_clabe', 'unidad_negocio_id'
        ]);

        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_crear', $params);
        $entityId = $res[0]['id'] ?? null;

        if ($entityId && !empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
             foreach ($request['clasificaciones'] as $c) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                    'PROFESIONAL', $entityId, $c['superId'], $c['catId'], $c['subId']
                ]);
            }
        }
        $response = ['id' => $entityId];
        break;

    case 5: # Get Categories Config
        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_config_obtener', []);
        $json = $res[0]['json_data'] ?? null;
        $categories = $json ? json_decode($json, true) : [];
        $response = ['categories' => $categories];
        break;

    case 6: # Save Categories Config
        $jsonData = json_encode($request['categories']);
        $master->getByProcedureWithFecthAssoc('sp_tracking_config_guardar', [$jsonData]);
        $response = true;
        break;

    case 7: # Listado de Profesionales
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_listado', [null, null]);
        break;

    case 10: # Registrar Pago (Factura)
        $params = getParams($request, [
            'proveedor_id', 'folio', 'fecha_emision', 'fecha_limite', 'monto', 'archivo_ruta'
        ]);
        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_pagos_crear', $params);
        $response = ['id' => $res[0]['id'] ?? null];
        break;

    default:
        $code = 400;
        $response = [];
        // Debugging info
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