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
    case 1: # Obtener categorias, subcategorias y unidades de negocio
        $categorias = $master->getByProcedureWithFecthAssoc('sp_tracking_categorias_obtener', getParams($request, ['ambito_entidad']));
        $subcategorias = $master->getByProcedureWithFecthAssoc('sp_tracking_subcategorias_obtener', getParams($request, ['categoria_id']));
        $unidades_negocio = $master->getByProcedureWithFecthAssoc('sp_tracking_unidades_negocio_obtener', []);
        
        $response = [
            'categorias' => $categorias,
            'subcategorias' => $subcategorias,
            'unidades_negocio' => $unidades_negocio
        ];
        break;
    case 2: # Crear proveedor
        $params = getParams($request, [
            'razon_social', 'nombre_contacto', 'telefono', 'correo', 'rfc',
            'banco', 'cuenta_clabe', 'tiene_credito', 'dias_credito', 
            'unidad_negocio_id', 'categoria_id', 'subcategoria_id'
        ]);
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_crear', $params);
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
echo json_encode(["response" => ["message" => $message, "data" => $response, "code" => $code]]);