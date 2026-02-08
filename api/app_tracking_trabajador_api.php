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
    case 1: # Obtener trabajadores (Activos)
        $search = $request['search'] ?? '';
        $workers = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_listado_v2_search', [1, $search]);
        // Decodificar el JSON de categorías directamente
        foreach ($workers as &$worker) {
            $worker['categorias'] = !empty($worker['categorias_json']) 
                                    ? json_decode($worker['categorias_json'], true) 
                                    : [];
            unset($worker['categorias_json']);
        }
        $response = $workers;
        break;

    case 2: # Actualizar Trabajador (NUEVO)
        $id = $request['id'] ?? null;
        if ($id) {
            $params = getParams($request, [
                'id',
                'nombre_completo', 'puesto', 'salario_diario', 'fecha_inicio',
                'curp', 'rfc', 'nss', 'telefono', 'correo', 'banco', 'cuenta_clabe'
            ]);

            $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_actualizar', $params);

            // Re-sync categories
             if (!empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categorias_limpiar', ['TRABAJADOR', $id]);
                
                 foreach ($request['clasificaciones'] as $c) {
                    $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                        'TRABAJADOR', $id, $c['superId'], $c['catId'], $c['subId']
                    ]);
                }
            }
            $response = ['id' => $id];
        } else {
             $code = 400; $message = 'ID requerido';
        }
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
    
    case 8: # Obtener Trabajador (Detalle - NUEVO)
        $id = $request['id'] ?? null;
        if ($id) {
            $res = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_obtener', [$id]);
            $response = $res[0] ?? [];
            if (!empty($response['categorias_json'])) {
                $response['categorias'] = json_decode($response['categorias_json'], true);
            }
        } else {
            $code = 400; $message = 'ID requerido';
        }
        break;

    case 11: # Eliminar Trabajador
        $id = $request['id'] ?? null;
        if ($id) {
            $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_eliminar', [$id]);
            $response = ['id' => $id];
        } else {
            $code = 400; $message = 'ID requerido';
        }
        break;

    default:
        $code = 400;
        $message = 'API no encontrada';
        $response = [];
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