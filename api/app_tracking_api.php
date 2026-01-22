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

    case 9: # Obtener trabajadores (Activos)
        // Obtener lista base
        $workers = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_listado', [1]);
        
        // Obtener atributos (categorías/bonos) de todos los trabajadores
        $cats = $master->getByProcedureWithFecthAssoc('sp_tracking_trabajadores_atributos', []);

        // Map categories to workers
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
        // Parametros basados en la estructura previa: razon_social, nombre_contacto, telefono, correo, rfc, banco, cuenta_clabe, tiene_credito, dias_credito, unidad_negocio_id
        $params = getParams($request, [
            'razon_social', 'nombre_contacto', 'telefono', 'correo', 'rfc',
            'banco', 'cuenta_clabe', 'tiene_credito', 'dias_credito', 'unidad_negocio_id'
        ]);
        
        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_proveedores_crear', $params);
        $entityId = $res[0]['id'] ?? null;

        if ($entityId && !empty($request['clasificaciones']) && is_array($request['clasificaciones'])) {
            foreach ($request['clasificaciones'] as $c) {
                // entidad_tipo, entidad_id, super_category_id, category_id, subcategory_id
                $master->getByProcedureWithFecthAssoc('sp_tracking_entidad_categoria_agregar', [
                    'PROVEEDOR', $entityId, $c['superId'], $c['catId'], $c['subId']
                ]);
            }
        }
        $response = ['id' => $entityId];
        break;

    case 3: # Crear Trabajador
        // NOTA: Ajustado al SP definido en updates (sp_tracking_trabajadores_crear)
        // Params: nombre_completo, puesto, salario_diario, fecha_inicio, curp, rfc, nss, telefono, correo, banco, cuenta_clabe
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

    case 5: # Crear Profesionales
        // Params: nombre_completo, especialidad, modalidad_fiscal, monto_honorarios, fecha_inicio, fecha_terminacion, domicilio, telefono, correo, observaciones, banco, cuenta_clabe, unidad_negocio_id
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

    case 7: # Get Categories Config
        $res = $master->getByProcedureWithFecthAssoc('sp_tracking_config_obtener', []);
        $json = $res[0]['json_data'] ?? null;
        $categories = $json ? json_decode($json, true) : [];
        $response = ['categories' => $categories];
        break;

    case 8: # Save Categories Config
        $jsonData = json_encode($request['categories']);
        $master->getByProcedureWithFecthAssoc('sp_tracking_config_guardar', [$jsonData]);
        $response = true;
        break;

    case 6: # Listado de Profesionales
        $response = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_listado', [null, null]);
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