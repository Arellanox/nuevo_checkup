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

    case 7: # Listado de Profesionales
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_listado', [null, null]);
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