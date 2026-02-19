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
        $search = $request['search'] ?? '';
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_listado_v2_search', [null, null, $search]);
        break;

    case 2: # Crear proveedor
        $params = getParams($request, [
            'nombre_comercial',
            'razon_social',
            'nombre_contacto',
            'telefono',
            'correo',
            'rfc',
            'banco',
            'cuenta_clabe',
            'tiene_credito',
            'dias_credito'
        ]);

        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_crear', $params);
        $entityId = $res[0]['id'] ?? null;

        if ($entityId && !empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
            foreach ($request['clasificaciones'] as $c) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                    'PROVEEDOR',
                    $entityId,
                    $c['superId'],
                    $c['catId'],
                    $c['subId']
                ]);
            }
        }
        $response = ['id' => $entityId];
        break;

    case 10: # Eliminar Proveedor
        $id = $request['id'] ?? null;
        if ($id) {
            $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_eliminar', [$id]);
            $response = ['id' => $id];
        } else {
            $code = 400;
            $message = 'ID requerido';
        }
        break;

    case 12: # Obtener Proveedor (Detalle)
        $id = $request['id'] ?? null;
        if ($id) {
            $res = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_obtener', [$id]);
            $response = $res[0] ?? [];
            if (!empty($response['categorias_json'])) {
                $response['categorias'] = json_decode($response['categorias_json'], true);
            }
        } else {
            $code = 400;
            $message = 'ID requerido';
        }
        break;

    case 13: # Actualizar Proveedor
        $id = $request['id'] ?? null;
        if ($id) {
            $params = getParams($request, [
                'id',
                'nombre_comercial',
                'razon_social',
                'nombre_contacto',
                'telefono',
                'correo',
                'rfc',
                'banco',
                'cuenta_clabe',
                'tiene_credito',
                'dias_credito'
            ]);

            $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_actualizar', $params);

            // Re-sync categories if provided
            if (!empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
                // Clear existing categories first to avoid duplicates
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categorias_limpiar', ['PROVEEDOR', $id]);

                foreach ($request['clasificaciones'] as $c) {
                    $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                        'PROVEEDOR',
                        $id,
                        $c['superId'],
                        $c['catId'],
                        $c['subId']
                    ]);
                }
            }
            $response = ['id' => $id];
        } else {
            $code = 400;
            $message = 'ID requerido';
        }
        break;

    default:
        $code = 400;
        $message = 'API no encontrada';
        $response = [];
        break;
}



function getParams($source, $keys): array
{
    return array_map(function ($key) use ($source) {
        return $source[$key] ?? null;
    }, $keys);
}

http_response_code($code);
header('Content-Type: application/json');
echo json_encode(["response" => ["message" => $message, "data" => $response, "code" => $code]]);
