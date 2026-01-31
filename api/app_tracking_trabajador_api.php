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