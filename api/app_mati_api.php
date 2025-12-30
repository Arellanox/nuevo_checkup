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
    case 1:
        // Servicios Disponibles
        $params = getParams($request, ['area']);
        $response = $master->getByProcedureWithFecthAssoc('ia_servicios_precios', $params);
        break;
    case 2:
        // Promociones Disponibles
        $response = $master->getByProcedureWithFecthAssoc('ia_promociones', [1]);
        break;
    case 3:
        // Busqueda de Servicios
        $params = getParams($request, ['termino', 'area']);
        $response = $master->getByProcedure('ia_servicios_busqueda', $params);
        break;
    case 4:
        // Crear o Actualizar Blog
        $params = getParams($request, [
            'id', 'title', 'slug', 'description', 'content', 'cover_image',
            'badge', 'badge_color', 'author', 'read_time', 'publish_date'
        ]);
        $response = $master->getByProcedureWithFecthAssoc('ia_blog_save', $params);
        break;
    case 5:
        // Busqueda de Blog Listado
        $params = getParams($request, ['search_term', 'badge_filter', 'page', 'limit']);
        $params[2] = $params[2] ?? 1;  // page default
        $params[3] = $params[3] ?? 10; // limit default
        $response = $master->getByProcedureWithFecthAssoc('ia_blog_list', $params);
        break;
    case 6:
        // Busqueda de detalles de un Blog
        $params = getParams($request, ['identifier']);
        $response = $master->getByProcedureWithFecthAssoc('ia_blog_get_detail', $params);
        break;
    case 7:
        // Eliminación de un Blog
        $params = getParams($request, ['id']);
        $response = $master->getByProcedureWithFecthAssoc('ia_blog_delete', $params);
        break;
    default:
        $code = 400;
        $response = [];
        $message = 'Operación Fallida.';
        break;
}

function getParams($source, $keys): array {
    return array_map(function ($key) use ($source) {
        return $source[$key] ?? null;
    }, $keys);
}

http_response_code($code);
echo json_encode(["response" => ["message" => 'Operación Fallida', "data" => $response, "code" => $code]]);