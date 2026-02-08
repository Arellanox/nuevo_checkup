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
    case 4: # Crear Profesionales
        $params = getParams($request, [
            'nombre_completo', 'especialidad', 'modalidad_fiscal', 'monto_honorarios',
            'fecha_inicio', 'fecha_terminacion', 'domicilio', 'telefono', 'correo', 
            'observaciones', 'banco', 'cuenta_clabe'
        ]);

        // Validación básica de campos obligatorios para asegurar integridad
        if (empty($params[0])) { // nombre_completo
             $code = 400; $message = 'Nombre completo requerido'; break;
        }

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

    case 5: # Actualizar Profesional
        $id = $request['id'] ?? null;
        if ($id) {
        $params = getParams($request, [
            'nombre_completo', 'especialidad', 'modalidad_fiscal', 'monto_honorarios',
            'fecha_inicio', 'fecha_terminacion', 'domicilio', 'telefono', 'correo', 
            'observaciones', 'banco', 'cuenta_clabe'
        ]);
            
            $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_actualizar', $params);
            
            // Re-sync categories
             if (!empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categorias_limpiar', ['PROFESIONAL', $id]);
                
                 foreach ($request['clasificaciones'] as $c) {
                    $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                        'PROFESIONAL', $id, $c['superId'], $c['catId'], $c['subId']
                    ]);
                }
            }
            $response = ['id' => $id];
        } else {
             $code = 400; $message = 'ID requerido';
        }
        break;

    case 6: # Eliminar Profesional
        $id = $request['id'] ?? null;
        if ($id) {
            $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_eliminar', [$id]);
            $response = ['id' => $id];
        } else {
            $code = 400; $message = 'ID requerido';
        }
        break;

    case 7: # Listado de Profesionales
        $search = $request['search'] ?? '';
        $professionals = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_listado_v2', [$search]);
        // Decodificamos el JSON si es necesario, aunque en el listado v2 solo damos el count.
        // Si queremos el detalle de categorias en el listado, tendríamos que cambiar el SP.
        // Por ahora devuelve p.*, etiquetas_count
        $response = $professionals;
        break;

    case 8: # Obtener Profesional (Detalle)
        $id = $request['id'] ?? null;
        if ($id) {
            $res = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_obtener', [$id]);
            $response = $res[0] ?? [];
            if (!empty($response['categorias_json'])) {
                $response['categorias'] = json_decode($response['categorias_json'], true);
            }
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